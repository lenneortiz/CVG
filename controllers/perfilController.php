<?php /**
 *
 */
class perfilController extends Controller
{
  private $_perfil;
  public $table_name;
  public $nombre;

  function __construct()
  {
    parent::__construct();
      $this->_perfil = $this->loadModel('perfil');
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
      $this->_user->listar_permisos($this->id,ACCESS_VIEW);
      //echo "hola desde el index de perfiles ";
      $this->_view->titulo ="ADMIN | Perfiles";
      $this->_view->perfiles = $this->_perfil->findAll('perfiles');
      $this->_view->loadView('index','admin');
      //print_r($this->_view->perfiles);
  }

  public function add()
  {
    if(isset($_SESSION['user_id'])):
         $this->id = $_SESSION['user_id'];
      else:
          $this->id = 0;
      endif;
      $this->_user->listar_permisos($this->id,ACCESS_CREATE);
     if (isset($_POST)&& !empty($_POST)):

       $this->nombre = ucfirst(filter_input(INPUT_POST,'nombre', FILTER_SANITIZE_STRING));
       $Query = "INSERT INTO perfiles
                  (idperfil, nombre, created, modified)
                  VALUES (NULL, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);";

       $Paramaters = array($this->nombre);
          if ($this->_perfil->ExecuteQuery($Query, $Paramaters) == true):
          Core::header(BASE_URL.'perfil/add_good');
        else:
          Core::header(BASE_URL.'perfil/error_add');

          endif;
     else:

       Core::header(BASE_URL.'perfil/index');

     endif;

  }
  public function perfil()
  {
    if(isset($_SESSION['user_id'])):
       $this->id = $_SESSION['user_id'];
    else:
        $this->id = 0;
    endif;

    $this->_view->permisos = $this->_user->listar_permisos($this->id,ACCESS_VIEW);
    $Id_Perfil = Core::obtenerIdUrl();
    $query = 'SELECT
                      EXTRACT(YEAR FROM created) AS anio,
                      EXTRACT(MONTH FROM created) AS mes,
                      EXTRACT(DAY FROM created) AS dia,
                      idperfil,
                      nombre
                      FROM perfiles
                      WHERE idperfil = ?';
    $this->_view->perfil = $this->_user->find($query,$Id_Perfil);
    //$this->_view->permisos = $this->_user->listar_permisos($_SESSION['user_id'],1);
    $this->_view->titulo = 'ADMIN | perfil';
    $this->_view->loadView('perfil','admin');
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
      $this->nombre = ucfirst(filter_input(INPUT_POST,'nombre', FILTER_SANITIZE_STRING));
        $this->id_perfil = filter_input(INPUT_POST,'id_perfil', FILTER_SANITIZE_NUMBER_INT);
      echo "procedemos a editar los datos";
      if (Core::Valida_datos($this->nombre, 'nom')== FALSE):
            Core::header(BASE_URL.'perfil/perfil/'.$this->id_perfil.'/nom');
         exit;
      endif;
      $Query = "UPDATE ".$this->table_name." SET nombre = ? WHERE idperfil = ?;";
      $Paramaters = array(
                         $this->nombre,
                         $this->id_perfil);

      if ($this->_perfil->ExecuteQuery($Query, $Paramaters) == true):
         Core::header(BASE_URL.'perfil/edit_good');
      endif;
    else:
      echo "no se ha enviado datos";
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
    $this->id_perfil =  Core::obtenerIdUrl();

    $Query="SELECT
    iduser_perfil
    FROM
    usuarios_perfiles
    WHERE id_user = ?;";
    $Paramaters = array($this->id_session);
    if($this->_perfil->SearchQuery($Query, $Paramaters) == true):
      Core::header(BASE_URL.'perfil/perfil_user');
    else:
      $Query = "DELETE FROM " . $this->table_name . " WHERE idperfil = ?";
      $Paramaters = array($this->id_perfil);
      if ($this->_perfil->ExecuteQuery($Query, $Paramaters) == true):
        Core::header(BASE_URL.'perfil/good');
      else:
        Core::header(BASE_URL.'perfil/error');
      endif;

    endif;

  }
}
 ?>
