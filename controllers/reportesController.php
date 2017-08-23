<?php
/**
 *
 */
class reportesController extends controller
{

  function __construct()
  {
    parent::__construct();
    $this->_user = $this->loadModel('user');
    $this->_reporte = $this->loadModel('reporte');
    $this->getLibreria('fpdf/','pdfGenerador');
    $this->_pdf = new PDF;
    $this->getLibreria('dompdf/','dompdf_config.inc');
    $this->getLibreria('PHPEXCEL/Classes/','PHPExcel');

  }

  public function index()
  {
       $this->_view->titulo = 'ADMIN | area de adminitración ';
       $this->_view->loadView('index','admin');
  }

  public function bienes_pdf()
  {
    if(isset($_SESSION['user_id'])):
       $this->id = $_SESSION['user_id'];
    else:
        $this->id = 0;
    endif;
    $this->_user->listar_permisos($this->id,ACCESS_REPORT);

    $query = "SELECT B.id_unidad_adscripta,
    count(case B.estado  when '1'then 1 else null end)as operativo,
    count(case B.estado when '0'then 1 else null end)as inoperativo,
    count(case B.estado when '2'then 1 else null end)as regular,
    U.nombre AS unidad_nom
    from bienes B
    INNER JOIN unidad_adscripta U ON B.id_unidad_adscripta = U.id_unidad_adscripta
    group by B.id_unidad_adscripta";

    $this->_view->unidadedes = $this->_reporte->joins($query);

    $query = "SELECT
    count(B.id_unidad_adscripta)as total
    from bienes B
    INNER JOIN unidad_adscripta U ON B.id_unidad_adscripta = U.id_unidad_adscripta";

    $this->_view->bienes_total = $this->_reporte->joins($query);

    //print_r($this->_view->unidadedes);

    $Id_bien = Core::obtenerIdUrl();
    $array = explode(',',$Id_bien);
    $total_Ids = count($array);

    if($total_Ids > 1):

      if(is_array($array)):
          $os = array("on", "NT", "Irix", "Linux");
          if (in_array("on", $array)) :
          //echo "existe el on";
            unset($array[0]);
          $ids_bienes = implode(",", $array);
          else:

          $ids_bienes = implode(",",$array);
          endif;


          endif;
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
          FC.nombre1 AS nom_func,
          FC.apellido1 AS apellido_func,
          O.observacion,
          O.id_observacion,
          DATE_FORMAT(ART.created, '%d %M %Y %h:%i:%s') AS creado,
          DATE_FORMAT(ART.modified, '%d %M %Y %h:%i:%s') AS editado,
          CAT.nombre AS categoria,
          U.nombre AS nom_unidad
           FROM bienes ART
          INNER JOIN categoria CAT ON ART.id_categoria = CAT.id_categoria
          INNER JOIN unidad_adscripta U ON ART.id_unidad_adscripta = U.id_unidad_adscripta
          INNER JOIN funcionarios FC ON ART.id_funcionario = FC.id_funcionario
          INNER JOIN observacion_bien O ON ART.id_bien = O.id_bien
          WHERE ART.id_bien IN (".$ids_bienes." );";

          $this->_view->report_bienes = $this->_reporte->find($query,$ids_bienes);
          //print_r($this->_view->report_bienes);
           ob_start();
         $this->getFileReport('reportes/','pdf_bien');
         $html = ob_get_clean();
    else:
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
            FC.nombre1 AS nom_func,
            FC.apellido1 AS apellido_func,
            O.observacion,
            O.id_observacion,
            DATE_FORMAT(ART.created, '%d %M %Y %h:%i:%s') AS creado,
            DATE_FORMAT(ART.modified, '%d %M %Y %h:%i:%s') AS editado,
            CAT.nombre AS categoria,
            U.nombre AS nom_unidad
             FROM bienes ART
            INNER JOIN categoria CAT ON ART.id_categoria = CAT.id_categoria
            INNER JOIN unidad_adscripta U ON ART.id_unidad_adscripta = U.id_unidad_adscripta
            INNER JOIN funcionarios FC ON ART.id_funcionario = FC.id_funcionario
            INNER JOIN observacion_bien O ON ART.id_bien = O.id_bien
            WHERE ART.id_bien IN (".$Id_bien." );";
            $this->_view->report_bienes = $this->_reporte->find($query,$Id_bien);
            ob_start();
                $this->getFileReport('reportes/','pdf_bien');
            $html = ob_get_clean();

      endif;

            $this->_pdf = new DOMPDF();
            $this->_pdf->set_paper( array(0,0, 12 * 72, 12 * 72), "portrait" );
            $html=utf8_decode($html);
            $this->_pdf->load_html($html);
            $this->_pdf->render();
            $this->_pdf->stream("Bienes".Date('Y-m-d H:i:s').".pdf");

  }

