<?php /**
 *
 */
class View
{
  private $_controlador;

  public function __construct(Request $peticion)
  {
    $this->_controlador = $peticion->getController();
  }

  public function loadView($vista,$params = false)
  {
      if ($params == FALSE) {
        $params = 'default';
      } else {
        $params = $params;
      }

    /*$_layout_aparams = array(
      'url_css' => BASE_URL.'views'.DS.'layout'.DS.DEFAULT_LAYOUT.DS.'css'.DS ,
      'url_img' => BASE_URL.'views'.DS.'layout'.DS.DEFAULT_LAYOUT.DS.'img'.DS,
      'url_js' =>  BASE_URL.'views'.DS.'layout'.DS.DEFAULT_LAYOUT.DS.'js'.DS
    );*/
    $file = ROOT.DS.'views'.DS.$this->_controlador.DS .$vista.'.php';
    $header = ROOT.DS.'views'.DS.'layout'.DS.$params.DS.'header.php';
    $footer = ROOT.DS.'views'.DS.'layout'.DS.$params.DS.'footer.php';
    //echo $file;
    if(is_readable($file)){

      //echo  $file;
      //echo "es legible";
      require_once $header;
      require_once $file;
      require_once $footer;

      //echo $vist;
    }else{

      Core::header(BASE_URL.'error/index/404');


    }
    //throw new Exception('View issues');
  }
}
?>
