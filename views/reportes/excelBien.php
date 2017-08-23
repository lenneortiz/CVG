<?php
PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
/******************************************************/
$objPHPExcel = new PHPExcel();
$fecha = date("Y-m-d H:i:s");
// Se asignan las propiedades del libro
$objPHPExcel->getProperties()->setCreator("lenneortiz") // Nombre del autor
->setLastModifiedBy("lenne") //Ultimo usuario que lo modificó
->setTitle("Reporte Excel") // Titulo
->setSubject("Reporte Excel de listado de Bienes") //Asunto
->setDescription("Reporte de Bienes") //Descripción
->setCategory("Reporte excel"); //Categorias

$tituloReporte = "Listado de Bienes";
$titulosColumnas = array(
  "SERIAL",
  "NOMBRE",
  "DESCRIPCIÓN",
  "UNIDAD ADSCRIPCIÓN",
  "FUNCIONARIO RESPONSABLE",
  "TIPO/BIEN",
  "CONDICIÓN",
"OBSERVACIONES");

$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial')
                                          ->setSize(10);
// Se agregan los titulos del reporte
            $objPHPExcel->setActiveSheetIndex(0)
            //->setCellValue('A1',$tituloReporte) // Titulo del reporte
            ->setCellValue('A1',  $titulosColumnas[0])  //Titulo de las columnas
            ->setCellValue('B1',  $titulosColumnas[1])
            ->setCellValue('C1',  $titulosColumnas[2])
            ->setCellValue('D1',  $titulosColumnas[3])
            ->setCellValue('E1',  $titulosColumnas[4])
            ->setCellValue('F1',  $titulosColumnas[5])
            ->setCellValue('G1',  $titulosColumnas[6])
            ->setCellValue('H1',  $titulosColumnas[7]);

$i = 2; //Numero de fila donde se va a comenzar a rellenar
foreach( $this->_view->report_bienes as $bien) {
     $objPHPExcel->setActiveSheetIndex(0)
         ->setCellValue('A'.$i, $bien['bien_codigo'])
         ->setCellValue('B'.$i, $bien['bien_nombre'])
         ->setCellValue('C'.$i, $bien['bien_descripcion'])
         ->setCellValue('D'.$i, $bien['nom_unidad'])
         ->setCellValue('E'.$i, $bien['nom_func'].' '.$bien['apellido_func'])
         ->setCellValue('F'.$i, $bien['categoria'])
         ->setCellValue('G'.$i,  ($bien['estado'] == 1 )?'OPERATIVO':'INOPERATIVO')
         ->setCellValue('H'.$i, $bien['observacion']);
     $i++;
}
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);

$estiloTituloColumnas = array(
     'font' => array(
         'name'  => 'Arial',
         'size' =>10,
         'bold'  => false,
         'color' => array(
             'rgb' => 'FFFFFF'
         )
     ),
     'fill' => array(
         'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
   'rotation'   => 90,
         'startcolor' => array(
             'rgb' => 'c47cf2'
         )
     ),


);

$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray($estiloTituloColumnas);

$objPHPExcel->getActiveSheet()->setTitle('Informe de Bienes');

$objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Excel5)
  header('Content-Type: application/vnd.ms-excel');
  header("Content-Disposition: attachment; filename='Bienes-".$fecha.".xlsx'");
  header('Cache-Control: max-age=0');
  // If you're serving to IE 9, then the following may be needed
  header('Cache-Control: max-age=1');
  header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
  header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
  header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
  header ('Pragma: public'); // HTTP/1.0
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
ob_end_clean();
$objWriter->save('php://output');
exit;
 ?>