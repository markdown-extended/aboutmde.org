<?php

namespace AboutMde;

use \CarteBlanche\CarteBlanche;
use \CarteBlanche\Abstracts\AbstractController;
use \CarteBlanche\Exception\NotFoundException;
use \CarteBlanche\Exception\InternalServerErrorException;
use \CarteBlanche\Exception\AccessForbiddenException;
use \CarteBlanche\App\Response;
use \Symfony\Component\Yaml\Yaml;
use \MarkdownExtended\MarkdownExtended;

class Controller
    extends AbstractController
{

    protected $_registry    = array();

    protected function init()
    {
        // views
        self::$views_dir = __DIR__.'/../views/';
        self::$template = self::$views_dir.'layout.html.php';

        // this
        $this->set('about_mde', $this);

        // current url/uri
        $this->set('request', \Library\Helper\Url::getRequestUrl());
        
        // 'q' request for a search query ?
        $_q = CarteBlanche::getContainer()->get('request')->getArgument('q');
        if (!empty($_q)) {
            $this->set('search_query', $_q);
        }

        // creating the Markdown parser
        $mde_config = CarteBlanche::getConfig('markdown', array());
        CarteBlanche::getContainer()->set('mde', MarkdownExtended::create($mde_config), true);

        // website data
        $this->set('website', $this->parseData('website'));
        $website = $this->get('website');
        $icons = $website['menu-icons'];

        // pages list
        $pages_dir = new \DirectoryIterator(CarteBlanche::getFullPath('storage_pages'));
        $pages = array();
        foreach ($pages_dir as $file) {
            if (substr($file->getFilename(), 0, 1)=='.' || $file->isDot() || $file->isDir()) continue;
            $pages[$file->getFilename()] = array(
                'name'=>$this->buildFilename($file),
                'path'=>str_replace($file->getExtension(), 'html', $file->getFilename()),
                'icon'=>array_key_exists($file->getFilename(), $icons) ? $icons[$file->getFilename()] : null,
            );
        }
        $mode = CarteBlanche::getKernelMode();
        if (in_array($mode, array('dev','debug'))) {
            $pages['test'] = array(
                'name'=>'Test page (dev)',
                'path'=>'index.php?a=test',
                'icon'=>array_key_exists('test', $icons) ? $icons['test'] : null,
            );
        }
        ksort($pages);
        $this->set('pages', $pages);
    }

    public function indexAction()
    {
        $args = CarteBlanche::getContainer()->get('request')->getArguments();
        $page_name = '00-home';
        foreach ($args as $var=>$val) {
            if ( ! empty($var) && is_string($var) && substr_count($var, '.html')>0) {
                $page_name = $var;
            } elseif ( ! empty($var) && is_string($var) && substr_count($var, '_html')>0) {
                $page_name = str_replace('_html', '.html', $var);
            }
        }

        // page data
        $this->set('route', $page_name);
        try {
            $page = $this->getPage($page_name);
        } catch (NotFoundException $e) {
            return $this->errorHandler($e, 404);
        } catch (AccessForbiddenException $e) {
            return $this->errorHandler($e, 403);
        } catch (InternalServerErrorException $e) {
            return $this->errorHandler($e, 500);
        }
        $this->set('page', $page);

        // output
        return array_merge($this->_registry, array('output'=>''));
    }

    public function emptyAction(){}

    public function testAction()
    {
        $page_name = CarteBlanche::getFullPath('storage_data').'/test.md';
        try {
            $page = $this->parsePage($page_name);
            unset($page['toc']);
            $page['name'] = 'Test page';
            $page['pre-content'] = "<div class='alert alert-danger text-center'><strong>data/test.md</strong> - This page is a test for DEVELOPMENT USAGE only.</div>";
        } catch (NotFoundException $e) {
            return $this->errorHandler($e, 404);
        } catch (AccessForbiddenException $e) {
            return $this->errorHandler($e, 403);
        } catch (InternalServerErrorException $e) {
            return $this->errorHandler($e, 500);
        }
        $this->set('page', $page);
        return array_merge($this->_registry, array('output'=>''));
    }

    public function notfoundAction()
    {
        $e = new \CarteBlanche\Exception\Exception('HTML 404 status : page not found');
        CarteBlanche::getKernel()->setDebug(false);
        return $this->errorHandler($e, 404);
    }

    public function forbiddenAction()
    {
        $e = new \CarteBlanche\Exception\Exception('HTML 403 status : access forbidden');
        CarteBlanche::getKernel()->setDebug(false);
        return $this->errorHandler($e, 403);
    }

    public function errorAction()
    {
        $e = new \CarteBlanche\Exception\Exception('HTML 500 status : internal server error');
        CarteBlanche::getKernel()->setDebug(false);
        return $this->errorHandler($e, 500);
    }

    public function errorHandler(\CarteBlanche\Interfaces\CarteBlancheExceptionInterface $e, $code)
    {
        $params = $page = array();
        $params['code'] = $code;
        switch ($code) {
            case 403:
                $params['title'] = 'The requested page needs credentials';
                $params['content'] = '<p class="lead">We are very sorry but the page you are waiting for requires credentials you don\'t seem to have :(</p>';
                $params['icon'] = 'lock';
                $page['name'] = '403 - access forbidden :( ';
                break;
            case 404:
                $params['title'] = 'The requested page could not be found';
                $params['content'] = '<p class="lead">We are very sorry but the page you are waiting for doesn\'t exist :(</p>'
                    .'<p class="lead">This can be the result of a mistyped address (<em>please check in the address bar of your borwser if something went wrong</em>) or the page you wanted to reach has disappeared ...</p>';
                $params['icon'] = 'frown-o';
                $page['name'] = '404 error :( ';
                break;
            default:
                $params['title'] = 'We are sorry, but something went terribly wrong';
                $params['content'] = '<p class="lead">We are very sorry but the page you are waiting for has created an error :(</p>'
                    .'<p class="lead">This can be the result of a mistyped address (<em>please check in the address bar of your borwser if something went wrong</em>) or our source code is not as robust as we thought ... which is probably closer to the truth.</p>';
                $page['name'] = 'internal error :( ';
                break;
        }
        $params['stack_trace'] = "on request: ".\Library\Helper\Url::getRequestUrl()."\n\n"
            .$this->_getSecuredRealPath($e->getTraceAsString(),0);

        $page['content'] = $this->view(self::$views_dir.'error.html.php', $params);
        $this->set('page', $page);
        $this->getContainer()->get('template_engine')
            ->getTemplateObject('MetaTag')->add('robots', 'none');

        $mode_data = CarteBlanche::getKernelMode(true);
        if (is_array($mode_data)
            && isset($mode_data['debug'])
            && true==$mode_data['debug']
        ) {
            return CarteBlanche::getContainer()->get('front_controller')
                ->renderError(array_merge($page, $params), $code);
        }
        return array_merge($this->_registry, array('output'=>''));
    }

// ------------------------
// Registry
// ------------------------

    public function set($var, $val)
    {
        $this->_registry[$var] = $val;
        return $this;
    }

    public function extend($var, $val, $recursive = false)
    {
        if (isset($this->_registry[$var])) {
            if (is_array($this->_registry[$var])) {
                $this->_registry[$var] = 
                    ($recursive) ? array_merge_recursive($this->_registry[$var], $val)
                        : array_merge($this->_registry[$var], $val);
            } elseif (is_string($this->_registry[$var])) {
                $this->_registry[$var] .= $val;
            } elseif (is_numeric($this->_registry[$var])) {
                $this->_registry[$var] += intval($val);
            } elseif (is_object($this->_registry[$var])) {
                throw new InternalServerErrorException(
                    sprintf("Can not extend object (object of class '%s')", get_class($this->_registry[$var]))
                );
            } else {
                throw new InternalServerErrorException(
                    sprintf("Unknown type to extend (typed '%s')", gettype($this->_registry[$var]))
                );
            }
        } else {
            return $this->set($var, $val);
        }
        return $this;
    }

    public function get($var, $default = null)
    {
        return isset($this->_registry[$var]) ? $this->_registry[$var] : $default;
    }

// ------------------------
// Utils
// ------------------------

    public function buildFilename($file)
    {
        if ( ! ($file instanceof \SplFileInfo)) {
            $file = new \SplFileInfo(basename($file));
        }
        $name = str_replace('.'.$file->getExtension(), '', $file->getFilename());
        $name = preg_replace('/^([0-9]{2}-)?(.*)$/', '$2', $name);
        $name = str_replace(array('-','_'), ' ', $name);
        return ucfirst($name);
    }

    public function parseData($file)
    {
        $_f = CarteBlanche::getFullPath('storage_data').'/'.str_replace('.yml', '', $file).'.yml';
        if (file_exists($_f)) {
            $yml = Yaml::parse($_f);
            $this->set($file, $yml);
            return $yml;
        } else {
            throw new InternalServerErrorException(
                sprintf("Data file '%s' not found!", $file)
            );
        }
        return array();
    }

    public function parsePage($_f)
    {
        $page = null;
        try {
            if (file_exists($_f)) {
                $mde_parser = CarteBlanche::getContainer()->get('mde');
                $mde = $mde_parser->transformSource($_f);
                $output_bag = $mde_parser->get('OutputFormatBag');
                $date = new \DateTime;
                $page = array(
                    'name'      =>$this->buildFilename($_f),
                    'content'   =>$mde->getBody(),
                    'notes'     =>$mde->getNotes(),
                    'metas'     =>$mde->getMetaData(),
                    'toc'       =>$output_bag->getHelper()->getToc($mde, $output_bag->getFormater()),
                    'date'      =>$date->setTimestamp(filemtime($_f)),
                    'data'      =>array()
                );
                if ( ! empty($page['metas'])) {
                    if (isset($page['metas']['title'])) {
                        $page['name'] = $page['metas']['title'];
                    }
                    if (isset($page['metas']['data'])) {
                        $data_stack = explode(',', $page['metas']['data']);
                        foreach ($data_stack as $data) {
                            $page['data'][$data] = $this->parseData($data);
                        }
                    }
                    if (isset($page['metas']['process'])) {
                        $meths_stack = explode(',', $page['metas']['process']);
                        foreach ($meths_stack as $_meth) {
                            $_meth = $page['metas']['process'];
                            if (method_exists($this, $_meth)) {
                                $page_content = call_user_func(
                                    array($this, $_meth),
                                    $_f,
                                    array_merge($this->_registry, array('page'=>$page))
                                );
                                if (!empty($page_content) && is_string($page_content)) {
                                    $mde_bis           = $mde_parser->transformString($page_content);
                                    $page['content']   = $mde_bis->getBody();
                                    $page['notes']     = $mde_bis->getNotes();
                                    $page['toc']       = $output_bag->getHelper()->getToc($mde_bis, $output_bag->getFormater());
                                }
                            }
                        }
                    }
                }
            } else {
                throw new NotFoundException(
                    sprintf("Page '%s' not found!", $file), 400
                );
            }
        } catch (NotFoundException $e) {
            throw $e;
        } catch (AccessForbiddenException $e) {
            throw $e;
        } catch (InternalServerErrorException $e) {
            throw $e;
        }
        return $page;
    }

    public function getPage($file)
    {
        try {
            $file = str_replace(array('_html', '.html'), '', $file).'.md';
            $_f = CarteBlanche::getFullPath('storage_pages').'/'.$file;
            if (file_exists($_f)) {
                    $page = $this->parsePage($_f);
            } else {
                throw new NotFoundException(
                    sprintf("Page '%s' not found!", $file), 400
                );
            }
        } catch (NotFoundException $e) {
            throw $e;
        } catch (AccessForbiddenException $e) {
            throw $e;
        } catch (InternalServerErrorException $e) {
            throw $e;
        }
        return $page;
    }

    public function getCheatSheet()
    {
        $data = $this->get('mde_data');
        $raw_mde = MarkdownExtended::create(array('config_file'=>MarkdownExtended::FULL_CONFIGFILE));
        $cheat_sheet = new CheatSheet($raw_mde);
        foreach ($data as $i=>$item) {
            $cheat_sheet->addItem($item);
        }        
        $this->set('cheat_sheet', $cheat_sheet);
        return $cheat_sheet;
    }
    
// ---------------------
// Statics
// ---------------------
    
    public static function findModule($module)
    {
        $src = CarteBlanche::getFullPath('storage_modules').'/'.$module;
        if (file_exists($src)) {
            return $src;
        } elseif (file_exists($src.'.git')) {
            return $src.'.git';
        } else {
            throw new InternalServerErrorException(
                sprintf("Git submodule '%s' not found!", $module)
            );
        }
    }

    public static function findManifest()
    {
        $cfg = CarteBlanche::getConfig('aboutmde');
        if (empty($cfg)) {
            throw new InternalServerErrorException(
                sprintf("Configuration entry '%s' not found!", 'aboutmde')
            );
        }
        $src = Controller::findModule('manifest').'/'.$cfg['manifest_name'];
        if (file_exists($src)) {
            return $src;
        } else {
            throw new InternalServerErrorException(
                sprintf("Manifest file '%s' not found!", $src)
            );
        }
    }

    public static function markdownify($str)
    {
        $mde = CarteBlanche::getContainer()->get('mde')
            ->transformString($str);
        return $mde->getBody();
    }

    public static function phpize($source, array $params = array())
    {
        return CarteBlanche::getContainer()->get('front_controller')
            ->view($source, $params);
    }

    /**
     * For security, transform a realpath as '/[***]/package_root/...'
     *
     * @param string $path
     * @param int $depth_from_root
     *
     * @return string
     */
    protected function _getSecuredRealPath($path, $depth_from_root = 1)
    {
        $ds = DIRECTORY_SEPARATOR;
        $parts = explode($ds, realpath(CarteBlanche::getPath('root_path')));
        for ($i=0; $i<=$depth_from_root; $i++) array_pop($parts);
        return str_replace(join($ds, $parts), $ds.'[***]', $path);
    }
}

// Endfile