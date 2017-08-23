<!DOCTYPE html>
<html lang="es">
<head>
 <style>
 @page { margin: 180px 50px; }
   #header {
     position: fixed;
     left: 0px;
     top: -180px;
     right: 0px;
     height: 150px;
     width: 800px;
     }
     .footer { position: fixed; left: 0px; bottom: -90px; right: 0px; height: 50px;text-align: center;}
    .footer .pagenum:before { content: counter(page); }
.logo__empresa{

  width:230px;
  height: 130px;
  margin-top: 10px;
}

 table{width:99%; border-collapse:collapse; table-layout:auto; vertical-align:top; margin-bottom:15px; border:none;margin:2px 0 0 2px;border-bottom: 1px solid}
 table thead th{font-size: 10px; color:#FFFFFF; background-color:#062121; border:1px solid #CCCCCC; border-collapse:collapse; text-align:center; table-layout:auto; vertical-align:middle;}
 table tbody td{vertical-align:top; border-collapse:collapse; border-left:1px solid #CCCCCC; border-right:1px solid #CCCCCC; font-size: 12px;text-align: center}
 table thead th, table tbody td{padding:1px; border-collapse:collapse;}
 table tbody tr.light{color:#979797; background-color:#F7F7F7;}
 table tbody tr.dark{color:#979797; background-color:#E8E8E8;}

table tbody>tr:nth-of-type(odd) {
     background-color:#d3d6db
 }
.content_tabla_bienes_totales{
  margin-top: 30px;
  margin-right: 50px
}
.total{
  background: #fff
}
 #bienes{width:55%; border-collapse:collapse; vertical-align:top; margin-bottom:5px; border:none;margin-left: 510px;margin-top:-130px}
 #bienes thead th{font-size: 10px; color:#181810; background-color:#f8fcfb;border:1px solid #CCCCCC; border-collapse:collapse; text-align:center; table-layout:auto; vertical-align:middle;}
 #bienes tbody td{vertical-align:top; border-collapse:collapse; border-left:1px solid #CCCCCC; border-right:1px solid #CCCCCC; font-size: 10px;text-align: center}
 #bienes thead th, table tbody td{padding:1px; border-collapse:collapse;}
 #bienes tbody tr.light{color:#979797; background-color:#F7F7F7;}
 #bienes tbody tr.dark{color:#979797; background-color:#E8E8E8;}

 #bienes tbody>tr:nth-of-type(odd) {
     background-color:#d3d6db
 }
 </style>
  </head>

  <body>
    <div id="header">
      <img class="logo__empresa"src="upload/CVG.png" />
      <div class="content_tabla_bienes_totales">


        <table id="bienes" align="right" border="0" cellpadding="0" cellspacing="10" class="table table-striped">
          <thead>
            <tr>
              <th>BIENES</th>
              <th>OPERATIVO</th>
              <th>INOPERATIVO</th>
              <th>REGULAR</th>
              <th>BIENES TOTALES</th>
            </tr>
          </thead>
            <tbody>
            <?php foreach($this->_view->unidadedes as $bien_unidad): ?>

              <tr>
                <td><?php echo $bien_unidad['unidad_nom']?></td>
                <td><?php echo $bien_unidad['operativo']?></td>
                <td><?php echo $bien_unidad['inoperativo']?></td>
                <td><?php echo $bien_unidad['regular']?></td>
                <?php $a = array($bien_unidad['operativo'],$bien_unidad['inoperativo'],$bien_unidad['regular']); ?>
                <td><?php $total = array_sum($a); echo $total; ?></td>

                </tr>

          <?php  endforeach; ?>
          <tr class="total">
           <td colspan="4"></td>
           <th><?php echo  $this->_view->bienes_total[0]['total']; ?></th>
          </tr>
        </tdbody>
        </table>
      </div>
    </div>
    <div class="footer">

                Página <span class="pagenum"></span>
            </div>
    <table class="table table-striped">


              <thead>
               <tr>
                <th> N&#176; INVENTARIO/<br>SERIAL</th>
                <th>DESCRIPCIÓN DEL BIEN</th>
                <th>MARCA/MODELO/<br>ESPECIFICACIONES</th>
                <th>UNIDAD ADCRIPCIÓN/UBICACIÓN</th>
                <th>FUNCIONARIO RESPONSABLE</th>
                <th>CONDICIÓN</th>
                <th>OBSERVACIONES</th>
              </tr>
            </thead>

            <tbody>
              <?php foreach($this->_view->report_bienes as $bien): ?>
              <tr>
                <td><?php echo $bien['bien_codigo']?></td>
                <td><?php echo $bien['bien_descripcion']?></td>
                <td><?php echo $bien['bien_nombre']?></td>
                <td><?php echo $bien['nom_unidad']?></td>
                <td><?php echo $bien['nom_func'].' '. $bien['apellido_func'];?></td>
                <?php if ($bien['estado'] == 1): ?>
                  <td>OPERATIVO</td>
                <?php elseif ($bien['estado'] == 0):?>
                  <td>INOPORATIVO</td>
               <?php else: ?>
                 <td>REGULAR</td>
                <?php endif; ?>
                <td><?php echo $bien['observacion']?></td>
              </tr>
            <?php endforeach; ?>
            </tbody>
    </table>
</body>
</html>
