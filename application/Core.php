<?php

/**
 *
 */
class Core
{

  public static function alert($text){
		echo "<script>alert('".$text."');</script>";
	}

  public static function redir($url){
  echo "<script>window.location='".$url."';</script>";
}

  public static function header($url){
    header("Location:".strip_tags($url)."");exit;
  }



  public static function loadJS($dir,$fileJs)
  {
    /*$handle=opendir($dir);
		if($handle){
			while (false !== ($entry = readdir($handle)))  {
				if($entry!="."){
					$dirc_file = $dir.$entry;
				if(!is_dir($dirc_file)){

            echo  '<script type="text/javascript" src="'.BASE_URL.$dirc_file.'"></script>'. "\n";
					}
				}
			}
		closedir($handle);
  }*/
  $html = '';
  foreach( $fileJs as $value):
    $file_js = BASE_URL.$dir.$value.'.js';
    $script = '<script type="text/javascript" src="'.$file_js. '"></script>'. "\n";
    print_r($script);
  endforeach;


  }

  public static function loadCSS($dir,$fileCss)
  {
    /*$handle=opendir($dir);
    if($handle){
      while (false !== ($entry = readdir($handle)))  {
        if($entry!="." && $entry!=".."){
          $dirc_file = $dir.$entry;
        if(!is_dir($dirct_file)){
            echo "<link rel='stylesheet' type='text/css' href='".BASE_URL.$dirc_file."' />"."\n";
          }
        }
      }
    closedir($handle);
  }*/

  $html = '';
  foreach( $fileCss as $value):
    $file_css = BASE_URL.$dir.$value.'.css';
    $style = '<link href="'.$file_css . '" rel="stylesheet">' . "\n";
    print_r($style);
  endforeach;



  }
  public  static function VerificaPassword($password, $hashedPassword)
	  {


	       if(password_verify($password, $hashedPassword) ):

	       return true;

	       	else:

	       	return false;


	       endif;

	  }

  public static function obtenerId($url)
  {

    if (isset($url)) {
    $url = filter_input(INPUT_GET, 'url',FILTER_SANITIZE_URL);
    $url = explode('/', $url);
    $url = array_filter($url);
    //$id = array_slice($url, -2, 1);
    $id = array_pop($url);
    return $id;

    }
  }

