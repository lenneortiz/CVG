<?php

//contralador padre
    abstract class Controller{

        protected $_view;
        public $debug = true;

        //protected $load;
        public function __construct()
        {
          //disponer del objeto Views
          $this->_view = new View(new Request);
        }

       //esta clase abstract obliga a que todas la clases que hereden de la clase controller implemente un metodo index por obligación
        abstract public function index();

        protected function loadModel($model)
        {
          $model      = $model. 'Model';
          $rutamodel  = ROOT.DS.'models'.DS.$model.'.php';
        if (is_readable(  $rutamodel)) {
          //echo $rutamodel;
          //echo "es legible la ruta del modelo";
          require_once $rutamodel;
          $modelo = new $model;
          return $modelo;

        } else {
          //echo "no es legible la ruta del modelo";
          throw new Exception('404 - no existe el modelo<br>');

        }

        }
        protected function getLibreria($carpetaLib,$libreria )
        {
          $fileLibreria = ROOT.DS.'libs'.DS. $carpetaLib . $libreria.'.php';

          if (is_readable($fileLibreria)) {
            //echo $fileLibreria;
            //echo "es legible la ruta para la libreria";
            require_once $fileLibreria;
          } else {
            //echo "no es legible la ruta para la libreria";
          throw new Exception('error al requerir la libreria "'.$fileLibreria.'"');


          }

        }

        protected function getFileReport($carpetaFile,$file )
        {
          $fileLibreria = ROOT.DS.'views'.DS. $carpetaFile . $file.'.php';

          if (is_readable($fileLibreria)) {
            //echo $fileLibreria;
            //echo "es legible la ruta para la libreria";
            require_once $fileLibreria;
          } else {
            //echo "no es legible la ruta para la libreria";
          throw new Exception('error al requerir la libreria "'.$fileLibreria.'"');


          }

        }

        protected function filtrarInt($int) {
          $int = (int) $int;
          if (is_int($int)) {
              return $int;
          } else {
              return 0;
          }
        }

        public function validarEmail($email) {
        $email = $_POST[$email];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }


    protected function getSql($clave) {
        if (isset($_POST[$clave]) && !empty($_POST[$clave])) {
            $_POST[$clave] = strip_tags($_POST[$clave]);

            return trim($_POST[$clave]);
        }
    }

    protected function getInt($clave) {
    if (isset($_POST[$clave]) && !empty($_POST[$clave])) {
        $_POST[$clave] = filter_input(INPUT_POST, $clave, FILTER_VALIDATE_INT);
        return $_POST[$clave];
    }
    return 0;
}


    }
?>
