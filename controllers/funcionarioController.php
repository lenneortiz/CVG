<?php
/**
 *
 */
class funcionarioController extends controller
{
  public $cedula;
  public $nombre1;
  public $nombre2;
  public $apellido1;
  public $apellido2;
  public $fecha_nac;
  public $fecha_ing;
  public $estado;
  public $grado_instruc;
  public $profesion;
  public $codigo_cargo;
  public $descrip_cargo;
  public $func_inhe_cargo;
  public $odi;
  public $observacion;
  public $id_unidad_adscripta;
  public $info_complentaria;
  public $table_name;
  private $_imageresize;
  private $id_funcionario;


  function __construct()
  {
    parent::__construct();
    $this->table_name = "funcionarios";
    $this->_user = $this->loadModel('user');
    $this->_funcionario = $this->loadModel('funcionario');
    $this->_unidad = $this->loadModel('unidades');
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

       //////////******Mostrar todos los funcionarios*****///////////////////////////

       $this->_view->titulo ="ADMIN | area de Funcionarios";
       $this->_view->funcionarios = $this->_funcionario->get_funcionarios();
       //print_r($this->_view->funcionarios);
       $this->_view->loadView('index','admin');



  }

  public function funcionario()
  {
    if(isset($_SESSION['user_id'])):
       $this->id = $_SESSION['user_id'];
    else:
        $this->id = 0;
    endif;
    $this->_view->permisos = $this->_user->listar_permisos($this->id,ACCESS_VIEW);
    $this->_view->unidades = $this->_unidad->get_all_active_unidades();
    $this->id_funcionario = Core::obtenerIdUrl();

      //echo   $Id_User;
      $query = 'SELECT
                F.id_funcionario,
                F.cedula,
                F.foto,
                F.nombre1,
                F.nombre2,
                F.apellido1,
                F.apellido2,
                DATE_FORMAT(F.fec_nac,"%d-%m-%Y") AS fec_nac,
                DATE_FORMAT(F.fec_ingreso,"%d-%m-%Y") AS fec_ingreso,
                F.estado,
                F.grado_intruccion,
                F.profesion,
                F.code_cargo,
                F.descrip_cargo,
                F.func_inhe_cargo,
                F.obj_desemp_individual,
                F.id_unidad_adscripta,
                F.info_complentaria,
                DATE_FORMAT(F.modified,"%d-%m-%Y") AS fec_modified,
                DATE_FORMAT(F.created,"%d-%m-%Y") AS fec_created,
                U.nombre AS unidad,
                OB.observacion
                FROM funcionarios F
                INNER JOIN unidad_adscripta U ON F.id_unidad_adscripta = U.id_unidad_adscripta
                INNER JOIN observacion_funcionario OB ON F.id_funcionario = OB.id_funcionario
                WHERE F.id_funcionario = ?';
      $this->_view->funcionario = $this->_funcionario->find($query,$this->id_funcionario);
      //print_r($this->_view->funcionario);
      $this->_view->titulo = 'ADMIN | Funcionario';
      $this->_view->loadView('funcionario','admin');
   }


