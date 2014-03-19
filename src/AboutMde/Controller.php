<?php

namespace AboutMde;

use \CarteBlanche\CarteBlanche;
use \CarteBlanche\Abstracts\AbstractController;
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

        // current url/uri
        $this->set('request', \Library\Helper\Url::getRequestUrl());

        // creating the Markdown parser
        $mde_config = CarteBlanche::getConfig('markdown', array());
        CarteBlanche::getContainer()->set('mde', MarkdownExtended::create($mde_config), true);

        // website data
        $this->set('website', $this->parseData('website'));

        // pages list
        $pages_dir = new \DirectoryIterator(CarteBlanche::getFullPath('storage_pages'));
        $pages = array();
        foreach ($pages_dir as $file) {
            if (substr($file->getFilename(), 0, 1)=='.' || $file->isDot() || $file->isDir()) continue;
            $pages[$file->getFilename()] = array(
                'name'=>$this->buildFilename($file),
                'path'=>str_replace($file->getExtension(), 'html', $file->getFilename()),
            );
        }
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
        $this->set('page', $this->getPage($page_name));

        // output
		return array_merge($this->_registry, array('output'=>''));
	}

	public function emptyAction(){}

    public function errorAction(\Exception $e, $code)
    {
        switch ($code) {
            case 404:
                $message = '<h1>The requested page could not be found.</h1>';
                break;
            default:
                $message = '<h1>We are sorry, but something went terribly wrong.</h1>';
        }
        $message .= '<p>'.$e->getMessage().'</p>'
                    .'<pre>'.$e->getTraceAsString().'</pre>';
        return new Response($message);
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
                throw new \Exception(
                    sprintf("Can not extend object (object of class '%s')", get_class($this->_registry[$var]))
                );
            } else {
                throw new \Exception(
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
            return $yml;
        } else {
            throw new \ErrorException(
                sprintf("Data file '%s' not found!", $file)
            );
        }
        return array();
    }

    public function getPage($file)
    {
        $file = str_replace(array('_html', '.html'), '', $file).'.md';
        $_f = CarteBlanche::getFullPath('storage_pages').'/'.$file;
        $mde_parser = CarteBlanche::getContainer()->get('mde');
        if (file_exists($_f)) {
            $mde = $mde_parser->transformSource($_f);
            $output_bag = $mde_parser->get('OutputFormatBag');
            $date = new \DateTime;
            $page = array(
                'name'      =>$this->buildFilename($_f),
                'content'   =>$mde->getBody(),
                'notes'     =>$mde->getFootnotes(),
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
                    $page['data'][$page['metas']['data']] = $this->parseData($page['metas']['data']);
                }
                if (isset($page['metas']['process'])) {
                    $_meth = $page['metas']['process'];
                    if (method_exists($this, $_meth)) {
                        $page_content = call_user_func(
                            array($this, $_meth),
                            $_f,
                            array('page'=>$page)
                        );
                        $mde_bis           = $mde_parser->transformString($page_content);
                        $page['content']   = $mde_bis->getBody();
                        $page['notes']     = $mde_bis->getFootnotes();
                        $page['toc']       = $output_bag->getHelper()->getToc($mde_bis, $output_bag->getFormater());
                    }
                }
            }
        } else {
            throw new \Exception(
                sprintf("Page '%s' not found!", $file), 400
            );
        }
        return $page;
    }

// ---------------------
// Statics
// ---------------------
    
    public function findModule($module)
    {
        $src = CarteBlanche::getFullPath('storage_modules').'/'.$module;
        if (file_exists($src)) {
            return $src;
        } elseif (file_exists($src.'.git')) {
            return $src.'.git';
        } else {
            throw new \ErrorException(
                sprintf("Git submodule '%s' not found!", $module)
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

}

// Endfile