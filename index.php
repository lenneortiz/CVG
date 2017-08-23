<?php
error_reporting(E_ALL || E_NOTICE);
ini_set("display_errors",1);
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', realpath(dirname(__FILE__)) );
define('APP_PATH', ROOT. DS. 'application'. DS);
//echo APP_PATH;

try {
require_once (APP_PATH . 'Config.php');
require_once (APP_PATH . 'Request.php');
require_once (APP_PATH . 'Router.php');
require_once (APP_PATH . 'Core.php');
require_once (APP_PATH . 'FormValidate.php');
require_once (APP_PATH . 'Controller.php');
require_once (APP_PATH . 'Database.php');
require_once (APP_PATH . 'Model.php');
require_once (APP_PATH . 'View.php');
require_once (APP_PATH . 'Registry.php');
require_once (APP_PATH . 'Session.php');
require_once (APP_PATH . 'ErrorHandler.php');
//echo '<pre>';print_r(get_required_files());

//echo '<pre>';print_r(new Request());
//echo $logeo ;

/*if (isset($logeo) AND $logeo == 'login') {
  echo "hola estas logueado";
} else {
$url_login = ROOT.DS.'views'.DS.'login'.DS.'index.php';
$header = ROOT.DS.'views'.DS.'layout'.DS.'login'.DS.'header.php';
$footer = ROOT.DS.'views'.DS.'layout'.DS.'login'.DS.'footer.php';
require_once $header;
require_once $url_login;
require_once $footer;
}*/
Session::init();
//Router::route(Request $request);

    Router::route(new Request);
} catch (Exception $e) {
    echo $e->getMessage();

}
//Registry::getInstance()->selectQuery();
