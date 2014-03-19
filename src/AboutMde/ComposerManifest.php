<?php
namespace AboutMde;

/**
 * Class to handle a `composer.json` manifest file
 */
class ComposerManifest
{

    /**
     * The manifest default filename
     */
    const MANIFEST_FILE     = 'composer.json';

    /**
     * The "config" root entry
     */
    const MANIFEST_CONFIG   = 'config';

    /**
     * The "extra" root entry
     */
    const MANIFEST_EXTRA    = 'extra';

    /**
     * @var array
     */
    static $json_errors = array(
        JSON_ERROR_NONE             => null,
        JSON_ERROR_DEPTH            => 'Maximum stack depth exceeded',
        JSON_ERROR_STATE_MISMATCH   => 'Underflow or the modes mismatch',
        JSON_ERROR_CTRL_CHAR        => 'Unexpected control character found',
        JSON_ERROR_SYNTAX           => 'Syntax error, malformed JSON',
        JSON_ERROR_UTF8             => 'Malformed UTF-8 characters, possibly incorrectly encoded'
    );

    /**
     * @var string
     */
    protected $manifest_path;

    /**
     * @var array
     */
    protected $manifest;

    /**
     * Contsruction of a new instance ; without parameter, the default one will be searched
     *
     * @param   string  $base_path
     */
    public function __construct($base_path = null)
    {
        if (is_null($base_path)) {
            $base_path = dirname(dirname(dirname(__FILE__)));
        }
        $this->manifest_path = (0===substr_count($base_path, self::MANIFEST_FILE)) ?
            $base_path.'/'.self::MANIFEST_FILE : $base_path;
        try {
            $this->manifest = self::parse($this->manifest_path, true, false);
        } catch (\ErrorException $e) {
            throw $e;
        }
    }

    /**
     * Magic method allowing a `$manifest->XXX` where `XXX` is a manifest root entry
     *
     * @param   string  $var
     * @return  null|misc
     */
    public function __get($var)
    {
        return ( ! empty($this->manifest) && isset($this->manifest[$var])) ? $this->manifest[$var] : null;
    }

    /**
     * Magic method allowing a `$manifest->getXXX()` where `XXX` is a manifest root entry
     *
     * @param   string  $var
     * @param   misc    $arguments
     * @return  null|misc
     */
    public function __call($var, $arguments)
    {
        if (substr($var, 0, 3)=='get') {
            return $this->__get(strtolower(substr($var, 3)));
        }
        return null;
    }

    /**
     * Get a sub-item of a root item
     *
     * @param   string|null $root_item
     * @param   string|null $sub_item
     * @return  misc
     */
    public function getSubItem($root_item, $sub_item)
    {
        $item = ( ! empty($this->manifest) && isset($this->manifest[$root_item])) ? $this->manifest[$root_item] : array();
        return isset($item[$sub_item]) ? $item[$sub_item] : null;
    }

    /**
     * Get the `config` root entry or sub-item
     *
     * @param   string|null $entry
     * @return  misc
     */
    public function getConfig($entry = null)
    {
        if ( ! empty($entry)) {
            return $this->getSubItem(self::MANIFEST_CONFIG, $entry);
        }
        return $this->__get(self::MANIFEST_CONFIG);
    }

    /**
     * Get the `extra` root entry or sub-item
     *
     * @param   string|null $entry
     * @return  misc
     */
    public function getExtra($entry = null)
    {
        if ( ! empty($entry)) {
            return $this->getSubItem(self::MANIFEST_EXTRA, $entry);
        }
        return $this->__get(self::MANIFEST_EXTRA);
    }

    /**
     * Special JSON parser
     *
     * @param   string  $file_path
     * @param   bool    $assoc
     * @param   bool    $fail_gracefully
     *
     * @return  misc
     *
     * @throw   ErrorException if `$fail_gracefully = false` and an error occured
     */
    public static function parse($file_path = null, $assoc = false, $fail_gracefully = true)
    {
        if (file_exists($file_path)) {
            $data = @json_decode(file_get_contents($file_path), $assoc);
            if (json_last_error()!==JSON_ERROR_NONE) {
                $error = json_last_error();
                if (function_exists('json_last_error_msg')) {
                    $msg = json_last_error_msg();
                } else {
                    $msg = array_key_exists($error, self::$json_errors) ? self::$json_errors[$error] : "Unknown error ({$error})";
                }
                throw new \ErrorException(
                    sprintf('JSON parsing error while decoding file "%s" : "%s"!', $file_path, $msg)
                );
            }
            return $data;
        } elseif ( ! $fail_gracefully) {
            throw new \ErrorException(
                sprintf('Manifest file "%s" not found!', $file_path)
            );
        }
        return null;
    }

}

// Endfile