<?php
/**
 *
 */
 class userController extends Controller
 {
   private $_pValida_datosdf;
   private $_user;
   private $_imageresize;
   public $id;
   public $nombre;
   public $usuario;
   public $correo;
   public $estado;
   public $clave;
   public $table_name;
   public $consultar;
   public $registrar;
   public $editar;
   public $eliminar;
   public $id_perfil;
   public $id_usuario_perfil;


      public function __construct()
      {
        //heredar el metodo constructor de la clase padre
        parent::__construct();
        $this->consultar      = array(0);
        $this->registrar      = array(0);
        $this->editar         = array(0);
        $this->eliminar       = array(0);
        $this->table_name = 'user';
        $this->_user = $this->loadModel('user');
        $this->getLibreria('fpdf/','pdfGenerador');
        $this->_pdf = new PDF;

        $this->getLibreria('resizeimage/','ModifiedImage');

      }

      public function index()
    {
        //carga de la vista
        if(isset($_SESSION['user_id'])):
           $this->id = $_SESSION['user_id'];
        else:
            $this->id = 0;
        endif;
        $this->_user->listar_permisos($this->id,ACCESS_VIEW);
        $this->_view->titulo = 'ADMIN | Listado de usuarios';
        $this->_view->user = $this->_user->findAll('user');
        $this->_view->loadView('index','admin');

    }
    public function edit()
    {
      //echo "<pre>".print_r(__METHOD__)."</pre>";
      if(isset($_SESSION['user_id'])):
         $this->id = $_SESSION['user_id'];
      else:
          $this->id = 0;
      endif;
        $this->_view->permisos = $this->_user->listar_permisos($this->id,ACCESS_EDIT);
        $this->id       = filter_input(INPUT_POST,'id', FILTER_SANITIZE_NUMBER_INT);
        $this->nombre   = ucfirst(filter_input(INPUT_POST,'nombre', FILTER_SANITIZE_STRING));
        $this->usuario  = filter_input(INPUT_POST,'usuario', FILTER_SANITIZE_STRING);
        $this->correo   = filter_input(INPUT_POST,'correo', FILTER_SANITIZE_EMAIL);
        $this->clave    = filter_input(INPUT_POST,'pass', FILTER_SANITIZE_STRING);
        $this->id_usuario_perfil = filter_input(INPUT_POST,'id_user_perfil', FILTER_SANITIZE_NUMBER_INT);
        $this->id_perfil = filter_input(INPUT_POST,'id_perfil', FILTER_SANITIZE_NUMBER_INT);


        if (Core::Valida_datos($_POST['update'], 'int') == FALSE):
              Core::header(BASE_URL.'user/usuario/'.$this->id.'/int');

        endif;
       if (Core::Valida_datos($this->nombre, 'nom')== FALSE):
             Core::header(BASE_URL.'user/usuario/'.$this->id.'/nom');

       endif;
      if (Core::Valida_datos($this->usuario, 'user')== FALSE):
            Core::header(BASE_URL.'user/usuario/'.$this->id.'/use');

      endif;
      if (Core::Valida_datos($this->usuario, 'minLength')== TRUE):
          Core::header(BASE_URL.'user/usuario/'.$this->id.'/minLength');

      endif;
      $foto_name            = $_FILES['foto']['name'];
      $foto_user_actual     = $_POST['foto-user'];
      $temp_direc           = $_FILES['foto']['tmp_name'];
      $size                 = $_FILES['foto']['size'];
      $partes               = explode(".",$foto_name);
      $imgExt               = end($partes);
      $user_foto            = rand(1000,1000000).".".$imgExt;
      $extencion            = array("png", "jpg", "jpeg");
      $carpeta              = ROOT. DS."upload/";
      $resp[0] = null;
      $query = 'SELECT
                        iduser,
                        foto,
                        nombre,
                        usuario,
                        correo,
                        pass,
                        estado
                        FROM user
                        WHERE iduser = ?';
      $pass_bd = $this->_user->find($query,$this->id);



      if($this->clave == $pass_bd[0]['pass']):
           $this->clave  = $pass_bd[0]['pass'];
       else:
         //esto genera una contraseña encriptada con una longitud de 60 caracteres .
          $this->clave = password_hash($this->clave, PASSWORD_BCRYPT);
       endif;



      /////////////comprobamos que la variable $foto_name no este vacia////
      if(!empty($foto_name)):
      /////////////comprobamos que el formato de imagen sea el correcto/////
      if(in_array($imgExt, $extencion)):
      /////////////comprobamos que el tamaño de la imagen sea el permitido////////
      if($size < (3024 * 3024)):
        /////////////comprobamos que si la foto del usuario es igual a la de avatar.png/////
        ////en caso de ser asi no procedemos a eliminarla///
         if($foto_user_actual == 'avatar.png'):
            ////no hacemos la eliminación del archivo
         else://en caso contrario de no ser la imagen avatar.png
              /////////////procedemos a verificar que el directorio y archivo sean legibles/////
              //de ser asi procedemos aeliminar el archivo///
           if(is_readable($carpeta.$foto_user_actual)):
                  //eliminamos el archivo//
                 unlink($carpeta.$foto_user_actual);
           endif;
            ///fin de la comprobación de que si es legible el directorio paa eliminar el archivo/////

         endif;
         /////////////fin de la comprobación de que si la imagen es igual a la de avatar.png/////

         ////ahora prodemos a guardar la imagen///////////////
         $this->_imageresize = new ModifiedImage($temp_direc);
         if($this->_imageresize->getWidth() > 150):

             $this->_imageresize->resizeToWidth(350);
             $w150 = $carpeta . $user_foto;
             $this->_imageresize->save($w150);
            //$resp[0] = "imagen guardada";
            else:
              $resp = Core::header(BASE_URL.'user/usuario/'.$this->id.'/error_save_img');
            endif;
        ///////////////////////


      else://en caso contrario enviamos un mensaje
         $resp = Core::header(BASE_URL.'user/usuario/'.$this->id.'/size_img');
      endif;
        /////////////fin de la comprobación del tamaño de imagen///////////

      else://en caso contrario enviamos un mensaje
      $resp = Core::header(BASE_URL.'user/usuario/'.$this->id.'/format_img');
      endif;

      else:
      //si esta vacia la variable $foto_name entonces $foto_name sera igual a la foto_user_actual//
      //que es la que trae de la base de datos//
      $user_foto =  $foto_user_actual;
      endif;
      ////fin de la comprobación que la variable $foto_name no este vacia/////
      if ($this->_user->set_exist_email($this->correo,$this->id) == true):
         Core::header(BASE_URL.'user/usuario/'.$this->id.'/email_exist');
      endif;

      $Query = "UPDATE user
                SET foto = ?,
                nombre = ?,
                usuario = ?,
                correo = ?,
                pass = ?
                WHERE iduser = ?";
      $Paramaters = array($user_foto,
                         $this->nombre,
                         $this->usuario,
                         $this->correo,
                         $this->clave,
                         $this->id);

      if ($this->_user->ExecuteQuery($Query, $Paramaters) == true):

         $Query2 = "UPDATE
                     usuarios_perfiles SET
                     idperfil = ?
                     WHERE usuarios_perfiles.iduser_perfil = ?;";
         $Paramaters2= array($this->id_perfil,$this->id_usuario_perfil);
         if ($this->_user->ExecuteQuery($Query2, $Paramaters2) == true):
             Core::header(BASE_URL.'user/usuario/'.$this->id.'/edit_good');
         else:
            Core::header(BASE_URL.'user/usuario/'.$this->id.'/error_edit');

         endif;



      else:

      Core::header(BASE_URL.'user/usuario/'.$this->id.'/error_edit');

      endif;



      //print_r($resp);
      //var_dump($_POST);
      //echo "<br>";
      //var_dump($_FILES);
    }
    public function usuario()
    {
      if(isset($_SESSION['user_id'])):
         $this->id = $_SESSION['user_id'];
      else:
          $this->id = 0;
      endif;
      $this->_view->permisos = $this->_user->listar_permisos($this->id,ACCESS_VIEW);
      $Id_User = Core::obtenerIdUrl();
      $this->_view->user_perfiles = $this->_user->set_PerfilUser($Id_User);
      $this->_view->perfiles = $this->_user->findAll('perfiles');
      //print_r($this->_view->user_perfiles);
      $this->_view->usuario_peril = $this->_user->set_Usuarios_Perfiles($Id_User);
      //print_r($this->_view->usuario_peril);

      $this->_view->permisos = $this->_user->listar_permisos($this->id,ACCESS_VIEW);

        //echo   $Id_User;
        $query = 'SELECT
                           iduser,
                           foto,
                           nombre,
                           usuario,
                           correo,
                           pass,
                           estado
                           FROM user
                           WHERE iduser = ?';
        $this->_view->user = $this->_user->find($query,$Id_User);
        //$this->_view->permisos = $this->_user->listar_permisos($_SESSION['user_id'],1);
        $this->_view->titulo = 'ADMIN | usuario';
        $this->_view->loadView('usuario','admin');
     }

     public function add()
     {
        if(isset($_SESSION['user_id'])):
          $this->id = $_SESSION['user_id'];
       else:
           $this->id = 0;
       endif;
        $this->_view->permisos = $this->_user->listar_permisos($this->id,ACCESS_CREATE);
        $this->_view->perfiles = $this->_user->findAll('perfiles');
       if (isset($_POST)&& !empty($_POST)) {
         //procedemos a guardar los datos
         //print_r($_POST);
      $this->nombre = ucfirst(filter_input(INPUT_POST,'nombre', FILTER_SANITIZE_STRING));
      $this->usuario = filter_input(INPUT_POST,'usuario', FILTER_SANITIZE_STRING);
      $this->correo = filter_input(INPUT_POST,'correo', FILTER_SANITIZE_EMAIL);
      $this->clave  = filter_input(INPUT_POST,'pass', FILTER_SANITIZE_STRING);
      $this->estado = filter_input(INPUT_POST,'estado', FILTER_SANITIZE_NUMBER_INT);
      $this->id_perfil = filter_input(INPUT_POST,'id_perfil', FILTER_SANITIZE_NUMBER_INT);
      $this->clave = password_hash($this->clave, PASSWORD_BCRYPT);

      $foto_name            = $_FILES['foto']['name'];
      $foto_user_actual     = $_POST['foto-user'];
      $temp_direc           = $_FILES['foto']['tmp_name'];
      $size                 = $_FILES['foto']['size'];
      $partes               = explode(".",$foto_name);
      $imgExt               = end($partes);
      $user_foto            = rand(1000,1000000).".".$imgExt;
      $extencion            = array("png", "jpg", "jpeg");
      $carpeta              = ROOT. DS."upload/";

        if(!empty($foto_name)):
            $foto = $user_foto;
            /////////////comprobamos que el formato de imagen sea el correcto/////
            if(in_array($imgExt, $extencion)):
              /////////////comprobamos que el tamaño de la imagen sea el permitido////////
                if($size < (3024 * 3024)):
                  ////ahora prodemos a guardar la imagen///////////////
                   $this->_imageresize = new ModifiedImage($temp_direc);
                   if($this->_imageresize->getWidth() > 100):

                       $this->_imageresize->resizeToWidth(250);
                       $w150 = $carpeta . $user_foto;
                       $this->_imageresize->save($w150);
                      //$resp[0] = "imagen guardada";
                      else:
                        $resp = Core::header(BASE_URL.'user/add/error_save_img');
                      endif;
                  ///////////////////////


                else://en caso contrario enviamos un mensaje
                   $resp = Core::header(BASE_URL.'user/add/size_img');
                endif;
                  /////////////fin de la comprobación del tamaño de imagen///////////

            else://en caso contrario enviamos un mensaje
                $resp = Core::header(BASE_URL.'user/add/format_img');
            endif;
        else:
           $foto = $foto_user_actual;

       endif;

       if ($this->_user->set_verifi_email_bd($this->correo) == true):
          Core::header(BASE_URL.'user/add/email_exist');
       endif;
       $Query = "INSERT INTO user
                  (iduser, foto, nombre, usuario, correo, pass,estado, created, modified)
                  VALUES
                  (NULL, ?, ?, ?, ?, ?, ?, NULL, NULL)";
       $Paramaters = array($foto,
                           $this->nombre,
                           $this->usuario,
                           $this->correo,
                           $this->clave,
                           $this->estado);
       if ($this->_user->ExecuteQuery($Query, $Paramaters) == true):
         $id_User = $this->_user->SelectMaxId('user');
         $Query = "INSERT INTO usuarios_perfiles (iduser_perfil, id_user, idperfil) VALUES (NULL, ?, ?)";
         $Paramaters = array($id_User,$this->id_perfil);
         if($this->_user->ExecuteQuery($Query, $Paramaters) == true):
              Core::header(BASE_URL.'user/add_good');
           else:
               Core::header(BASE_URL.'user/error_add');

           endif;

     endif;

       } else {

          $this->_view->titulo = 'ADMIN | Agregar Nuevo Usuario';
          $this->_view->loadView('add','admin');
       }



     }

     public function delete()
     {
        if(isset($_SESSION['user_id'])):
          $this->id_sesion = $_SESSION['user_id'];
       else:
           $this->id_sesion = 0;
       endif;
        $this->_view->permisos = $this->_user->listar_permisos( $this->id_sesion ,ACCESS_DELETE);
        $this->id_user =  Core::obtenerIdUrl();
        if($this->id_user == $this->id_sesion):
          Core::header(BASE_URL.'user/user_active');
        else:

           $Query = "UPDATE " . $this->table_name . " SET estado = '0'  WHERE iduser = ?";
          $Paramaters = array($this->id);
           if ($this->_user->ExecuteQuery($Query, $Paramaters) == true):

            Core::header(BASE_URL.'user/good');

        else:

          Core::header(BASE_URL.'user/error');

        endif;

        endif;



     }
     
 }
 ?>
