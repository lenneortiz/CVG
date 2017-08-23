<?php /**
 *
 */
class permisoController extends Controller
{
  private $_perfil;
  public $table_name;
  public $nombre;
  public $consultar;
  public $registrar;
  public $editar;
  public $eliminar;
  public $reporte;
  public $id_perfil;
  public $id_usuario_perfil;

  function __construct()
  {
    parent::__construct();
      $this->_perfil = $this->loadModel('perfil');
      $this->_permiso = $this->loadModel('permiso');
      $this->_user = $this->loadModel('user');
      $this->table_name = "perfiles";
  }


public function index()
{
  if(isset($_SESSION['user_id'])):
       $this->id = $_SESSION['user_id'];
    else:
        $this->id = 0;
    endif;
    $this->_user->listar_permisos($this->id,ACCESS_CREATE);

  if (isset($_POST) && !empty($_POST)) {
    $this->id_perfil = $_POST['id_perfil'];

      ////////////////////////////////////////////
    if (!isset($_POST['consultar']) ) {
        $this->consultar = 0;
          //print_r($consultar);
    } else {
      $this->consultar = $_POST['consultar'];
    }

    ////////////////////////////////////////////

      if (!isset($_POST['registrar']) ) {
          $this->registrar = 0;
            //print_r($consultar);
      } else {
        $this->registrar = $_POST['registrar'];
      }
    //////////////////////////////////////////

    ////////////////////////////////////////////

      if (!isset($_POST['editar']) ) {
          $this->editar = 0;
            //print_r($consultar);
      } else {
        $this->editar = $_POST['editar'];
      }
    //////////////////////////////////////////

    ////////////////////////////////////////////

      if (!isset($_POST['eliminar']) ) {
          $this->eliminar = 0;
            //print_r($consultar);
      } else {
        $this->eliminar = $_POST['eliminar'];
      }
    //////////////////////////////////////////

    ////////////////////////////////////////////

      if (!isset($_POST['reporte']) ) {
          $this->reporte = 0;
            //print_r($consultar);
      } else {
        $this->reporte = $_POST['reporte'];
      }
    //////////////////////////////////////////



     if($this->_permiso->Insert_Multiple_Permisos($this->consultar,$this->registrar,$this->editar,$this->eliminar,$this->reporte,$this->id_perfil)== true):
       Core::header(BASE_URL.'permiso/good');
     endif;


  } else {
    if(isset($_SESSION['user_id'])):
         $this->id = $_SESSION['user_id'];
      else:
          $this->id = 0;
      endif;
      $this->_user->listar_permisos($this->id,ACCESS_VIEW);
      $this->_view->perfiles = $this->_permiso->findAll('perfiles');
      $this->_view->recursos = $this->_permiso->findAll('recursos');
      //print_r($this->_view->perfiles);
     $this->_view->titulo = 'ADMIN | Area de administrasción de permisos';
     $this->_view->loadView('index','admin');
  }
}
  
  public function edit()
  {
    if(isset($_SESSION['user_id'])):
         $this->id = $_SESSION['user_id'];
      else:
          $this->id = 0;
      endif;
      $this->_user->listar_permisos($this->id,ACCESS_VIEW);
      $this->_view->perfiles = $this->_permiso->findAll('perfiles');
      //$this->_view->recursos = $this->_permiso->findAll('recursos');
      //print_r($this->_view->perfiles);
     $this->_view->titulo = 'ADMIN | Area de actualización de permisos';
     $this->_view->loadView('edit','admin');

  }

