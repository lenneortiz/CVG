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
                        <h2>Area de asignación edición de permisos para los usuarios del Sistema</h2>
                </section>


                <!-- x_panel-->
                <div class="x_panel">
                        <!-- x_content-->
                        <div class="x_content">
                          <?php $error = array_pop($breadcrumb); ?>
                          <?php echo Core::error_get($error); ?>
                          <div class="title_left"></div>

                             <form id="FormAddPermisos" name="FormAddUser" autocomplete="on" action="<?php echo BASE_URL;?>permiso/edit_recursos_perfil" method="post" enctype="multipart/form-data">

                             <div class="col-md-12 col-lg-12 col-xs-12">
                               <div class="clearfix"></div><br>

                               <div class="form-group label-floating">
                                 <label for="perfil">Perfil:</label>
                                  <select class="form-control" name="id_perfil" id="id_perfil" >
                                     <option value="">Seleccione un Perfil</option>
                                      <?php foreach($this->perfiles as $perfil): ?>
                                      <option value="<?php   echo $perfil['idperfil']; ?>" data-href="<?php echo BASE_URL;?>permiso/permisos_perfiles"><?php   echo $perfil['nombre']; ?></option>
                                      <?php endforeach; ?>
                                  </select>
                                  <div class="data-permiso-perfil">

                                  </div>

                               </div>


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