  public function bienes_pdf_all()
  {
    if(isset($_SESSION['user_id'])):
       $this->id = $_SESSION['user_id'];
    else:
        $this->id = 0;
    endif;
    $this->_user->listar_permisos($this->id,ACCESS_REPORT);

    $query = "SELECT B.id_unidad_adscripta,
    count(case B.estado  when '1'then 1 else null end)as operativo,
    count(case B.estado when '0'then 1 else null end)as inoperativo,
    count(case B.estado when '2'then 1 else null end)as regular,
    U.nombre AS unidad_nom
    from bienes B
    INNER JOIN unidad_adscripta U ON B.id_unidad_adscripta = U.id_unidad_adscripta
    group by B.id_unidad_adscripta";

    $this->_view->unidadedes = $this->_reporte->joins($query);

    $query = "SELECT
    count(B.id_unidad_adscripta)as total
    from bienes B
    INNER JOIN unidad_adscripta U ON B.id_unidad_adscripta = U.id_unidad_adscripta";

    $this->_view->bienes_total = $this->_reporte->joins($query);

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
    FC.nombre1 AS nom_func,
    FC.apellido1 AS apellido_func,
    O.observacion,
    O.id_observacion,
    DATE_FORMAT(ART.created, '%d %M %Y %h:%i:%s') AS creado,
    DATE_FORMAT(ART.modified, '%d %M %Y %h:%i:%s') AS editado,
    CAT.nombre AS categoria,
    U.nombre AS nom_unidad
     FROM bienes ART
    INNER JOIN categoria CAT ON ART.id_categoria = CAT.id_categoria
    INNER JOIN unidad_adscripta U ON ART.id_unidad_adscripta = U.id_unidad_adscripta
    INNER JOIN funcionarios FC ON ART.id_funcionario = FC.id_funcionario
    INNER JOIN observacion_bien O ON ART.id_bien = O.id_bien";

    $this->_view->report_bienes = $this->_reporte->joins($query);
    //print_r($this->_view->report_bienes);
    ob_start();
          $this->getFileReport('reportes/','pdf_bien');
    $html = ob_get_clean();
    $this->_pdf = new DOMPDF();
    $this->_pdf->set_paper( array(0,0, 12 * 72, 12 * 72), "portrait" );
    $html=utf8_decode($html);
    $this->_pdf->load_html($html);
    $this->_pdf->render();
    $this->_pdf->stream("Bienes".Date('Y-m-d H:i:s').".pdf");

  }
  public function user_pdf()
  {
        if(isset($_SESSION['user_id'])):
           $this->id = $_SESSION['user_id'];
        else:
            $this->id = 0;
        endif;
        $this->_user->listar_permisos($this->id,ACCESS_REPORT);

        $Id_user = Core::obtenerIdUrl();
        $array = explode(',',$Id_user);
        $total_Ids = count($array);

        if($total_Ids > 1):


          if(is_array($array)):

                $os = array("on", "NT", "Irix", "Linux");
                if (in_array("on", $array)) :
                  //echo "existe el on";
                    unset($array[0]);
                    $Id = implode(",", $array);
                //echo $ids_users;
                ob_start();
                $query = "SELECT
                iduser,
                foto,
                nombre,
                usuario,
                correo,
                estado
                FROM user
                WHERE iduser IN (".$Id." );";
                $this->_view->report_users = $this->_user->find($query,$Id);
                //print_r($this->_view->report_users);
                ob_start();
                $this->getFileReport('reportes/','pdfUsuarios');
                $html = ob_get_clean();
                endif;

          endif;
        else:
          $query = 'SELECT
                    iduser,
                    foto,
                    nombre,
                    usuario,
                    correo,
                    estado
                    FROM user
                    WHERE iduser = ?';
          $this->_view->report_users = $this->_user->find($query,$Id_user);
          //print_r($this->_view->report_users);
            ob_start();
             $this->getFileReport('reportes/','pdfUsuario');
            $html = ob_get_clean();

    endif;
          $this->_pdf = new DOMPDF();
          $this->_pdf->set_paper( array(0,0, 12 * 72, 12 * 72), "portrait" );
          $html=utf8_decode($html);
          $this->_pdf->load_html($html);
          $this->_pdf->render();
          $this->_pdf->stream("Usuarios".Date('Y-m-d H:i:s').".pdf");
  }

