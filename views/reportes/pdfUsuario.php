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

table{width:100%; border-collapse:collapse; table-layout:auto; vertical-align:top; margin-bottom:15px; }
 table thead th{font-size: 14px; color:#FFFFFF; background-color:#666666; border:1px solid #CCCCCC; border-collapse:collapse; text-align:center; table-layout:auto; vertical-align:middle;}
 table tbody td{vertical-align:top; border-collapse:collapse; border-left:1px solid #CCCCCC; border-right:1px solid #CCCCCC; font-size: 14px;text-align: left}
 table thead th, table tbody td{padding:5px; border-collapse:collapse;}
 table tbody tr.light{color:#979797; background-color:#F7F7F7;}
 table tbody tr.dark{color:#979797; background-color:#E8E8E8;}
  .titulo-user{
      width: 100%;
      text-align: center;
      background: #64868E;
      padding: 5px 0;
      color: #fff

    }
    #container{
      width: 700px;
      height: 360px;
      background: #D1E4D1;
      margin: 0 auto;
      margin-top: 10px;

    }
    .cont-foto{
      background: #F3FBF1;
      width: 200px;
      height: 85px
    }
    table td img{
      margin: 0 auto;
    }
 </style>
  </head>

  <body>
    <div id="header">
      <img class="logo__empresa"src="upload/CVG.png" />
    </div>
<div id="container">


  <div class="titulo-user"><h2>Datos del usuario: <?php echo $this->_view->report_users[0]['usuario']?></h2></div>
  <table border="1px" border-color="#6C737E">

             <tr>
                 <td class="cont-foto" rowspan="3"><?php echo'<img src="upload/'.$this->_view->report_users[0]['foto'].'" width="200px" height="110px">'; ?></td>
                 <td class="datos" >Nombre: <?php echo $this->_view->report_users[0]['nombre']?></td>

             </tr>
             <tr>
                 <td class="datos">Usuario: <?php echo $this->_view->report_users[0]['usuario']?></td>

             </tr>
             <tr>
                 <td class="datos">Correo: <?php echo $this->_view->report_users[0]['correo']?></td>

             </tr>

         </table>

  </div>

</body>
</html>
