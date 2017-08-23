<?php 
/**
*
*/
class Request
{

    private $_controller;

    private $_metodo;

    private $_args;

    public function __construct(){
        if (isset($_GET['url'])) {
            $url = filter_input(INPUT_GET, 'url',FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            $url = array_filter($url);
            //echo '<pre>';print_r($url);

            //$parts = explode('/', $_SERVER['REQUEST_URI']);
            //$parts = array_filter($parts);
            //echo '<pre>';print_r($parts);

            $this->_controller  = ($c = strtolower(array_shift($url)) )? $c: 'index';
            $this->_metodo      = ($c = strtolower(array_shift($url)) )? $c: 'index';
            $this->_args        = (isset($url[0])) ? $url : array();
        }





    }

    public function getController()
    {
        return $this->_controller;
    }

    public function getMethod()
    {
        return $this->_metodo;
    }

    public function getArgs()
    {
        return $this->_args;
    }
}

 ?>