  public function user_Fpdf()
  {
    if(isset($_SESSION['user_id'])):
       $this->id = $_SESSION['user_id'];
    else:
        $this->id = 0;
    endif;
    $this->_user->listar_permisos($this->id,ACCESS_REPORT);

    $Id_user = Core::obtenerIdUrl();
    $array = explode(',',$Id_user);
    $total_Ids = count($array);

    if($total_Ids > 1):


      if(is_array($array)):
        //echo "es un array";
        unset($array[0]);
        $ids_users = implode(",", $array);
        //echo $ids_users;
        ob_start();
        $query = "SELECT
        iduser,
        foto,
        nombre,
        usuario,
        correo,
        estado
        FROM user
        WHERE iduser IN (".$ids_users." );";
        $this->_view->report_users = $this->_user->find($query,$ids_users);
        $colum = array();
        $titulo = "Listado de Usuarios";
        $anchocelda = '25';
        $anchocelda2 = '45';

        $this_pdf = new PDF();
        $this_pdf->SetAutoPageBreak(true, 5);
        $this->_pdf->AddPage('L','A4');
        $this->_pdf->Image('upload/CVG.png' , 20 ,0, 40 , 40,'PNG', 'http://php-estudios.blogspot.com');

// Encabezado de la factura
$this->_pdf->SetFont('Arial','B',16);
$this->_pdf->Cell(280, 10, $titulo, 0, 6, "C");
$this->_pdf->SetFont('Arial','B',10);
//$this->_pdf->MultiCell(190,5, "Número de factura:EEEREER"."\n"."Fecha: 4545454", 0, "C", false);

// Datos del cliente


  $this->_pdf->Ln();
  $this->_pdf->SetX(140);

 $this->_pdf->SetFillColor(188, 153, 252);
 $this->_pdf->Cell(14, 5, 'ID', 1, 0, 'L', true);
 $this->_pdf->Cell($anchocelda, 5, 'NOMBRE', 1, 0, 'L', true);
 $this->_pdf->Cell($anchocelda, 5, 'USUARIO', 1, 0, 'L', true);
 $this->_pdf->Cell(50, 5, "CORREO", 1, 0, 'L', true);
 $this->_pdf->Cell($anchocelda, 5, "estado", 1, 0, 'L', true);
;

     foreach($this->_view->report_users as $filas => $valor):
         $this->_pdf->SetFont("Arial", "", 10);
         $this->_pdf->Ln();
         $this->_pdf->SetX(140);
         $this->_pdf->SetTextColor(66, 66, 66);
         $this->_pdf->Cell(14, 5, $valor['iduser'], 1, 0, 'L');
         $this->_pdf->Cell($anchocelda, 5, $valor['nombre'], 1, 0, 'L');
         $this->_pdf->Cell($anchocelda, 5, $valor['usuario'], 1, 0, 'L');
         $this->_pdf->Cell(50, 5, $valor['correo'], 1, 0, 'L');
         $this->_pdf->Cell($anchocelda, 5, ($valor['estado'] == 1 )?'activo':'inactivo', 1, 0, 'L');


       endforeach;
       $this->_pdf->Ln(19);


       $this->_pdf->SetX(40);

      $this->_pdf->SetFillColor(188, 153, 252);
      $this->_pdf->Cell(15, 5, 'ID', 1, 0, 'L', true);
      $this->_pdf->Cell($anchocelda2, 5, 'NOMBRE', 1, 0, 'L', true);
      $this->_pdf->Cell($anchocelda2, 5, 'USUARIO', 1, 0, 'L', true);
      $this->_pdf->Cell($anchocelda2, 5, "CORREO", 1, 0, 'L', true);
      $this->_pdf->Cell(20, 5, "ESTADO", 1, 0, 'L', true);
      $this->_pdf->Cell($anchocelda2, 5, "FOTO", 1, 0, 'L', true);
     ;

          foreach($this->_view->report_users as $filas => $valor):
              $this->_pdf->SetFont("Arial", "", 10);
              $this->_pdf->Ln();
              $this->_pdf->SetX(40);
              $this->_pdf->SetTextColor(66, 66, 66);
              $this->_pdf->Cell(15, 15, $valor['iduser'], 1, 0, 'L');
              $this->_pdf->Cell($anchocelda2, 15, $valor['nombre'], 1, 0, 'L');
              $this->_pdf->Cell($anchocelda2, 15, $valor['usuario'], 1, 0, 'L');
              $this->_pdf->Cell($anchocelda2, 15, $valor['correo'], 1, 0, 'L');
              $this->_pdf->Cell(20, 15, ($valor['estado'] == 1 )?'activo':'inactivo', 1, 0, 'L');
              $this->_pdf->Cell($anchocelda2,15,$this->_pdf->Image('upload/'.$valor['foto'],$this->_pdf->GetX()+0,$this->_pdf->GetY()+0,45,15),1,0,'L');


            endforeach;







        $this->_pdf->SetY(-15);
        $this->_pdf->SetFont('Arial','I',10);
        $this->_pdf->Cell(0,10,'Pagina '.$this->_pdf->PageNo().'/{nb}',0,0,'C');
        $this->_pdf->Output('yourfilename.pdf','D');

      endif;
    else:

      $query = 'SELECT
                iduser,
                foto,
                nombre,
                usuario,
                correo,
                estado
                FROM user
                WHERE iduser = ?';
      $this->_view->report_users = $this->_user->find($query,$Id_user);
      //print_r($this->_view->report_users);
      $colum = array();
      $anchocelda = '84';


      $this_pdf = new PDF();
      $this_pdf->SetAutoPageBreak(true, 5);
      $this->_pdf->AddPage('L','A4');
      $this->_pdf->SetTitle('listado de Usuarios');
      $this->_pdf->SetFont('Arial','B',14);
      $this->_pdf->SetTextColor(50,60,100);
      $this->_pdf->Cell(0,6,'Listado de Usuarios',1,1,'C');
      $this->_pdf->Ln(10);

      $this->_pdf->SetFillColor(232,232,232);
      $this->_pdf->SetFont('Arial','B',12);
      $this->_pdf->Cell(25,6,'ID',1,0,'C',1);
      $this->_pdf->Cell($anchocelda,6,'NOMBRE',1,0,'C',1);
      $this->_pdf->Cell($anchocelda,6,'USUARIO',1,0,'C',1);
      $this->_pdf->Cell($anchocelda,6,'CORREO',1,0,'C',1);
      $this->_pdf->Ln(10);

      foreach($this->_view->report_users as $filas => $valor):
        $this->_pdf->SetFillColor(232,232,130);
        $this->_pdf->SetFont('Arial','B',12);
        $this->_pdf->Cell(25,6,$valor['iduser'],1,0,'C',1);
        $this->_pdf->Cell($anchocelda,6,$valor['nombre'],1,0,'C',1);
        $this->_pdf->Cell($anchocelda,6,$valor['usuario'],1,0,'C',1);
        $this->_pdf->Cell($anchocelda,6,$valor['correo'],1,0,'C',1);
        $this->_pdf->Ln(9);

      endforeach;
      $this->_pdf->SetY(-15);
      $this->_pdf->SetFont('Arial','I',10);
      $this->_pdf->Cell(0,10,'Pagina '.$this->_pdf->PageNo().'/{nb}',0,0,'C');
      $this->_pdf->Output();
    endif;


  }

