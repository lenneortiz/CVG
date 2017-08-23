<?php
/**
 *
 */
 class loginController extends Controller
 {
   private $_login;
   private $_validate;
   //private $_user;
      public function __construct()
      {
        //heredar el metodo constructor de la clase padre
        parent::__construct();
        $this->_login = $this->loadModel('login');
        $this->_user = $this->loadModel('user');

      }
      public function index()
      {

        //print_r($_SESSION);

        if(!empty($_POST)){

           $this->_view->titulo = 'Listado de usuarios';

           $user = $this->_login->loginUser($_POST['correo'],$_POST['pass']);
           if ($user != null) {

             if($user['estado'] == 0)
             {
               Core::alert("Usuario inactivo");
               Core::header(BASE_URL);

              }else{

                Session::set('autenticado',true);
                Session::set('level',$user['role']);
                Session::set('usuario',$user['usuario']);
                Core::header(BASE_URL.'admin');
              }

           } else {
              Core::header(BASE_URL);
           }


      }else {
        Core::header(BASE_URL);
      }
      }

      public function close()
      {

        $this->_login->truncate_table_intento_login($_SESSION['user_id']);
        Session::destroy();
        Core::header(BASE_URL.'index');
        //Core::header(BASE_URL.'user');
        /*unset($_SESSION['nombre']);
          if (isset($_SESSION['nombre']) AND !empty($_SESSION['nombre']) ) {
            echo "exite sesion";
          } else {
            echo "no exite sesion";
           //Core::header(BASE_URL.'index/r/1');
         }*/
      }



      /*public function login()
    {
        if(!empty($_POST)){

           $this->_view->titulo = 'Listado de usuarios';
           $post = $this->loadModel('login');
           $this->_view->usuario = $post->loginUser();
           $this->_view->loadView('index','user');
           //Core::header('../user');
      }else {
        Core::header('../index/r/1');
      }
    }*/

 }
 ?>
