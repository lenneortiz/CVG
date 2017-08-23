<?php
/**
 *
 */
class unidadesController extends Controller
{
  public $id_unidad_adscripta;
  public  $nombre;
  public $estado;
  public $table_name;

  function __construct()
  {
    parent::__construct();
    $this->table_name = "unidad_adscripta";
    $this->_user  = $this->loadModel('user');
    $this->_unidad = $this->loadModel('unidades');
  }

  public function index()
  {
    if(isset($_SESSION['user_id'])):
       $this->id = $_SESSION['user_id'];
    else:
        $this->id = 0;
    endif;
      $this->_user->listar_permisos($this->id,ACCESS_VIEW);
    //echo "<pre>".print_r(__METHOD__)."</pre>";
    $this->_view->titulo ="ADMIN | Unidades Adscriptas";
    $this->_view->unidades = $this->_unidad->get_all_unidades();
    $this->_view->loadView('index','admin');
    //print_r($this->_view->unidades);

  }

public function unidad()
{
  if(isset($_SESSION['user_id'])):
     $this->id = $_SESSION['user_id'];
  else:
      $this->id = 0;
  endif;

  $this->_view->permisos = $this->_user->listar_permisos($this->id,ACCESS_VIEW);
  $Id_Unidad = Core::obtenerIdUrl();
  $query = 'SELECT
                    EXTRACT(YEAR FROM created) AS anio,
                    EXTRACT(MONTH FROM created) AS mes,
                    EXTRACT(DAY FROM created) AS dia,
                    id_unidad_adscripta,
                    nombre,
                    estado
                    FROM unidad_adscripta
                    WHERE id_unidad_adscripta = ?';
  $this->_view->unidad = $this->_unidad->find($query,$Id_Unidad);
  $this->_view->titulo = 'ADMIN | Unidad A|dscripta';
  $this->_view->loadView('unidad','admin');
  //print_r($this->_view->categoria);
}

public function edit()
{
  if(isset($_SESSION['user_id'])):
       $this->id = $_SESSION['user_id'];
    else:
        $this->id = 0;
    endif;
    $this->_user->listar_permisos($this->id,ACCESS_EDIT);
  if(isset($_POST['update']) && $_POST['update'] == 1):
    $this->nombre = strtoupper(filter_input(INPUT_POST,'nombre', FILTER_SANITIZE_STRING));
    $this->estado = strtoupper(filter_input(INPUT_POST,'estado', FILTER_SANITIZE_STRING));
    $this->id_unidad_adscripta = filter_input(INPUT_POST,'id_unidad', FILTER_SANITIZE_STRING);

    if ($this->estado == 0):
      $Query="SELECT DISTINCT id_unidad_adscripta FROM bienes WHERE id_unidad_adscripta = ?;";
      $Paramaters = array($this->id_unidad_adscripta);

      if($this->_unidad->SearchQuery($Query, $Paramaters) == true):
        Core::header(BASE_URL.'unidades/unid_active');

      else:
        //echo "PROCEDEMOS A EDITAR";
        ////////////////////////////////////////////
        $Query = "UPDATE ".$this->table_name." SET nombre = ?,estado = ? WHERE id_unidad_adscripta = ?;";
        $Paramaters = array(
                           $this->nombre,
                           $this->estado,
                           $this->id_unidad_adscripta);

        if ($this->_unidad->ExecuteQuery($Query, $Paramaters) == true):
           Core::header(BASE_URL.'unidades/unidad/'.$this->id_unidad_adscripta.'/edit_good');

      else:
        Core::header(BASE_URL.'unidades/unidad/'.$this->id_unidad_adscripta.'/error_edit');
      endif;
        ///////////////////////////////////////////////
      endif;


    else:

      //echo "PROCEDEMOS A EDITAR";
      ////////////////////////////////////////////
      $Query = "UPDATE ".$this->table_name." SET nombre = ?,estado = ? WHERE id_unidad_adscripta = ?;";
      $Paramaters = array(
                         $this->nombre,
                         $this->estado,
                         $this->id_unidad_adscripta);

      if ($this->_unidad->ExecuteQuery($Query, $Paramaters) == true):
         Core::header(BASE_URL.'unidades/unidad/'.$this->id_unidad_adscripta.'/edit_good');

    else:
      Core::header(BASE_URL.'unidades/unidad/'.$this->id_unidad_adscripta.'/error_edit');
    endif;
      ///////////////////////////////////////////////
    endif;



  else:
    Core::header(BASE_URL.'categoria/index');
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
    $this->id_unidad_adscripta =  Core::obtenerIdUrl();

    $Query="SELECT DISTINCT id_unidad_adscripta FROM bienes WHERE id_unidad_adscripta = ?;";
    $Paramaters = array($this->id_unidad_adscripta);

    if($this->_unidad->SearchQuery($Query, $Paramaters) == true):
      Core::header(BASE_URL.'unidades/unid_active');
    else:

        $Query = "DELETE FROM " . $this->table_name . " WHERE id_unidad_adscripta = ?";
        $Paramaters = array($this->id_unidad_adscripta);
        if ($this->_unidad->ExecuteQuery($Query, $Paramaters) == true):
          Core::header(BASE_URL.'unidades/good');
        else:
          Core::header(BASE_URL.'unidades/error');
        endif;

    endif;

}
}