  public function user_pdf_all()
  {

     $this->_view->report_users = $this->_user->findAll('user');
    //print_r($this->_view->report_users);
    ob_start();
          $this->getFileReport('reportes/','pdfUsuarios');
      $html = ob_get_clean();

    $this->_pdf = new DOMPDF();
    $this->_pdf->set_paper( array(0,0, 12 * 72, 12 * 72), "portrait" );
    $html=utf8_decode($html);
    $this->_pdf->load_html($html);
    $this->_pdf->render();
    $this->_pdf->stream("Usuarios".Date('Y-m-d H:i:s').".pdf");
  }

  public function user_excel()
  {
    if(isset($_SESSION['user_id'])):
       $this->id = $_SESSION['user_id'];
    else:
        $this->id = 0;
    endif;
    $this->_user->listar_permisos($this->id,ACCESS_REPORT);

    $Id_user = Core::obtenerIdUrl();
    $array = explode(',',$Id_user);
    $total_Ids = count($array);

    if($total_Ids > 1):

      if(is_array($array)):
        //echo "es un array";
      $os = array("on", "NT", "Irix", "Linux");
      if (in_array("on", $array)) :
      //echo "existe el on";
        unset($array[0]);
      $ids_users = implode(",", $array);
      else:

      $ids_users = implode(",",$array);
      endif;


      endif;
        $query = "SELECT
        iduser,
        foto,
        nombre,
        usuario,
        correo,
        estado
        FROM user
        WHERE iduser IN (".$ids_users." );";
        $this->_view->report_users = $this->_user->find($query,$ids_users);
        //print_r(  $this->_view->report_users);

        $this->getFileReport('reportes/','excelUsuario');




    else:

      //echo $Id_user;
      $query = 'SELECT
                iduser,
                foto,
                nombre,
                usuario,
                correo,
                estado
                FROM user
                WHERE iduser = ?';
      $this->_view->report_users = $this->_user->find($query,$Id_user);
      //print_r($this->_view->report_users);
      $this->getFileReport('reportes/','excelUsuario');


    endif;


  }
  public function user_excel_all()
  {
    if(isset($_SESSION['user_id'])):
       $this->id = $_SESSION['user_id'];
    else:
        $this->id = 0;
    endif;
    $this->_user->listar_permisos($this->id,ACCESS_REPORT);
      $this->_view->report_users = $this->_user->findAll('user');
      //print_r($this->_view->report_users);
      $this->getFileReport('reportes/','excelUsuario');
  }

