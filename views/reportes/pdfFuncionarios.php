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
 #bienes{width:55%; border-collapse:collapse; vertical-align:top; margin-bottom:5px; border:none;margin-right: 10px;margin-top:-150px}
 #bienes thead th{font-size: 10px; color:#181810; background-color:#f8fcfb;border:1px solid #CCCCCC; border-collapse:collapse; text-align:center; table-layout:auto; vertical-align:middle;}
 #bienes tbody td{vertical-align:top; border-collapse:collapse; border-left:1px solid #CCCCCC; border-right:1px solid #CCCCCC; font-size: 10px;text-align: center}
 #bienes thead th, table tbody td{padding:1px; border-collapse:collapse;}
 #bienes tbody tr.light{color:#979797; background-color:#F7F7F7;}
 #bienes tbody tr.dark{color:#979797; background-color:#E8E8E8;}

 #bienes tbody>tr:nth-of-type(odd) {
     background-color:#d3d6db
 }
 legend{
   margin-left : 35%;

 }
 </style>
  </head>

  <body>
    <div id="header">
      <img class="logo__empresa"src="upload/CVG.png" />
    </div>
    <div class="footer">

                Página <span class="pagenum"></span>
            </div>
            <legend><h2>Listado de Funcionarios</h2></legend>
    <table class="table table-striped">


              <thead>
               <tr>
                <th> ID</th>
                <th>CODE.CARGO</th>
                <th>FOTO</th>
                <th>NOMBRES</th>
                <th>APELLIDOS</th>
                <th>PROFESION</th>
                <th>UNIDAD ADSCRIPTA</th>
                <th>ESTADO</th>

              </tr>
            </thead>

            <tbody>
              <?php foreach($this->_view->report_users as $user): ?>
              <tr>
                <td width="20px"><?php echo $user['id_funcionario']?></td>
                <td><?php echo $user['code_cargo']?></td>
                <td width="50px" height="35px"><?php echo'<img src="upload/'.$user ['foto'].'" width="50px" height="35px">'; ?></td>
                <td><?php echo $user['nombres']?></td>
                <td><?php echo $user['apellidos']?></td>
                <td><?php echo $user['profesion'];?></td>
                <td><?php echo $user['unidad'];?></td>
                <td><?php echo $estado = ($user['estado'] == 1) ? "activo" : "inactivo"; ?></td>
              </tr>
            <?php endforeach; ?>
            </tbody>
    </table>
</body>
</html>