  public static function obtenerIdUrl()
  {
    $url = filter_input(INPUT_GET, 'url',FILTER_SANITIZE_URL);
    $url = explode('/', $url);
    $REQUEST_URI = explode("/",$_SERVER["REQUEST_URI"]);
    $total = count($REQUEST_URI);
    //echo $total;
  switch ($total) {
       case '5':
         return $Id_User = array_values($url)[2];
         break;
       case '6':
         return $Id_User = array_values($url)[2];
         break;
       default:
         Core::header(BASE_URL.'error/index/404');
         break;
     }
  }
  public static function error_get($error = null)
  {


      switch ($error) {
        case 'int':
        echo '<div class="alert alert-danger fade in">
                 <strong>Error!</strong> no es un entero.
               </div>';
          break;

          case 'email':
          echo '<div class="alert alert-danger fade in">
                   <strong>Error!</strong> El correo no es valido.
                 </div>';
            break;

            case 'estado':
            echo '<div class="alert alert-danger fade in">
                     <strong>Error!</strong> Debe seleccionar un estado.
                   </div>';
              break;

          case 'nom':
          echo '<div class="alert alert-danger fade in">
                   <strong>Error!</strong> El nombre no es valido.
                 </div>';
            break;
            case 'ape':
            echo '<div class="alert alert-danger fade in">
                     <strong>Error!</strong> El apellido no es valido.
                   </div>';
              break;
            case 'use':
            echo '<div class="alert alert-danger fade in">
                     <strong>Error!</strong> El nombre de usuario no es valido.
                   </div>';
              break;
              case 'minLength':
              echo '<div class="alert alert-danger fade in">
                       <strong>Error!</strong> El nombre de usuario debe tener un minimo de 3 caracteres.
                     </div>';
                break;

                case 'format_img':
                echo '<div class="alert alert-danger fade in">
                         <strong>Error!</strong> Disculpe solo se permite la subida de imagenes con la extenciones png, jpg y jpeg.Por favor compruebe que sean las extenciones correctas y que no esten escritas en mayusculas.
                       </div>';
                  break;

                  case 'size_img':
                  echo '<div class="alert alert-danger fade in">
                           <strong>Error!</strong> Disculpe solo se permite la subida de imagenes con un tamaño maximo de 3 megabyte.
                         </div>';
                    break;

                    case 'error_save_img':
                    echo '<div class="alert alert-danger fade in">
                             <strong>Error!</strong>A ocurrido un error y no se pudo guardar la imagen.
                           </div>';
                      break;

                      case 'edit_good':
                      echo '<div class="alert alert-success fade in">
                               <strong>Bien</strong> Los datos se actualizaron correctamente.
                             </div>';
                        break;

                        case 'add_good':
                        echo '<div class="alert alert-success fade in">
                                 <strong>Bien</strong> Se realizo el registro correctamente.
                               </div>';
                          break;

                        case 'error_edit':
                        echo '<div class="alert alert-danger fade in">
                                 <strong>Error!</strong>Los datos no pudieron ser actualizados.
                               </div>';
                          break;
                          case 'error_add':
                          echo '<div class="alert alert-danger fade in">
                                   <strong>Error!</strong>A ocurrido un error el registro no pudo se completado.
                                 </div>';
                            break;
                            case 'good':
                            echo '<div class="alert alert-success fade in">
                                     <strong>Bien!</strong> La solicitud se ha realizado con exito.
                                   </div>';
                              break;
                              case 'error':
                              echo '<div class="alert alert-danger fade in">
                                       <strong>Error!</strong>A ocurrido un error la petición no pudo ser completada.
                                     </div>';
                                break;
                                case 'email_exist':
                                echo '<div class="alert alert-danger fade in">
                                         <strong>Error!</strong>El correo ya se encuentra asignado a un usuario.
                                       </div>';
                                  break;
                                  case 'cod_exits':
                                  echo '<div class="alert alert-danger fade in">
                                           <strong>Error!</strong>El codigo introducido ya se encuentra asignado a un bien.
                                         </div>';
                                    break;
                                  case 'count_rec':
                                  echo '<div class="alert alert-danger fade in">
                                           <strong>Error!</strong>Debe seleccionar todos los recursos para luego seleccionar las acciones que requiera el perfil.
                                         </div>';
                                    break;
                                    case 'perfil_user':
                                    echo '<div class="alert alert-danger fade in">
                                             <strong>Error! Operación denegada</strong> El perfil no puede ser eliminado ya que encuentra asociado a un usuario.
                                           </div>';
                                      break;
                                      case 'user_active':
                                      echo '<div class="alert alert-danger fade in">
                                               <strong>Error! Operación denegada</strong> El usuario que intenta eliminar tiene una sesion activa en el sistema.
                                             </div>';
                                        break;
                                        case 'cat_active':
                                        echo '<div class="alert alert-danger fade in">
                                                 <strong>Error! Operación denegada</strong> existen bienes activos asociados a esta categoria,por lo tanto
                                                 esta categoria no pueden estar inactiva.
                                               </div>';
                                          break;

                                          case 'unid_active':
                                          echo '<div class="alert alert-danger fade in">
                                                   <strong>Error! Operación denegada</strong> existen bienes activos asociados a esta unidad,por lo tanto
                                                   esta unidad no pueden estar inactiva.
                                                 </div>';
                                            break;
                                            case 'func_asoc_bien_activ':
                                            echo '<div class="alert alert-danger fade in">
                                                     <strong>Error! Operación denegada</strong> existen uno o mas  bienes activos asociados a este funcionario,por lo tanto
                                                     este no puede ser dado de baja por el sistema.
                                                   </div>';
                                              break;
                                              case 'cod_cargo_exists':
                                              echo '<div class="alert alert-danger fade in">
                                                       <strong>Error! Operación denegada</strong> El codigo introducido ya se encuentra asignado a un funcionario.
                                                     </div>';
                                                break;



        default:
          # code...
          break;
      }


  }
  public static function Valida_datos($input, $type) {
    switch ($type) {
      case 'int':
        if (!filter_var($input, FILTER_VALIDATE_INT)) {
          $output = FALSE;
        } else {
          $output = TRUE;
        }
        break;

        case 'nom':
          if (empty('nom') || !filter_var($input, FILTER_VALIDATE_REGEXP,array(
             "options" => array("regexp"=>"/^[a-zñáéíóúA-ZÑÁÉÍÓÚ]+$/")
        ))) {
            $output = FALSE;
          } else {
            $output = TRUE;
          }
          break;

          case 'ape':
            if (empty('ae') || !filter_var($input, FILTER_VALIDATE_REGEXP,array(
               "options" => array("regexp"=>"/^[a-zñáéíóúA-ZÑÁÉÍÓÚ]+$/")
          ))) {
              $output = FALSE;
            } else {
              $output = TRUE;
            }
            break;

          case 'user':
            if (empty('user') || !filter_var($input, FILTER_VALIDATE_REGEXP,array(
               "options" => array("regexp"=>"/^[a-z0-9ñáéíóúA-ZÑÁÉÍÓÚ_]+$/")
          ))) {
              $output = FALSE;
            } else {
              $output = TRUE;
            }
            break;

            case 'maxLength':
              if (strlen(trim($input)) < 10 ) {
                $output = TRUE;
              } else {
                $output = FALSE;
              }
              break;

              case 'minLength':
                if (strlen(trim($input)) < 3 ) {
                  $output = TRUE;
                } else {
                  $output = FALSE;
                }
                break;

              case 'email':
                if (empty('email') || filter_var($input, FILTER_VALIDATE_EMAIL ) ) {
                  $output = TRUE;
                } else {
                  $output = FALSE;
                }
                break;

                case 'estado':
                  if (trim($input) === '') {
                    $output = FALSE;
                  } else {
                    $output = TRUE;
                  }
                  break;

      default:
        # code...
        break;
    }

    return $output;
}

}