  public function funcionario_excel()
  {

    if(isset($_SESSION['user_id'])):
       $this->id = $_SESSION['user_id'];
    else:
        $this->id = 0;
    endif;
    $this->_user->listar_permisos($this->id,ACCESS_REPORT);

    $Id_user = Core::obtenerIdUrl();
    $array = explode(',',$Id_user);
    $total_Ids = count($array);

    if($total_Ids > 1):


      if(is_array($array)):
            //echo "es un array";
          $os = array("on", "NT", "Irix", "Linux");
          if (in_array("on", $array)) :
          //echo "existe el on";
            unset($array[0]);
          $ids_users = implode(",", $array);
          else:

          $ids_users = implode(",",$array);
          endif;
      endif;

        $query = "SELECT
                  F.id_funcionario,
                  F.cedula,
                  F.foto,
                  CONCAT(nombre1, ' ', nombre2) nombres,
                  CONCAT(apellido1,' ', apellido2) apellidos,
                  DATE_FORMAT(F.fec_nac,' %d-%m-%Y') AS fec_nac,
                  DATE_FORMAT(F.fec_ingreso,'%d-%m-%Y') AS fec_ingreso,
                  F.estado,
                  F.grado_intruccion,
                  F.profesion,
                  F.code_cargo,
                  F.descrip_cargo,
                  F.func_inhe_cargo,
                  F.obj_desemp_individual,
                  F.id_unidad_adscripta,
                  F.info_complentaria,
                  DATE_FORMAT(F.modified,'%d-%m-%Y') AS fec_modified,
                  DATE_FORMAT(F.created,' %d-%m-%Y') AS fec_created,
                  U.nombre AS unidad,
                  OB.observacion
                  FROM funcionarios F
                  INNER JOIN unidad_adscripta U ON F.id_unidad_adscripta = U.id_unidad_adscripta
                  INNER JOIN observacion_funcionario OB ON F.id_funcionario = OB.id_funcionario
                  WHERE F.id_funcionario IN (".$ids_users." );";
        $this->_view->report_users = $this->_reporte->joins($query);
        //print_r(  $this->_view->report_users);

        $this->getFileReport('reportes/','excelFuncionario');




    else:

      //echo $Id_user;
      $query = "SELECT
                F.id_funcionario,
                F.cedula,
                F.foto,
                CONCAT(nombre1, ' ', nombre2) nombres,
                CONCAT(apellido1,' ', apellido2) apellidos,
                DATE_FORMAT(F.fec_nac,' %d-%m-%Y') AS fec_nac,
                DATE_FORMAT(F.fec_ingreso,'%d-%m-%Y') AS fec_ingreso,
                F.estado,
                F.grado_intruccion,
                F.profesion,
                F.code_cargo,
                F.descrip_cargo,
                F.func_inhe_cargo,
                F.obj_desemp_individual,
                F.id_unidad_adscripta,
                F.info_complentaria,
                DATE_FORMAT(F.modified,'%d-%m-%Y') AS fec_modified,
                DATE_FORMAT(F.created,' %d-%m-%Y') AS fec_created,
                U.nombre AS unidad,
                OB.observacion
                FROM funcionarios F
                INNER JOIN unidad_adscripta U ON F.id_unidad_adscripta = U.id_unidad_adscripta
                INNER JOIN observacion_funcionario OB ON F.id_funcionario = OB.id_funcionario
                WHERE F.id_funcionario IN (".$Id_user." );";
      $this->_view->report_users = $this->_reporte->joins($query);
      //print_r($this->_view->report_users);
      $this->getFileReport('reportes/','excelFuncionario');


    endif;


  }

