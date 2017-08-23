<?php
/**
 *
 */
class adminController extends controller
{

  function __construct()
  {
    parent::__construct();
    $this->_user = $this->loadModel('user');
    $this->_estadistica = $this->loadModel('estadisticas');
    $this->_funcionario = $this->loadModel('funcionario');
  }

  public function index()
  {


    //echo "Mi nombre es " , get_class($this) , "\n";
       $clave_encript = password_hash('lenne20', PASSWORD_BCRYPT);
       //echo trim($clave_encript);
       //echo strlen($clave_encript);
       //obtenemos un arreglo con los nombres de los atributos de la clase
       $get_class_vars = get_class_methods(get_class($this->_user));

       //quitamos el atributo link y dataprovider
       $atrib_names =  array_slice($get_class_vars, 0, -1);
       //print_r($get_class_vars);

       /////////////////////////////////////////////////////////////////////////////

       ////////////////////Mostrar todos los funcionarios activos///////////////////////////
       $this->_view->funcionario = $this->_funcionario->get_funcionarios_limit_5();


       $this->_view->titulo = 'ADMIN | area de adminitración ';
       $this->_view->loadView('index','admin');
  }
}
