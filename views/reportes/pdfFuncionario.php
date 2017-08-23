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

.logo__empresa{

  width:230px;
  height: 130px;
  margin-top: 10px;
}

table{width:100%; table-layout:auto; vertical-align:top; margin-bottom:15px;}
 table th{font-size: 14px; color:#4a4a4a; background-color:#f3f3f3;  border-collapse:collapse; text-align:center; table-layout:auto; vertical-align:middle;}

  caption{
      text-align: center;
      padding: 5px 0;
      font-size: 1.7em;
      color: #4a4a4a;
      margin-bottom: 1em

    }
    #container{
      width: 750px;
      height: auto;
      margin: 0 auto;
      margin-top: 10px;

    }

    table td img{
      margin-left:10px;
      width: 155px;
      height: 105px
    }

 </style>
  </head>

  <body>
    <div id="header">
      <img class="logo__empresa"src="upload/CVG.png" />
    </div>
<div id="container">



  <table border="1px">
  <caption>Hoja de perfil individual de empleado </caption>
  <tr>
  <th colspan="2">Foto</th>
  <th>Cédula</th>
  <th colspan="2">Apellidos y nombres</th>
  <th>Fecha <br>Nacimiento</th>
  <th>Fecha <br>Ingreso</th>
  </tr>
  <tr>
  <td rowspan="3" colspan="2"><?php echo'<img src="upload/'.$this->_view->report_users[0]['foto'].'">'; ?></td>
  <td><?php echo $this->_view->report_users[0]['cedula']?></td>
  <td colspan="2"><?php echo $this->_view->report_users[0]['nombres_apellidos']?></td>
  <td><?php echo $this->_view->report_users[0]['fec_nac']?></td>
  <td><?php echo $this->_view->report_users[0]['fec_ingreso']?></td>
  </tr>
  <tr>
  <th>Status</th>
  <th>Grado de <br>Instrución</th>
  <th>Profesión</th>
  <th>Edad</th>
  <th>Antiguedad</th>
  </tr>
  <tr>
  <?php if ($this->_view->report_users[0]['estado'] == 1): ?>
    <td>Activo</td>
  <?php else: ?>
    <td>Inactivo</td>
  <?php endif; ?>
  <td><?php echo $this->_view->report_users[0]['grado_intruccion']?></td>
  <td><?php echo $this->_view->report_users[0]['profesion']?></td>
  <td><?php echo $this->_view->report_users[0]['edad']?></td>
    <td><?php echo $this->_view->report_users[0]['antiguedad']?></td>
  </tr>
  <tr>
  <th colspan="2">Cod_Cargo</th>
  <th colspan="3">Descripción del Cargo</th>
  <th colspan="2">Funciones Inherentes al Cargo</th>
  </tr>
  <tr>
    <td colspan="2"><?php echo $this->_view->report_users[0]['code_cargo']?></td>
    <td colspan="3"><?php echo $this->_view->report_users[0]['descrip_cargo']?></td>
    <td colspan="2"><?php echo $this->_view->report_users[0]['func_inhe_cargo']?></td>
  </tr>
  <tr>
    <th colspan="4">ODI (Objetivos Desempeño Individual)</th>
    <th colspan="3">Observaciones</th>
  </tr>

  <tr>
    <td colspan="4"><?php echo $this->_view->report_users[0]['obj_desemp_individual']?></td>
    <td colspan="3"><?php echo $this->_view->report_users[0]['observacion']?></td>
  </tr>
  <tr>
    <th colspan="5">Información Complementaria (Habilidades, Destrezas del Recurso)</th>
    <th colspan="2">Unidad Adscripta</th>
  </tr>
  <tr>
    <td colspan="5"><?php echo $this->_view->report_users[0]['info_complentaria']?></td>
    <td colspan="2"><?php echo $this->_view->report_users[0]['unidad']?></td>
  </tr>



  </table>

  </div>

</body>
</html>