  public function funcionario_pdf()
  {
    if(isset($_SESSION['user_id'])):
       $this->id = $_SESSION['user_id'];
    else:
        $this->id = 0;
    endif;
    $this->_user->listar_permisos($this->id,ACCESS_REPORT);

    $Id_user = Core::obtenerIdUrl();
    $array = explode(',',$Id_user);
    $total_Ids = count($array);

    if($total_Ids > 1):


      if(is_array($array)):
            //echo "es un array";
          $os = array("on", "NT", "Irix", "Linux");
          if (in_array("on", $array)) :
          //echo "existe el on";
            unset($array[0]);
          $ids_users = implode(",", $array);
          else:

          $ids_users = implode(",",$array);
          endif;
      endif;
        ob_start();
        $query = "SELECT
                  F.id_funcionario,
                  F.cedula,
                  F.foto,
                  CONCAT(nombre1, ' ', nombre2) nombres,
                  CONCAT(apellido1,' ', apellido2) apellidos,
                  DATE_FORMAT(F.fec_nac,' %d-%m-%Y') AS fec_nac,
                  DATE_FORMAT(F.fec_ingreso,'%d-%m-%Y') AS fec_ingreso,
                  F.estado,
                  F.grado_intruccion,
                  F.profesion,
                  F.code_cargo,
                  F.descrip_cargo,
                  F.func_inhe_cargo,
                  F.obj_desemp_individual,
                  F.id_unidad_adscripta,
                  F.info_complentaria,
                  DATE_FORMAT(F.modified,'%d-%m-%Y') AS fec_modified,
                  DATE_FORMAT(F.created,' %d-%m-%Y') AS fec_created,
                  U.nombre AS unidad,
                  OB.observacion
                  FROM funcionarios F
                  INNER JOIN unidad_adscripta U ON F.id_unidad_adscripta = U.id_unidad_adscripta
                  INNER JOIN observacion_funcionario OB ON F.id_funcionario = OB.id_funcionario
                  WHERE F.id_funcionario IN (".$ids_users." );";
        $this->_view->report_users = $this->_user->find($query,$ids_users);
        //print_r($this->_view->report_users);
         ob_start();
            $this->getFileReport('reportes/','pdfFuncionarios');
        $html = ob_get_clean();
      
    else:

      $query = 'SELECT
                F.id_funcionario,
                F.cedula,
                F.foto,
                CONCAT(F.nombre1, " ", F.nombre2, " ", F.apellido1, " ",F.apellido2) nombres_apellidos,
                DATE_FORMAT(F.fec_nac,"%d/%m/%Y") AS fec_nac,
                DATE_FORMAT(F.fec_ingreso,"%d/%m/%Y") AS fec_ingreso,
                TIMESTAMPDIFF(YEAR, F.fec_nac, CURDATE()) AS edad,
                TIMESTAMPDIFF(YEAR, F.fec_ingreso, CURDATE()) AS antiguedad,
                F.estado,
                F.grado_intruccion,
                F.profesion,
                F.code_cargo,
                F.descrip_cargo,
                F.func_inhe_cargo,
                F.obj_desemp_individual,
                F.id_unidad_adscripta,
                F.info_complentaria,
                DATE_FORMAT(F.modified,"%d/%m/%Y") AS fec_modified,
                DATE_FORMAT(F.created,"%d/%m/%Y") AS fec_created,
                U.nombre AS unidad,
                OB.observacion
                FROM funcionarios F
                INNER JOIN unidad_adscripta U ON F.id_unidad_adscripta = U.id_unidad_adscripta
                INNER JOIN observacion_funcionario OB ON F.id_funcionario = OB.id_funcionario
                WHERE F.id_funcionario = ?';
                $this->_view->report_users = $this->_user->find($query,$Id_user);
                //print_r($this->_view->report_users);
                ob_start();
                      $this->getFileReport('reportes/','pdfFuncionario');
                  $html = ob_get_clean();
      endif;

        $this->_pdf = new DOMPDF();
        $this->_pdf->set_paper( array(0,0, 12 * 72, 12 * 72), "portrait" );
        $html=utf8_decode($html);
        $this->_pdf->load_html($html);
        $this->_pdf->render();
        $this->_pdf->stream("Funcionarios".Date('Y-m-d H:i:s').".pdf");

  }

