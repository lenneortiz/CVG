<?php
class indexController extends Controller
{
    private $_login;
    public static $tablename = "user";
    public function __construct()
    {
      //heredar el metodo constructor de la clase padre
      parent::__construct();
      $this->_login = $this->loadModel('login');
      $this->_user = $this->loadModel('user');
    }

    public function index()
    {
        //$post = $this->loadModel('post');
        //echo "<pre>".print_r(__METHOD__)."</pre>";
        //$this->_view->post = $post->getPost();
        //(Session::get('autenticado'))? Core::header(BASE_URL.'index'):FALSE;

        $this->_view->titulo = 'Login |Area de inicio de sesion';
        $this->_view->loadView('index','default');

         if ($this->getInt('enviar') == 1) {
           $this->_view->datos = $_POST;

           if (Core::Valida_datos($_POST['correo'], 'email')== FALSE):
                 echo '<div class="alert alert-danger">
                       <strong>Error!</strong> debe ingresar un correo.
                     </div>';
                 exit;

           endif;

                if ($_POST['pass'] == "") {

                     echo '<div class="alert alert-danger fade in">
                           <strong>Error!</strong> debe ingresar una clave.
                         </div>';
                     exit;
                 }
              /////////////////////////////////////////////////////////////////
             $email = filter_input(INPUT_POST,'correo', FILTER_SANITIZE_EMAIL);
             $pass  = filter_input(INPUT_POST,'pass', FILTER_SANITIZE_STRING);

              $sql = sprintf("SELECT
                  EXTRACT(YEAR FROM created) AS anio,
                  EXTRACT(MONTH FROM created) AS mes,
                  EXTRACT(DAY FROM created) AS dia,
              ".self::$tablename.".iduser,
               ".self::$tablename.".foto,
              ".self::$tablename.".nombre,
              ".self::$tablename.".usuario,
              ".self::$tablename.".correo,
              ".self::$tablename.".pass,
              ".self::$tablename.".estado
              FROM ".self::$tablename."
              WHERE  ".self::$tablename.".correo='%s'LIMIT 1",$email);
              $user = $this->_login->select($sql);
              //comprobamos que exista el correo en la base de datos
              if ($user != null):
            //si existen datos procedemos a extraerlos de la base de datos
                  $user_id    = $user['iduser'];
                  $db_password  = $user['pass'];

            //chequeamos el numero de intentos para loguearse
                if ($this->_login->check_max_intento_login($user_id) == true) :
                    echo '<div class="alert alert-danger fade in">
                          <strong>Error!</strong> se ha excedido de intentos fallidos su cuenta ha sido bloqueada temporalmente.
                        </div>';
                    exit;
                else:

                    if($this->_login->VerificaPassword($pass, $db_password) == true):

                      if($user['estado'] == 0):

                        echo '<div class="alert alert-danger fade in">
                              <strong>Error!</strong> El usuario no se encuentra activo en el sistema.
                            </div>';
                        exit;

                      else:

                      endif;
                      if($this->_user->set_PerfilUser($user_id)):
                        $perfil = $this->_user->set_PerfilUser($user_id);
                          $_SESSION['perfil']	= $perfil[0]['nombre'];

                      endif;



                        Session::set('autenticado',true);
                        Session::set('user_id',$user['iduser']);
                        Session::set('foto',$user['foto']);
                        Session::set('usuario',$user['usuario']);
                        Session::set('anio',$user['anio']);
                        Session::set('mes',$user['mes']);
                        Session::set('dia',$user['dia']);
                        Session::set('tiempo', time());

                        Core::header(BASE_URL.'admin');

                        else:


                              // La contraseña no es correcta.
                              // Se graba este intento en la base de datos.
                              $this->_login->insertIntentoLogin($user_id);
                              echo '<div class="alert alert-danger fade in">
                              <strong>Error!</strong> La contraseña ingresada no es correcta.
                              </div>';
                              exit;




                        endif;

                endif;
            //end chequeo de intentos para loguearse


           else:
                 echo '<div class="alert alert-danger fade in">
                       <strong>Error!</strong> El correo ingresado no se encuentra asignado a ningun usuario activo.
                     </div>';
                 exit;
             endif;/////fin de la comprobación del correo



              //////////////////////////////////////////////////////////////



         }

}



}?>