  public function add()
  {

    if(isset($_SESSION['user_id'])):
      $this->id = $_SESSION['user_id'];
   else:
       $this->id = 0;
   endif;
    $this->_view->permisos = $this->_user->listar_permisos($this->id,ACCESS_CREATE);
    $this->_view->unidades = $this->_unidad->get_all_active_unidades();

    if(isset($_POST['add']) && $_POST['add'] == 1):
      //echo "<pre>";
      //print_r($_POST);

      $this->cedula               = ucfirst(filter_input(INPUT_POST,'cedula', FILTER_SANITIZE_NUMBER_INT));
      $this->nombre1              = ucfirst(filter_input(INPUT_POST,'nombre1', FILTER_SANITIZE_STRING));
      $this->nombre2              = ucfirst(filter_input(INPUT_POST,'nombre2', FILTER_SANITIZE_STRING));
      $this->apellido1            = ucfirst(filter_input(INPUT_POST,'apellido1', FILTER_SANITIZE_STRING));
      $this->apellido2            = ucfirst(filter_input(INPUT_POST,'apellido2', FILTER_SANITIZE_STRING));
      $this->fecha_nac            = filter_input(INPUT_POST,'fecha_nac', FILTER_SANITIZE_STRING);
      $this->fecha_ing            = filter_input(INPUT_POST,'fecha_ing', FILTER_SANITIZE_STRING);
      $this->estado               = filter_input(INPUT_POST,'estado', FILTER_SANITIZE_STRING);
      $this->grado_instruc        = filter_input(INPUT_POST,'grado_instruc', FILTER_SANITIZE_STRING);
      $this->profesion            = filter_input(INPUT_POST,'profesion', FILTER_SANITIZE_STRING);
      $this->codigo_cargo         = mb_strtoupper(trim(filter_input(INPUT_POST,'codigo_cargo', FILTER_SANITIZE_STRING)));
      $this->descrip_cargo        = filter_input(INPUT_POST,'descrip_cargo', FILTER_SANITIZE_STRING);
      $this->func_inhe_cargo      = filter_input(INPUT_POST,'func_inhe_cargo', FILTER_SANITIZE_STRING);
      $this->odi                  = filter_input(INPUT_POST,'odi', FILTER_SANITIZE_STRING);
      $this->observacion          = filter_input(INPUT_POST,'observacion', FILTER_SANITIZE_STRING);
      $this->id_unidad_adscripta  = filter_input(INPUT_POST,'id_unidad_adscripta', FILTER_SANITIZE_NUMBER_INT);
      $this->info_complentaria    = filter_input(INPUT_POST,'info_complentaria', FILTER_SANITIZE_STRING);

      /*if (Core::Valida_datos($this->nombre, 'nom')== FALSE):
            Core::header(BASE_URL.'funcionario/add/nom');

      endif;
      if (Core::Valida_datos($this->apellido, 'ape')== FALSE):
            Core::header(BASE_URL.'funcionario/add/ape');

      endif;
      if (Core::Valida_datos($this->correo, 'email')== FALSE):
            Core::header(BASE_URL.'funcionario/add/email');

      endif;
      if (Core::Valida_datos($this->correo, 'estado')== FALSE):
            Core::header(BASE_URL.'funcionario/add/estado');

      endif;*/



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
                 if($this->_imageresize->getWidth() > 250):
                   $this->_imageresize->resizeToWidth(250);
                   $w150 = $carpeta . $user_foto;
                   $this->_imageresize->save($w150);

                   elseif ($this->_imageresize->getWidth() > 100):

                   $this->_imageresize->resizeToWidth(100);
                   $w150 = $carpeta . $user_foto;
                   $this->_imageresize->save($w150);

                   else:
                     Core::header(BASE_URL.'funcionario/add/error_save_img');
                   endif;



              else://en caso contrario enviamos un mensaje
                  Core::header(BASE_URL.'funcionario/add/size_img');
              endif;
                /////////////fin de la comprobación del tamaño de imagen///////////

          else://en caso contrario enviamos un mensaje
              Core::header(BASE_URL.'funcionario/add/format_img');
          endif;
      else:
         $foto = $foto_user_actual;

     endif;

     $Query="SELECT code_cargo FROM funcionarios WHERE code_cargo = ? ;";
     $Paramaters = array($this->codigo_cargo);
     if($this->_funcionario->SearchQuery($Query, $Paramaters) == true):
       Core::header(BASE_URL.'funcionario/add/cod_cargo_exists');
     else:

         $Query = "INSERT INTO funcionarios
                    (id_funcionario,
                    cedula,
                    foto,
                    nombre1,
                    nombre2,
                    apellido1,
                    apellido2,
                    fec_nac,
                    fec_ingreso,
                    estado,
                    grado_intruccion,
                    profesion,
                    code_cargo,
                    descrip_cargo,
                    func_inhe_cargo,
                    obj_desemp_individual,
                    id_unidad_adscripta,
                    info_complentaria,
                    created,
                    modified)
                    VALUES
                    (NULL,?, ?, ?, ?, ?, ?, STR_TO_DATE(?, '%d-%m-%Y'), STR_TO_DATE(?, '%d-%m-%Y'), ?, ?, ?,?, ?, ?, ?, ?,?, NULL, NULL)";
         $Paramaters = array($this->cedula,
                             $foto,
                             $this->nombre1,
                             $this->nombre2,
                             $this->apellido1,
                             $this->apellido2,
                             $this->fecha_nac,
                             $this->fecha_ing,
                             $this->estado,
                             $this->grado_instruc,
                             $this->profesion,
                             $this->codigo_cargo,
                             $this->descrip_cargo,
                             $this->func_inhe_cargo,
                             $this->odi,
                             $this->id_unidad_adscripta,
                             $this->info_complentaria);
       if ($this->_user->ExecuteQuery($Query, $Paramaters) == true):

         ////////////////////////////////////////

         $id_funcionario = $this->_funcionario->SelectMaxId('funcionarios');
         $Query = "INSERT INTO observacion_funcionario (id_observacion_funcionario, id_funcionario, observacion) VALUES (NULL, ?, ?)";
         $Paramaters = array($id_funcionario,$this->observacion);
         if($this->_funcionario->ExecuteQuery($Query, $Paramaters) == true):
              Core::header(BASE_URL.'funcionario/add_good');
           else:
               Core::header(BASE_URL.'funcionario/error_add');

           endif;

         //////////////////////////////////////////



       else:
         Core::header(BASE_URL.'funcionario/error_add');

       endif;

   endif;


    else:
      $this->_view->titulo = 'ADMIN | area de registro de Funcionario ';
      $this->_view->loadView('add','admin');
    endif;
  }

public function edit()
{
  if(isset($_SESSION['user_id'])):
     $this->id = $_SESSION['user_id'];
  else:
      $this->id = 0;
  endif;
    $this->_view->permisos = $this->_user->listar_permisos($this->id,ACCESS_EDIT);

    $this->id_funcionario       = filter_input(INPUT_POST,'id', FILTER_SANITIZE_NUMBER_INT);
    $this->cedula               = ucfirst(filter_input(INPUT_POST,'cedula', FILTER_SANITIZE_NUMBER_INT));
    $this->nombre1              = ucfirst(filter_input(INPUT_POST,'nombre1', FILTER_SANITIZE_STRING));
    $this->nombre2              = ucfirst(filter_input(INPUT_POST,'nombre2', FILTER_SANITIZE_STRING));
    $this->apellido1            = ucfirst(filter_input(INPUT_POST,'apellido1', FILTER_SANITIZE_STRING));
    $this->apellido2            = ucfirst(filter_input(INPUT_POST,'apellido2', FILTER_SANITIZE_STRING));
    $this->fecha_nac            = filter_input(INPUT_POST,'fecha_nac', FILTER_SANITIZE_STRING);
    $this->fecha_ing            = filter_input(INPUT_POST,'fecha_ing', FILTER_SANITIZE_STRING);
    $this->estado               = filter_input(INPUT_POST,'estado', FILTER_SANITIZE_STRING);
    $this->grado_instruc        = filter_input(INPUT_POST,'grado_instruc', FILTER_SANITIZE_STRING);
    $this->profesion            = filter_input(INPUT_POST,'profesion', FILTER_SANITIZE_STRING);
    $this->codigo_cargo         = mb_strtoupper(trim(filter_input(INPUT_POST,'codigo_cargo', FILTER_SANITIZE_STRING)));
    $this->descrip_cargo        = filter_input(INPUT_POST,'descrip_cargo', FILTER_SANITIZE_STRING);
    $this->func_inhe_cargo      = filter_input(INPUT_POST,'func_inhe_cargo', FILTER_SANITIZE_STRING);
    $this->odi                  = filter_input(INPUT_POST,'odi', FILTER_SANITIZE_STRING);
    $this->observacion          = filter_input(INPUT_POST,'observacion', FILTER_SANITIZE_STRING);
    $this->id_unidad_adscripta  = filter_input(INPUT_POST,'id_unidad_adscripta', FILTER_SANITIZE_NUMBER_INT);
    $this->info_complentaria    = filter_input(INPUT_POST,'info_complentaria', FILTER_SANITIZE_STRING);

    /*if (Core::Valida_datos($this->nombre, 'nom')== FALSE):
        Core::header(BASE_URL.'funcionario/funcionario/'.$this->id_funcionario.'/nom');
       exit;
    endif;
    if (Core::Valida_datos($this->apellido, 'ape')== FALSE):
          Core::header(BASE_URL.'funcionario/funcionario/'.$this->id_funcionario.'/ape');
       exit;
    endif;
    if (Core::Valida_datos($this->correo, 'email')== FALSE):
          Core::header(BASE_URL.'funcionario/funcionario/'.$this->id_funcionario.'/email');
       exit;
    endif;
    if (Core::Valida_datos($this->correo, 'estado')== FALSE):
          Core::header(BASE_URL.'funcionario/funcionario/'.$this->id_funcionario.'/estado');
       exit;
    endif;*/

    $foto_name            = $_FILES['foto']['name'];
    $foto_user_actual     = $_POST['foto-user'];
    $temp_direc           = $_FILES['foto']['tmp_name'];
    $size                 = $_FILES['foto']['size'];
    $partes               = explode(".",$foto_name);
    $imgExt               = end($partes);
    $user_foto            = rand(1000,1000000).".".$imgExt;
    $extencion            = array("png", "jpg", "jpeg");
    $carpeta              = ROOT. DS."upload/";

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
            $resp = Core::header(BASE_URL.'funcionario/funcionario/'.$this->id_funcionario.'/error_save_img');
          endif;
      ///////////////////////


    else://en caso contrario enviamos un mensaje
       $resp = Core::header(BASE_URL.'funcionario/funcionario/'.$this->id_funcionario.'/size_img');
    endif;
      /////////////fin de la comprobación del tamaño de imagen///////////

    else://en caso contrario enviamos un mensaje
    $resp = Core::header(BASE_URL.'funcionario/funcionario/'.$this->id_funcionario.'/format_img');
    endif;

    else:
    //si esta vacia la variable $foto_name entonces $foto_name sera igual a la foto_user_actual//
    //que es la que trae de la base de datos//
    $user_foto =  $foto_user_actual;
    endif;
    ////fin de la comprobación que la variable $foto_name no este vacia/////

    $Query = "UPDATE funcionarios
              SET cedula = ?,
              foto = ?,
              nombre1 = ?,
              nombre2 = ?,
              apellido1 = ?,
              apellido2 = ?,
              fec_nac = STR_TO_DATE(?, '%d-%m-%Y'),
              fec_ingreso = STR_TO_DATE(?, '%d-%m-%Y'),
              estado = ?,
              grado_intruccion = ?,
              profesion = ?,
              descrip_cargo = ?,
              func_inhe_cargo = ?,
              obj_desemp_individual = ?,
              id_unidad_adscripta = ?,
              info_complentaria = ?
              WHERE id_funcionario = ?";
    $Paramaters = array($this->cedula,
                        $user_foto,
                        $this->nombre1,
                        $this->nombre2,
                        $this->apellido1,
                        $this->apellido2,
                        $this->fecha_nac,
                        $this->fecha_ing,
                        $this->estado,
                        $this->grado_instruc,
                        $this->profesion,
                        $this->descrip_cargo,
                        $this->func_inhe_cargo,
                        $this->odi,
                        $this->id_unidad_adscripta,
                        $this->info_complentaria,
                        $this->id_funcionario);

    if ($this->_user->ExecuteQuery($Query, $Paramaters) == true):

        //////////////////////////////////////////////////////////////////
        $Query = "UPDATE  observacion_funcionario SET observacion = ? WHERE id_funcionario = ?";
        $Paramaters = array($this->id_funcionario,$this->observacion);
        if($this->_funcionario->ExecuteQuery($Query, $Paramaters) == true):
             Core::header(BASE_URL.'funcionario/funcionario/'.$this->id_funcionario.'/edit_good');
          else:
              Core::header(BASE_URL.'funcionario/funcionario/'.$this->id_funcionario.'/error_edit');

          endif;



        //////////////////////////////////////////////////////////////////
      else:
        Core::header(BASE_URL.'funcionario/funcionario/'.$this->id_funcionario.'/error_edit');
      endif;

}
  public function delete()
  {
    if(isset($_SESSION['user_id'])):
      $this->id_session = $_SESSION['user_id'];
   else:
       $this->id = 0;
   endif;
    $this->_view->permisos = $this->_user->listar_permisos( $this->id_session ,ACCESS_DELETE);
    $this->id_funcionario =  Core::obtenerIdUrl();

    $Query="SELECT
            id_funcionario
            FROM bienes B
            WHERE B.id_funcionario = ? AND B.estado <> 0;";
    $Paramaters = array($this->id_funcionario);
    if($this->_funcionario->SearchQuery($Query, $Paramaters) == true):
      Core::header(BASE_URL.'funcionario/func_asoc_bien_activ');
    else:
      $Query = "UPDATE " . $this->table_name . " SET estado = '0'  WHERE id_funcionario = ?";
      $Paramaters = array($this->id_funcionario);
      if ($this->_funcionario->ExecuteQuery($Query, $Paramaters) == true):
        Core::header(BASE_URL.'funcionario/good');
      else:
        Core::header(BASE_URL.'funcionario/error');
      endif;

    endif;

  }
}
