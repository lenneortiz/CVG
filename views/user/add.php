<!-- page content -->
<div class="right_col" role="main" id="right_col">
        <section class="content-header">

<ol class="breadcrumb">
  <?php $breadcrumb = explode("/",$_SERVER["REQUEST_URI"]);?>
  <?php   $totalUri = count($breadcrumb);?>
     <?php if (is_array($breadcrumb )):?>

       <?php if ($totalUri == 6): ?>
          <?php $salida = array_slice($breadcrumb,2, -3); ?>
       <?php elseif ($totalUri == 5):?>
          <?php $salida = array_slice($breadcrumb,2, -2); ?>
      <?php else: ?>
        <?php $salida = array_slice($breadcrumb,2, -1); ?>
      <?php endif; ?>

         <?php foreach ($salida as $enlace): ?>
           <li class="active"><a href="<?php echo BASE_URL.strtolower($enlace); ?>"><?php echo ucfirst($enlace); ?></a></li>
         <?php endforeach; ?>

      <?php else: ?>
         <li class="active"><a href="#">home</a></li>
      <?php endif; ?>

</ol>
</section>

        <div class="clearfix"></div>

        <div class="row">

                <section class="content-header">
                        <h2></h2>
                </section>


                <!-- x_panel-->
                <div class="x_panel">
                        <!-- x_content-->
                        <div class="x_content">
                          <?php $error = array_pop($breadcrumb); ?>
                          <?php echo Core::error_get($error); ?>

                                             <div class="title_left">

                                             </div>

                             <form id="FormAddUser" name="FormAddUser" autocomplete="on" action="<?php echo BASE_URL;?>user/add" method="post" enctype="multipart/form-data">
                               <div class="col-md-6">
                                 <div class="row">
                                   <input type="hidden" value="1" name="add" />
                                   <input type="hidden" value="avatar.png" name="foto-user" />

                                   <div class="form-group label-floating">
                                        <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
                                             <label for="nombre">Nombre:</label>
                                        </div>
                                        <div class="col-md-10 col-lg-10 col-ms-10 col-xs-10">
                                             <input type="text" class="form-control" placeholder="Nombre"  maxlength="13" name="nombre" id="nombre" autofocus="" required="required">
                                        </div>
                                   </div>
                                   <div class="clearfix"></div><br>

                                   <div class="form-group label-floating">
                                        <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
                                             <label for="usuario">Usuario:</label>
                                        </div>
                                        <div class="col-md-10 col-lg-10 col-ms-10 col-xs-10">
                                             <input type="text" class="form-control" placeholder="nombre de usuario"  maxlength="12" name="usuario" id="usuario" required="required">
                                        </div>

                                   </div>

                                   <div class="clearfix"></div><br>

                                   <div class="form-group label-floating">

                                        <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
                                             <label for="correo">correo:</label>
                                        </div>
                                        <div class="col-md-10 col-lg-10 col-ms-10 col-xs-10">
                                             <input class="form-control" name="correo" id="correo" type="email" >
                                             <!--<p class="help-block">Escribe tú E-mail</p>-->
                                        </div>
                                   </div>

                                   <div class="clearfix"></div><br>

                                   <div class="form-group label-floating">

                                        <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
                                             <label for="pass">Clave:</label>
                                        </div>
                                        <div class="col-md-10 col-lg-10 col-ms-10 col-xs-10">
                                          <!-- <span class="input-group-addon"><i class="fa fa-bolt" aria-hidden="true"></i></span> -->
                                             <input type="password"  class="form-control" placeholder="escriba la clave de usuario" name="pass" id="pass" required="required" maxlength="255">
                                             <!--<p class="help-block">Escribe una clave</p>-->
                                        </div>
                                   </div>
                                   <div class="clearfix"></div><br>

                                   <div class="form-group label-floating">

                                        <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
                                             <label for="pass">Confirm.<br>Clave:</label>
                                        </div>
                                        <div class="col-md-10 col-lg-10 col-ms-10 col-xs-10">
                                          <!-- <span class="input-group-addon"><i class="fa fa-bolt" aria-hidden="true"></i></span> -->
                                             <input type="password"  class="form-control" placeholder="Repita la clave de usuario" name="confirm_pass" id="confirm_pass" required="required" maxlength="255">
                                             <!--<p class="help-block">Escribe una clave</p>-->
                                        </div>
                                   </div>

                                   <div class="clearfix"></div><br>

                                   <!--<div class="form-group label-floating">

                                        <div class="col-md-3 col-lg-4 col-xs-12">
                                             <label for="role">Tipo de Usuario:</label>
                                        </div>
                                        <div class="col-md-9 col-lg-4 col-xs-12">
                                             <select class="form-control" name="role">
                                                  <option value="">Seleccione un rol</option>
                                                  <option value="admin"    <?php //if($this->user[0]['role']=="admin") echo "selected";?>>Aministrador</option>
                                                  <option value="usuario"  <?php //if($this->user[0]['role']=="usuario") echo "selected";?>>Usuario</option>
                                                  <option value="especial" <?php //if($this->user[0]['role']=="especial") echo "selected";?>>Especial</option>
                                             </select>
                                        </div>
                                   </div>-->

                                   <div class="clearfix"></div><br>

                                   <div class="form-group label-floating">

                                        <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
                                             <label for="estado">Estado:</label>
                                        </div>
                                        <div class="col-md-10 col-lg-10 col-ms-10 col-xs-10">
                                             <select class="form-control" name="estado">
                                                  <option value="">Seleccione un estado</option>
                                                  <<option value="1">ACTIVO</option>
                                                  <option value="0">NO ACTIVO</option>
                                             </select>
                                        </div>
                                   </div>
                                   <div class="clearfix"></div><br>

                                   <div class="form-group label-floating">

                                        <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
                                             <label for="estado">Perfil:</label>
                                        </div>
                                        <div class="col-md-10 col-lg-10 col-ms-10 col-xs-10">
                                           <select class="form-control" name="id_perfil" id="id_perfil">

                                             <?php foreach($this->perfiles as $perfil): ?>
                                               <option value="<?php echo $perfil['idperfil']; ?>" ><?php echo $perfil['nombre'] ?></option>
                                             <?php endforeach; ?>
                                           </select>
                                        </div>
                                   </div>
                                   </div>
                                   <!-- /row-->
                                 </div>
                                 <!-- /col-md-6-->

                                 <div class="col-md-5 col-lg-4 col-xs-12  col-sm-4" id="cont-input-foto">
                                    <div class="form-group label-floating">
                                   <div class="kv-avatar center-block">

        		                           <img src="<?php echo BASE_URL ?>upload/avatar.png" id="foto-user" style="width:100%;height:265px"/>

                                       <div class="clearfix"></div><br>

                                       <input id="foto" name="foto" type="file" data-show-upload="false" width="80%" class=" btn-success">
        		   		                 </div>



                                    </div>

                                 </div>

                                 <div class="clearfix"></div><br>
                                 <div class="clearfix"></div><br>
                                 <div class="col-md-3 col-sm-3 col-lg-3 col-xs-12">
                                      <button type="submit" class="btn btn-block  btn-success btn-lg">Guardar</button>
                                 </div>



                             </form>

            </div>
                <!-- /x_content-->

        </div>
        <!-- /x_panel-->

</div>
<!--/row-->

</div>
<!-- /page content -->