  public function funcionario_pdf_all()
  {
    $query = "SELECT
              F.id_funcionario,
              F.cedula,
              F.foto,
              CONCAT(nombre1, ' ', nombre2) nombres,
              CONCAT(apellido1,' ', apellido2) apellidos,
              DATE_FORMAT(F.fec_nac,' %d-%m-%Y') AS fec_nac,
              DATE_FORMAT(F.fec_ingreso,'%d-%m-%Y') AS fec_ingreso,
              F.estado,
              F.grado_intruccion,
              F.profesion,
              F.code_cargo,
              F.descrip_cargo,
              F.func_inhe_cargo,
              F.obj_desemp_individual,
              F.id_unidad_adscripta,
              F.info_complentaria,
              DATE_FORMAT(F.modified,'%d-%m-%Y') AS fec_modified,
              DATE_FORMAT(F.created,' %d-%m-%Y') AS fec_created,
              U.nombre AS unidad,
              OB.observacion
              FROM funcionarios F
              INNER JOIN unidad_adscripta U ON F.id_unidad_adscripta = U.id_unidad_adscripta
              INNER JOIN observacion_funcionario OB ON F.id_funcionario = OB.id_funcionario
              ORDER BY F.id_funcionario DESC";

    $this->_view->report_users = $this->_reporte->joins($query);
    //print_r($this->_view->report_users);
    ob_start();
            $this->getFileReport('reportes/','pdfFuncionarios');
        $html = ob_get_clean();

        $this->_pdf = new DOMPDF();
        $this->_pdf->set_paper( array(0,0, 12 * 72, 12 * 72), "portrait" );
        $html=utf8_decode($html);
        $this->_pdf->load_html($html);
        $this->_pdf->render();
        $this->_pdf->stream("Funcionarios".Date('Y-m-d H:i:s').".pdf");
  }

