
  <?php $breadcrumb = explode("/",$_SERVER["REQUEST_URI"]);?>
  <?php $error = array_pop($breadcrumb); ?>
  <?php echo Core::error_get($error); ?>
<form id='loginForm' name="formLogin" action="<?php echo BASE_URL;?>index/" method="post" autocomplete="on" class="full-box logInForm">
    <p class="text-center text-muted"><i class="zmdi zmdi-account-circle zmdi-hc-5x"></i></p>
    <p class="text-center text-muted text-uppercase">Inicia sesión con tu cuenta</p>

<input type="hidden" value="1" name="enviar" />
      <div class="body bg-gray">
        <div class="form-group label-floating">
          <label class="control-label" for="correo">E-mail</label>
          <input class="form-control" name="correo" id="correo" type="email" value="<?php if (isset($_POST['correo'])) echo $_POST['correo'];  ?>" >
          <p class="help-block">Escribe tú E-mail</p>
        </div>
          <div class="form-group label-floating">
            <label class="control-label" for="pass">Contraseña</label>
            <input class="form-control" name="pass" id="pass" type="password" value="<?php if (isset($_POST['pass'])) echo $_POST['pass']; ?>" autocomplete="off" >

          </div>

      </div>
      <div class="form-group text-center">
        <input type="submit" value="Iniciar sesión" class="btn btn-raised btn-danger">

        <button type="button" name="" data-toggle="modal" data-target="#myModal" class="btn btn-raised btn-success">¿olvido su contraseña?</button>

      </div>

  </form>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

       <div class="modal-dialog">
           <div class="modal-content ">
               <div class="modal-header ">
                   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
                   <center>
                       <form role="form"  name="fe" action="" method="post" >
                           <h4 class="modal-title" id="myModalLabel">Recuperar Contraseña </h4>
               </div>
               <div class="modal-body">
                   <center>
                       <div class="span12 alert alert-success" style="margin-left: 0">Datos para recuperar tu contraseña.</div>
                   </center>
                   <div class="box-body">
                       <div class="row">
                           <div class="col-xs-12">
                               <label>Correo </label>
                               <p><input type="email" name="email" id="txtNombreCurso" placeholder="Correo Electronico" required="" class="form-control"></p>
                           </div>
                       </div>
                   </div>
                   </br>
                   <div class="span12 alert alert-success" style="margin-left: 0">Te enviaremos tu contraseña a tu correo</div>
               </div>

               <div class="modal-footer">
                   <button name="btn1" type="submit" value="Agregar" class="btn btn-raised btn-success">Recuperar</button>
                   </form>
               </div>
           </div>
       </div>
   </div>
 </div><!--and modal-->
 <?php
 ob_start();
 ?>
