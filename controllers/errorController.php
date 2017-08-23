<?php

/**
 *
 */
class errorController extends Controller
{

  function __construct()
  {
    parent::__construct();

  }

  public function index($codigo = false)
  {
    $this->_view->titulo = 'Error';

    $this->_view->mensaje = $this->_getError($codigo);

    switch ($codigo) {
      case '404':
        $this->_view->loadView('404','admin');
        break;

        case '5050':
          $this->_view->loadView('5050','admin');
          break;

      default:
        $this->_view->loadView('index');
        break;
    }



  }



  private function _getError($codigo = false)
      {
          if($codigo){
              $codigo = $this->filtrarInt($codigo);
              if(is_int($codigo))
                  $codigo = $codigo;
          }
          else{
              $codigo = 'default';
          }

          $error['default'] = '<h1>Ha ocurrido un error y la página no puede mostrarse</h1>';
          $error['404'] = 'La pagina solicitada no se encuentra en el servidor';
          $error['5050'] = 'Acceso restringido!';
          $error['8080'] = 'Tiempo de la sesion agotado';

          if(array_key_exists($codigo, $error)){
              return $error[$codigo];
          }
          else{
              return $error['default'];
          }
      }
  public function access($codigo)
  {
    $this->_view->titulo = 'Error';
    $this->_view->loadView('access/index/');
    $this->_view->mensaje = $this->_getError();

  }


  public function alert($errors)
       {
           if(count($errors) == 0){
             return '';

           }else {
             $out = '';
             foreach($errors as $error):
                  $out .= "<p class='alert error'>" . $error. "</p>";
            endforeach;
             echo  $out;
           }


       }
}