  public function funcionario_excel_all()
  {
    if(isset($_SESSION['user_id'])):
       $this->id = $_SESSION['user_id'];
    else:
        $this->id = 0;
    endif;
    $this->_user->listar_permisos($this->id,ACCESS_REPORT);
    $query = "SELECT
              F.id_funcionario,
              F.cedula,
              F.foto,
              CONCAT(nombre1, ' ', nombre2) nombres,
              CONCAT(apellido1,' ', apellido2) apellidos,
              DATE_FORMAT(F.fec_nac,' %d-%m-%Y') AS fec_nac,
              DATE_FORMAT(F.fec_ingreso,'%d-%m-%Y') AS fec_ingreso,
              F.estado,
              F.grado_intruccion,
              F.profesion,
              F.code_cargo,
              F.descrip_cargo,
              F.func_inhe_cargo,
              F.obj_desemp_individual,
              F.id_unidad_adscripta,
              F.info_complentaria,
              DATE_FORMAT(F.modified,'%d-%m-%Y') AS fec_modified,
              DATE_FORMAT(F.created,' %d-%m-%Y') AS fec_created,
              U.nombre AS unidad,
              OB.observacion
              FROM funcionarios F
              INNER JOIN unidad_adscripta U ON F.id_unidad_adscripta = U.id_unidad_adscripta
              INNER JOIN observacion_funcionario OB ON F.id_funcionario = OB.id_funcionario
              ORDER BY F.id_funcionario DESC";

              $this->_view->report_users = $this->_reporte->joins($query);

      //print_r($this->_view->report_users);
      $this->getFileReport('reportes/','excelFuncionario');
  }

  public function bienes_excel()
  {
    if(isset($_SESSION['user_id'])):
       $this->id = $_SESSION['user_id'];
    else:
        $this->id = 0;
    endif;
    $this->_user->listar_permisos($this->id,ACCESS_REPORT);

    $Id_bien = Core::obtenerIdUrl();
    $array = explode(',',$Id_bien);
    $total_Ids = count($array);

    if(is_array($array)):
          $os = array("on", "NT", "Irix", "Linux");
          if (in_array("on", $array)) :
            //echo "existe el on";
              unset($array[0]);
              $Id = implode(",", $array);
              //echo $Id;
          else:
              //echo "no existe el on";
              $Id = implode(",", $array);
              //echo   $Id;
          endif;
    endif;

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
    FC.nombre1 AS nom_func,
    FC.apellido1 AS apellido_func,
    O.observacion,
    O.id_observacion,
    DATE_FORMAT(ART.created, '%d %M %Y %h:%i:%s') AS creado,
    DATE_FORMAT(ART.modified, '%d %M %Y %h:%i:%s') AS editado,
    CAT.nombre AS categoria,
    U.nombre AS nom_unidad
     FROM bienes ART
    INNER JOIN categoria CAT ON ART.id_categoria = CAT.id_categoria
    INNER JOIN unidad_adscripta U ON ART.id_unidad_adscripta = U.id_unidad_adscripta
    INNER JOIN funcionarios FC ON ART.id_funcionario = FC.id_funcionario
    INNER JOIN observacion_bien O ON ART.id_bien = O.id_bien
    WHERE ART.id_bien IN (".$Id." );";

    $this->_view->report_bienes = $this->_reporte->find($query,$Id);
    //print_r(  $this->_view->report_users);

    $this->getFileReport('reportes/','excelBien');
  }

  public function bienes_excel_all()
  {
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
    FC.nombre1 AS nom_func,
    FC.apellido1 AS apellido_func,
    O.observacion,
    O.id_observacion,
    DATE_FORMAT(ART.created, '%d %M %Y %h:%i:%s') AS creado,
    DATE_FORMAT(ART.modified, '%d %M %Y %h:%i:%s') AS editado,
    CAT.nombre AS categoria,
    U.nombre AS nom_unidad
     FROM bienes ART
    INNER JOIN categoria CAT ON ART.id_categoria = CAT.id_categoria
    INNER JOIN unidad_adscripta U ON ART.id_unidad_adscripta = U.id_unidad_adscripta
    INNER JOIN funcionarios FC ON ART.id_funcionario = FC.id_funcionario
    INNER JOIN observacion_bien O ON ART.id_bien = O.id_bien";

    $this->_view->report_bienes = $this->_reporte->joins($query);
    //print_r(  $this->_view->report_users);

    $this->getFileReport('reportes/','excelBien');

  }

}
