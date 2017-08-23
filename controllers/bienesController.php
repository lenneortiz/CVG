  <?php
  /**
   *
   */
  class bienesController extends controller
  {
    private $_imageresize;
    public $producto_nombre;
    public $descrip_producto;
    public $minimo_stock;
    public $stock;
    public $id_categoria;
    public $id_marca;
    public $id_unidad_adscripta;
    public $id_funcionario;
    public $id_producto;
    public $estado;
    public $code_articulo;
    public $observacion;
    public $table_name;

    function __construct()
    {
      parent::__construct();
      $this->_user = $this->loadModel('user');
      $this->_bien = $this->loadModel('bienes');
      $this->_categoria = $this->loadModel('categoria');
      $this->_unidad = $this->loadModel('unidades');
      $this->_funcionario = $this->loadModel('funcionario');
      $this->getLibreria('resizeimage/','ModifiedImage');
      $this->table_name = 'bienes';
    }

    public function index()
    {
      //echo "<pre>".print_r(__METHOD__)."</pre>";
      //carga de la vista
        if(isset($_SESSION['user_id'])):
           $this->id = $_SESSION['user_id'];
        else:
            $this->id = 0;
        endif;
          $this->_user->listar_permisos($this->id,ACCESS_VIEW);
          $this->_view->titulo = 'BIENES | adminitración de bienes ';
          $this->_view->bienes = $this->_bien->findAll('bienes');
          //print_r(  $this->_view->bienes);
          $this->_view->loadView('index','admin');

    }

    public function bien()
    {
      if(isset($_SESSION['user_id'])):
         $this->id = $_SESSION['user_id'];
      else:
          $this->id = 0;
      endif;
      $this->_view->permisos = $this->_user->listar_permisos($this->id,ACCESS_VIEW);
      $Id_bien = Core::obtenerIdUrl();
      //echo $Id_User;

      $query = "SELECT
      ART.id_bien,
      ART.id_funcionario,
      ART.bien_codigo,
      ART.bien_foto,
      ART.bien_nombre,
      ART.bien_descripcion,
      ART.bien_cantidad,
      ART.estado,
      FC.id_funcionario,
      FC.nombre1,
      FC.apellido1,
      O.observacion,
      O.id_observacion,
      DATE_FORMAT(ART.created, '%d %M %Y %h:%i:%s') AS creado,
      DATE_FORMAT(ART.modified, '%d %M %Y %h:%i:%s') AS editado,
      CAT.nombre AS categoria,
      U.nombre AS unidad
       FROM bienes ART
      INNER JOIN categoria CAT ON ART.id_categoria = CAT.id_categoria
      INNER JOIN unidad_adscripta U ON ART.id_unidad_adscripta = U.id_unidad_adscripta
      INNER JOIN funcionarios FC ON ART.id_funcionario = FC.id_funcionario
      INNER JOIN observacion_bien O ON ART.id_bien = O.id_bien
      WHERE ART.id_bien = ?";
      $this->_bien->lc_time_names();
      $this->_view->bien = $this->_bien->find($query,$Id_bien);
      $this->_view->categorias = $this->_categoria->get_all_active_categorias();
      $this->_view->unidades = $this->_unidad->get_all_active_unidades();
      $this->_view->funcionarios = $this->_funcionario->get_funcionarios_active();
      //print_r($this->_view->bien);
      //echo"<pre>";
      //print_r($this->_view->bien);
      $this->_view->titulo ="ADMIN | Bien";
      //$this->_view->marcas = $this->_marca->get_marca();
      $this->_view->loadView('bien','admin');


    }

    public function edit()
    {
      if(isset($_SESSION['user_id'])):
         $this->id = $_SESSION['user_id'];
      else:
          $this->id = 0;
      endif;
        $this->_view->permisos = $this->_user->listar_permisos($this->id,ACCESS_EDIT);

        /*echo "<pre>";
        print_r($_POST);
        exit;*/

        $this->producto_nombre        = strtoupper(ucfirst(filter_input(INPUT_POST,'nombre', FILTER_SANITIZE_STRING) ));
        $this->descrip_producto       = trim(filter_input(INPUT_POST,'descrip_producto', FILTER_SANITIZE_STRING) );
        $this->minimo_stock           = filter_input(INPUT_POST,'minimo_stock', FILTER_SANITIZE_NUMBER_INT);
        $this->stock                  = filter_input(INPUT_POST,'stock', FILTER_SANITIZE_NUMBER_INT);
        $this->id_categoria           = filter_input(INPUT_POST,'id_categoria', FILTER_SANITIZE_NUMBER_INT);
        $this->id_marca               = filter_input(INPUT_POST,'id_marca', FILTER_SANITIZE_NUMBER_INT);
        $this->estado                 = filter_input(INPUT_POST,'estado', FILTER_SANITIZE_STRING);
        $this->id_producto            = filter_input(INPUT_POST,'id_producto', FILTER_SANITIZE_NUMBER_INT);
        $this->id_funcionario         = filter_input(INPUT_POST,'id_funcionario', FILTER_SANITIZE_NUMBER_INT);
        $this->id_unidad_adscripta    = filter_input(INPUT_POST,'id_unidad_adscripta', FILTER_SANITIZE_NUMBER_INT);
        $this->observacion            = trim(filter_input(INPUT_POST,'observacion', FILTER_SANITIZE_STRING) );

        $foto_name            = $_FILES['foto']['name'];
        $foto_producto_bd     = $_POST['foto-producto'];
        $temp_direc           = $_FILES['foto']['tmp_name'];
        $size                 = $_FILES['foto']['size'];
        $partes               = explode(".",$foto_name);
        $imgExt               = end($partes);
        $producto_foto        = rand(1000,1000000).".".$imgExt;
        $extencion            = array("png", "jpg", "jpeg");
        $carpeta              = ROOT. DS."upload/";

        if(!empty($foto_name)):
          $foto_producto = $producto_foto;
          //comprobamos que el formato de imagen sea el correcto/////
            if(in_array($imgExt, $extencion)):
              ///comprobamos que el tamaño de la imagen sea el permitido////////
                if($size < (3024 * 3024)):

                  ////ahora prodemos a guardar la imagen///////////////
                   $this->_imageresize = new ModifiedImage($temp_direc);
                   if($this->_imageresize->getWidth() > 50):

                       $this->_imageresize->resizeToWidth(250);
                       $w150 = $carpeta . $producto_foto;
                       $this->_imageresize->save($w150);
                     else:
                       Core::header(BASE_URL.'bienes/biene/'.$this->id_producto.'/error_save_img');
                     endif;
                 ///////////////////////

                else://si el tamaño de imagen no es el permitido enviamos un mensaje

                  Core::header(BASE_URL.'bienes/bien/'.$this->id_producto.'/size_img');
                endif;
            else://si el formato de imagen no es el correcto enviamos un mensaje

                Core::header(BASE_URL.'bienes/bien/'.$this->id_producto.'/format_img');

            endif;
        else:
          $foto_producto = $foto_producto_bd;
        endif;

        $Query = "UPDATE
        bienes
        SET
        id_categoria = ?,
        id_unidad_adscripta = ? ,
        id_funcionario = ? ,
        bien_foto = ?,
        bien_nombre = ?,
        bien_descripcion = ?,
        bien_cantidad = ?,
        estado = ?
        WHERE id_bien = ?";
        //echo "<pre>";
        //echo $Query;

        $Paramaters = array(  $this->id_categoria,
                              $this->id_unidad_adscripta,
                              $this->id_funcionario,
                              $foto_producto,
                              $this->producto_nombre,
                              $this->descrip_producto,
                              $this->stock,
                              $this->estado,
                              $this->id_producto
                            );
      if($this->_bien->ExecuteQuery($Query, $Paramaters) == true):
              ///////////////////////procedemos a actualizar la tabla observacion////////////////////////////////////

              $Query2 = "UPDATE
              observacion_bien
              SET
              observacion = ?
              WHERE id_bien = ?";
              //echo "<pre>";
              //echo $Query;

              $Paramaters2 = array(  $this->observacion,
                                    $this->id_producto,
                                  );
                if($this->_bien->ExecuteQuery($Query2, $Paramaters2) == true):
                  Core::header(BASE_URL.'bienes/bien/'.$this->id_producto.'/edit_good');
                else:
                  Core::header(BASE_URL.'bienes/ben/'.$this->id_producto.'/error_edit');
                endif;
              ////////////////////////////////////////////////////////////

        else:
              Core::header(BASE_URL.'bienes/ben/'.$this->id_producto.'/error_edit');

          endif;



    }

    public function delete()
    {
      if(isset($_SESSION['user_id'])):
        $this->id = $_SESSION['user_id'];
     else:
         $this->id = 0;
     endif;
      $this->_view->permisos = $this->_user->listar_permisos( $this->id ,ACCESS_DELETE);
      $this->id =  Core::obtenerIdUrl();
      $Query = "UPDATE bienes SET estado= '0' WHERE id_bien = ?;";
     $Paramaters = array($this->id);
      if ($this->_user->ExecuteQuery($Query, $Paramaters) == true):

       Core::header(BASE_URL.'bienes/good');

   else:

     Core::header(BASE_URL.'bienes/error');

   endif;
    }

    public function add()
    {
      if(isset($_SESSION['user_id'])):
        $this->id = $_SESSION['user_id'];
     else:
         $this->id = 0;
     endif;
      $this->_view->permisos = $this->_user->listar_permisos($this->id,ACCESS_CREATE);
      $this->_view->categorias = $this->_categoria->get_all_active_categorias();
      $this->_view->unidades = $this->_unidad->get_all_active_unidades();

      $this->_view->funcionarios = $this->_funcionario->get_funcionarios_active();
      //print_r($this->_view->funcionarios);
      if(isset($_POST['add']) && $_POST['add'] == '1'):

        //echo "<pre>";
        //print_r($_POST);
        //exit;
        //print_r($_FILES);
        //$code1 = mt_rand(0, 999999);
        //$code2 = mt_rand(0, 999999);

        $this->producto_nombre      = strtoupper(ucfirst(filter_input(INPUT_POST,'nombre', FILTER_SANITIZE_STRING) ));
        $this->descrip_producto     = trim(filter_input(INPUT_POST,'descrip_producto', FILTER_SANITIZE_STRING) );
        $this->stock                = filter_input(INPUT_POST,'stock', FILTER_SANITIZE_NUMBER_INT);
        $this->id_categoria         = filter_input(INPUT_POST,'id_categoria', FILTER_SANITIZE_NUMBER_INT);
        $this->id_unidad_adscripta  = filter_input(INPUT_POST,'id_unidad_adscripta', FILTER_SANITIZE_NUMBER_INT);
        $this->id_funcionario       = filter_input(INPUT_POST,'id_funcionario', FILTER_SANITIZE_NUMBER_INT);
        $this->estado               = filter_input(INPUT_POST,'estado', FILTER_SANITIZE_STRING);
        $this->code_articulo        = mb_strtoupper(trim(filter_input(INPUT_POST,'codigo_barra', FILTER_SANITIZE_STRING)) );
        $this->observacion          = trim(filter_input(INPUT_POST,'observacion', FILTER_SANITIZE_STRING) );

        if($this->observacion == ''):
          $this->observacion = 'Sin Observaciones';
        else:
          $this->observacion = $this->observacion;
        endif;


        $foto_name            = $_FILES['foto']['name'];
        $foto_producto_avatar = $_POST['foto-producto-avatar'];
        $temp_direc           = $_FILES['foto']['tmp_name'];
        $size                 = $_FILES['foto']['size'];
        $partes               = explode(".",$foto_name);
        $imgExt               = end($partes);
        $producto_foto        = rand(1000,1000000).".".$imgExt;
        $extencion            = array("png", "jpg", "jpeg");
        $carpeta              = ROOT. DS."upload/";

        if(!empty($foto_name)):
          $foto_producto = $producto_foto;
          //comprobamos que el formato de imagen sea el correcto/////
            if(in_array($imgExt, $extencion)):
              ///comprobamos que el tamaño de la imagen sea el permitido////////
                if($size < (3024 * 3024)):

                  ////ahora prodemos a guardar la imagen///////////////
                   $this->_imageresize = new ModifiedImage($temp_direc);
                   if($this->_imageresize->getWidth() > 50):

                       $this->_imageresize->resizeToWidth(250);
                       $w150 = $carpeta . $producto_foto;
                       $this->_imageresize->save($w150);
                     else:
                       $resp = Core::header(BASE_URL.'bienes/add/error_save_img');
                     endif;
                 ///////////////////////

                else://si el tamaño de imagen no es el permitido enviamos un mensaje
                  Core::header(BASE_URL.'bienes/add/size_img');
                endif;
            else://si el formato de imagen no es el correcto enviamos un mensaje
                Core::header(BASE_URL.'bienes/add/format_img');
            endif;
        else:
          $foto_producto = $foto_producto_avatar;
        endif;

        $Query="SELECT
        bien_codigo
        FROM
        bienes
        WHERE bien_codigo = ?;";
        $Paramaters = array($this->code_articulo);
        if($this->_bien->SearchQuery($Query, $Paramaters) == true):
          Core::header(BASE_URL.'bienes/add/cod_exits');
        endif;
        $Query = "INSERT INTO bienes
        (id_bien,
        id_categoria,
        id_unidad_adscripta,
        id_funcionario,
        bien_foto,
        bien_nombre,
        bien_descripcion,
        bien_cantidad,
        bien_codigo,
        estado,
        created,
        modified)
        VALUES
        (NULL,?,?,?,?,?,?,?,?,?,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP);";

        $Paramaters = array(  $this->id_categoria,
                              $this->id_unidad_adscripta,
                              $this->id_funcionario,
                              $foto_producto,
                              $this->producto_nombre,
                              $this->descrip_producto,
                              $this->stock,
                              $this->code_articulo,
                              $this->estado
                            );
      if($this->_bien->ExecuteQuery($Query, $Paramaters) == true):

                ////////////////////////////////////////

                $id_Bien = $this->_bien->SelectMaxId('bienes');
                $Query = "INSERT INTO observacion_bien (id_observacion, id_bien, observacion) VALUES (NULL, ?, ?)";
                $Paramaters = array($id_Bien,$this->observacion);
                if($this->_bien->ExecuteQuery($Query, $Paramaters) == true):
                     Core::header(BASE_URL.'bienes/add_good');
                  else:
                      Core::header(BASE_URL.'bienes/error_add');

                  endif;

                //////////////////////////////////////////
        else:
              Core::header(BASE_URL.'bienes/error_add');

          endif;
      else:
        //echo "<pre>".print_r(__METHOD__)."</pre>";
        $this->_view->titulo ="ADMIN | Agregr Bien";
        //$this->_view->marcas = $this->_marca->get_marca();
        $this->_view->loadView('add','admin');


      endif;


    }

    public function barcode()
    {
      $code1 = mt_rand(0, 999999);
      $code2 = mt_rand(0, 999999);

      echo $code1.$code2;
    }
  }
