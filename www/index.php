<?php

/**
 * Show errors at least initially
 *
 * `E_ALL` => for hard dev
 * `E_ALL & ~E_STRICT` => for hard dev in PHP5.4 avoiding strict warnings
 * `E_ALL & ~E_NOTICE & ~E_STRICT` => classic setting
 */
@ini_set('display_errors','1'); @error_reporting(E_ALL);
//@ini_set('display_errors','1'); @error_reporting(E_ALL & ~E_STRICT);
//@ini_set('display_errors','1'); @error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT);

// Composer autoloader
$launcher = __DIR__.'/../src/vendor/autoload.php';
if (@file_exists($launcher)) {
    require_once $launcher;
} else {
    die("You need to run Composer to install your app.");
}

// _ROOTFILE : the filename handling the current request
define('_ROOTFILE', basename(__FILE__));

// _ROOTPATH : the dirname of the whole CarteBlanche installation
define('_ROOTPATH', realpath(dirname(__FILE__)) == DIRECTORY_SEPARATOR ?
    realpath('..'.DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR
    :
    realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR
);

// _ROOTHTTP : the base URL to use to construct the application routes (found from the current domain and path URL)
$_roothttp = '';
if (isset($_SERVER['HTTP_HOST']) && !empty($_SERVER['HTTP_HOST'])) {
    $_roothttp = (isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS'])!='off') ? 'https://' : 'http://';
    $_roothttp .= $_SERVER['HTTP_HOST'];
}
if (isset($_SERVER['PHP_SELF']) && !empty($_SERVER['PHP_SELF'])) {
    $_roothttp .= str_replace( '\\', '/', dirname($_SERVER['PHP_SELF']));
}
if (strlen($_roothttp)>0 && substr($_roothttp, -1) != '/') $_roothttp .= '/';
define('_ROOTHTTP', $_roothttp);

// the application
$main = \CarteBlanche\App\Kernel::create(
    __DIR__.'/../src/config/about-mde.ini', 
    null, 
    ((isset($_SERVER['REMOTE_ADDR']) && in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1','localhost'))) ? 
        (!empty($_GET) && isset($_GET['mode']) ? $_GET['mode'] : 'dev')
        : 'prod'
    )
)
->distribute();

// Endfile
