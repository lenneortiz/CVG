<?php
/**
 *
 */
class categoriaController extends Controller
{
  public $id_categoria;
  public  $nombre;
  public $estado;
  public $table_name;
  function __construct()
  {
    parent::__construct();
      $this->table_name = "categoria";
      $this->_user = $this->loadModel('user');
      $this->_categoria = $this->loadModel('categoria');
  }

  public function index()
  {
      if(isset($_SESSION['user_id'])):
         $this->id = $_SESSION['user_id'];
      else:
          $this->id = 0;
      endif;
      $this->_user->listar_permisos($this->id,ACCESS_VIEW);
      $this->_view->titulo ="ADMIN | Categorias";
      $this->_view->categorias = $this->_categoria->get_all_categoria();
      $this->_view->loadView('index','admin');
  }

  public function add()
  {
    if(isset($_SESSION['user_id'])):
         $this->id = $_SESSION['user_id'];
      else:
          $this->id = 0;
      endif;
      $this->_user->listar_permisos($this->id,ACCESS_CREATE);
     if(isset($_POST['add']) && $_POST['add'] == '1'):

       $this->nombre = strtoupper(filter_input(INPUT_POST,'nombre', FILTER_SANITIZE_STRING));
       $this->estado = strtoupper(filter_input(INPUT_POST,'estado', FILTER_SANITIZE_STRING));
       $Query = "INSERT INTO categoria
                  (id_categoria, nombre,estado, created, modified)
                  VALUES (NULL, ?, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);";

       $Paramaters = array($this->nombre,$this->estado);
          if ($this->_categoria->ExecuteQuery($Query, $Paramaters) == true):
          Core::header(BASE_URL.'categoria/add_good');
        else:
          Core::header(BASE_URL.'categoria/error_add');

          endif;
     else:

       Core::header(BASE_URL.'categoria/index');

     endif;

  }

  public function categoria()
  {
    if(isset($_SESSION['user_id'])):
       $this->id = $_SESSION['user_id'];
    else:
        $this->id = 0;
    endif;

    $this->_view->permisos = $this->_user->listar_permisos($this->id,ACCESS_VIEW);
    $Id_Categoria = Core::obtenerIdUrl();
    $query = 'SELECT
                      EXTRACT(YEAR FROM created) AS anio,
                      EXTRACT(MONTH FROM created) AS mes,
                      EXTRACT(DAY FROM created) AS dia,
                      id_categoria,
                      nombre,
                      estado
                      FROM categoria
                      WHERE id_categoria = ?';
    $this->_view->categoria = $this->_categoria->find($query,$Id_Categoria);
    //$this->_view->permisos = $this->_user->listar_permisos($_SESSION['user_id'],1);
    $this->_view->titulo = 'ADMIN | perfil';
    $this->_view->loadView('categoria','admin');
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
      $this->id_categoria = filter_input(INPUT_POST,'id_categoria', FILTER_SANITIZE_STRING);

      if ($this->estado == 0):
        $Query="SELECT DISTINCT id_categoria FROM bienes WHERE id_categoria = ?;";
        $Paramaters = array($this->id_categoria);

        if($this->_categoria->SearchQuery($Query, $Paramaters) == true):
          Core::header(BASE_URL.'categoria/cat_active');

        else:
          //echo "PROCEDEMOS A EDITAR";
          ////////////////////////////////////////////
          $Query = "UPDATE ".$this->table_name." SET nombre = ?,estado = ? WHERE id_categoria = ?;";
          $Paramaters = array(
                             $this->nombre,
                             $this->estado,
                             $this->id_categoria);

          if ($this->_categoria->ExecuteQuery($Query, $Paramaters) == true):
             Core::header(BASE_URL.'categoria/categoria/'.$this->id_categoria.'/edit_good');

        else:
          Core::header(BASE_URL.'categoria/categoria/'.$this->id_categoria.'/error_edit');
        endif;
          ///////////////////////////////////////////////
        endif;


      else:

        //echo "PROCEDEMOS A EDITAR";
        ////////////////////////////////////////////
        $Query = "UPDATE ".$this->table_name." SET nombre = ?,estado = ? WHERE id_categoria = ?;";
        $Paramaters = array(
                           $this->nombre,
                           $this->estado,
                           $this->id_categoria);

        if ($this->_categoria->ExecuteQuery($Query, $Paramaters) == true):
           Core::header(BASE_URL.'categoria/categoria/'.$this->id_categoria.'/edit_good');

      else:
        Core::header(BASE_URL.'categoria/categoria/'.$this->id_categoria.'/error_edit');
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
      $this->id_categoria =  Core::obtenerIdUrl();

      $Query="SELECT DISTINCT id_categoria FROM bienes WHERE id_categoria = ?;";
      $Paramaters = array($this->id_categoria);

      if($this->_categoria->SearchQuery($Query, $Paramaters) == true):
        Core::header(BASE_URL.'categoria/cat_active');
      else:

          $Query = "DELETE FROM " . $this->table_name . " WHERE id_categoria = ?";
          $Paramaters = array($this->id_categoria);
          if ($this->_categoria->ExecuteQuery($Query, $Paramaters) == true):
            Core::header(BASE_URL.'categoria/good');
          else:
            Core::header(BASE_URL.'categoria/error');
          endif;

      endif;

  }
}