  public function permisos_perfiles()
  {
    $this->id_perfil = $_POST['idperfil'];
    //echo $this->id_perfil;
    $query = 'SELECT consultar,agregar,editar,eliminar,reporte FROM perfiles_recursos
    WHERE idperfil = ?';
    $permisos = $this->_user->find($query,$this->id_perfil);
if($permisos):
  foreach($permisos as $permiso):

    $datos = implode(",", $permiso);
    $recursos = str_split($datos);

  endforeach;

  $uno    = (in_array(1, $recursos)?'checked="checked"':'');
  $dos    = (in_array(2, $recursos)?'checked="checked"':'');
  $tres   = (in_array(3, $recursos)?'checked="checked"':'');
  $cuatro = (in_array(4, $recursos)?'checked="checked"':'');
  $cinco  = (in_array(5, $recursos)?'checked="checked"':'');



  $html= '
  <div class="clearfix"></div><br>
  <div class="col-md-4">
  <label class="btn btn-danger"><input type="checkbox" id="checkAll"/> Marcar Todo</label>
  </div>
  <div class="clearfix"></div><br>
  <div class="col-md-12"></div>

  <div class="col-md-2">
    <div class="btn-group btn-group-justified" role="group" aria-label="...">
      <div class="btn-group" role="group">
        <button type="button" class="btn btn-success"><p>Consultar</p></button>
      </div>
    </div>

      <div class="checkbox">
      <label>
         &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
        <input class="checkItem" type="checkbox" name="consultar" value="1" '.$uno.'>
       <div style="padding:1.2em">
         &nbsp;
       </div>
      </label>
    </div>

  </div>

  <div class="col-md-2">
    <div class="btn-group btn-group-justified" role="group" aria-label="...">
      <div class="btn-group" role="group">
        <button type="button" class="btn btn-success"><p>Registrar</p></button>
      </div>
    </div>

      <div class="checkbox">
      <label>
         &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
        <input class="checkItem" type="checkbox" name="registrar" value="2" '.$dos.'>
       <div style="padding:1.2em">
         &nbsp;
       </div>
      </label>
    </div>

  </div>

  <div class="col-md-2">
    <div class="btn-group btn-group-justified" role="group" aria-label="...">
      <div class="btn-group" role="group">
        <button type="button" class="btn btn-success"><p>Editar</p></button>
      </div>
    </div>

      <div class="checkbox">
      <label>
         &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
        <input class="checkItem" type="checkbox" name="editar" value="3" '.$tres.'>
       <div style="padding:1.2em">
         &nbsp;
       </div>
      </label>
    </div>

  </div>

  <div class="col-md-2">
    <div class="btn-group btn-group-justified" role="group" aria-label="...">
      <div class="btn-group" role="group">
        <button type="button" class="btn btn-success"><p>Eliminar</p></button>
      </div>
    </div>

      <div class="checkbox">
      <label>
         &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
        <input class="checkItem" type="checkbox" name="eliminar" value="4" '.$cuatro.'>
       <div style="padding:1.2em">
         &nbsp;
       </div>
      </label>
    </div>

  </div>

  <div class="col-md-2">
    <div class="btn-group btn-group-justified" role="group" aria-label="...">
      <div class="btn-group" role="group">
        <button type="button" class="btn btn-success"><p>Reporte</p></button>
      </div>
    </div>

      <div class="checkbox">
      <label>
         &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
        <input class="checkItem" type="checkbox" name="reporte" value="5" '.$cinco.'>
       <div style="padding:1.2em">
         &nbsp;
       </div>
      </label>
    </div>

  </div>

  <div class="col-md-3 col-lg-4 col-xs-12">
  <button type="submit" class="btn btn-block btn-success btn-lg">Editar</button>
  </div>
  ';
  print $html;

else:
$html ='<h2>No existes recursos asociados a este perfil</h2>';
print $html;
endif;



  }
public function edit_recursos_perfil()
{
  if(isset($_SESSION['user_id'])):
       $this->id = $_SESSION['user_id'];
    else:
        $this->id = 0;
    endif;
    $this->_user->listar_permisos($this->id,ACCESS_EDIT);

  if (isset($_POST) && !empty($_POST)) {
    $this->id_perfil = $_POST['id_perfil'];

      ////////////////////////////////////////////
    if (!isset($_POST['consultar']) ) {
        $this->consultar = 0;
          //print_r($consultar);
    } else {
      $this->consultar = $_POST['consultar'];
    }

    ////////////////////////////////////////////

      if (!isset($_POST['registrar']) ) {
          $this->registrar = 0;
            //print_r($consultar);
      } else {
        $this->registrar = $_POST['registrar'];
      }
    //////////////////////////////////////////

    ////////////////////////////////////////////

      if (!isset($_POST['editar']) ) {
          $this->editar = 0;
            //print_r($consultar);
      } else {
        $this->editar = $_POST['editar'];
      }
    //////////////////////////////////////////

    ////////////////////////////////////////////

      if (!isset($_POST['eliminar']) ) {
          $this->eliminar = 0;
            //print_r($consultar);
      } else {
        $this->eliminar = $_POST['eliminar'];
      }
    //////////////////////////////////////////

    ////////////////////////////////////////////

      if (!isset($_POST['reporte']) ) {
          $this->reporte = 0;
            //print_r($consultar);
      } else {
        $this->reporte = $_POST['reporte'];
      }
    //////////////////////////////////////////



     if($this->_permiso->Insert_Multiple_Permisos($this->consultar,$this->registrar,$this->editar,$this->eliminar,$this->reporte,$this->id_perfil)== true):
       Core::header(BASE_URL.'permiso/edit/edit_good');
     endif;


  }
}

}
 ?>
