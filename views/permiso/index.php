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
                        <h2>Area de asignación de permisos y acciones a los usuarios del Sistema</h2>
                </section>


                <!-- x_panel-->
                <div class="x_panel">
                        <!-- x_content-->
                        <div class="x_content">
                          <?php $error = array_pop($breadcrumb); ?>
                          <?php echo Core::error_get($error); ?>
                          <div class="title_left"></div>

                             <form id="FormAddPermisos" name="FormAddUser" autocomplete="on" action="<?php echo BASE_URL;?>permiso/" method="post" enctype="multipart/form-data">

                             <div class="col-md-12 col-lg-12 col-xs-12">
                               <div class="clearfix"></div><br>

                               <div class="form-group label-floating">
                                 <label for="perfil">Perfil:</label>
                                  <select class="form-control" name="id_perfil" id="id_perfil">
                                     <option value="">Seleccione un Perfil</option>
                                      <?php foreach($this->perfiles as $perfil): ?>
                                      <option value="<?php   echo $perfil['idperfil']; ?>"><?php   echo $perfil['nombre']; ?></option>
                                      <?php endforeach; ?>
                                  </select>

                               </div>

                             </div>
                             <!-- /col-md-6-->
                             <div class="clearfix"></div><br>
                             <div class="col-md-4"> <label class="btn btn-danger"><input type="checkbox" id="checkAll"/> Marcar Todo</label></div>
                             <div class="col-md-12"></div>


                             <!--<div class="col-md-2">
                               <div class="btn-group btn-group-justified" role="group" aria-label="...">
                                 <div class="btn-group" role="group">
                                   <button type="button" class="btn btn-success"><p>Recursos</p></button>
                                 </div>
                               </div>
                               <?php //$totalrecursos = count($this->recursos);?>
                               <ul class="list-group">
                               <?php //foreach($this->recursos as $recurso): ?>
                               <li class="list-group-item">
                                 <input class="checkItem" type="checkbox" id="id_recurso" name="id_recurso[]" value="<?php //echo $recurso['idrecurso'] ?>">
                              <?php //echo $recurso['nombre'] ?>
                               </li>
                                 <?php //endforeach; ?>
                             </ul>
                           </div>-->
                             <!-- /col-md-3-->
                             <div class="col-md-2">
                               <div class="btn-group btn-group-justified" role="group" aria-label="...">
                                 <div class="btn-group" role="group">
                                   <button type="button" class="btn btn-success"><p>Consultar</p></button>
                                 </div>
                               </div>

                                 <div class="checkbox">
                                 <label>
                                    &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
                                   <input class="checkItem" type="checkbox" name="consultar" value="1">
                                  <div style="padding:1.2em">
                                    &nbsp;
                                  </div>
                                 </label>
                               </div>

                             </div>
                              <!-- /col-md-2-->

                              <div class="col-md-2">
                                <div class="btn-group btn-group-justified" role="group" aria-label="...">
                                  <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-success"><p>Registrar</p></button>
                                  </div>
                                </div>
                                <?php //for($i = 0;$i<$totalrecursos; $i++):?>
                                  <div class="checkbox">
                                  <label>
                                     &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
                                    <input class="checkItem" type="checkbox" name="registrar" value="2">
                                   <div style="padding:1.2em">
                                     &nbsp;
                                   </div>
                                  </label>
                                </div>
                               <?php //endfor;?>
                              </div>
                               <!-- /col-md-2-->

                               <div class="col-md-2">
                                 <div class="btn-group btn-group-justified" role="group" aria-label="...">
                                   <div class="btn-group" role="group">
                                     <button type="button" class="btn btn-success"><p>Editar</p></button>
                                   </div>
                                 </div>
                                 <?php //for($i = 0;$i<$totalrecursos; $i++):?>
                                   <div class="checkbox">
                                   <label>
                                      &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
                                     <input class="checkItem" type="checkbox" name="editar" value="3">
                                    <div style="padding:1.2em">
                                      &nbsp;
                                    </div>
                                   </label>
                                 </div>
                                <?php //endfor;?>
                               </div>
                                <!-- /col-md-2-->

                                <div class="col-md-2">
                                  <div class="btn-group btn-group-justified" role="group" aria-label="...">
                                    <div class="btn-group" role="group">
                                      <button type="button" class="btn btn-success"><p>Eliminar</p></button>
                                    </div>
                                  </div>
                                  <?php //for($i = 0;$i<$totalrecursos; $i++):?>
                                    <div class="checkbox">
                                    <label>
                                       &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
                                      <input class="checkItem" type="checkbox" name="eliminar" value="4">
                                     <div style="padding:1.2em">
                                       &nbsp;
                                     </div>
                                    </label>
                                  </div>
                                 <?php //endfor;?>
                                </div>
                                 <!-- /col-md-2-->

                                 <div class="col-md-2">
                                   <div class="btn-group btn-group-justified" role="group" aria-label="...">
                                     <div class="btn-group" role="group">
                                       <button type="button" class="btn btn-success"><p>Reporte</p></button>
                                     </div>
                                   </div>
                                   <?php //for($i = 0;$i<$totalrecursos; $i++):?>
                                     <div class="checkbox">
                                     <label>
                                        &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
                                       <input class="checkItem" type="checkbox" name="reporte" value="5">
                                      <div style="padding:1.2em">
                                        &nbsp;
                                      </div>
                                     </label>
                                   </div>
                                  <?php //endfor;?>
                                 </div>
                                  <!-- /col-md-2-->
                                  <div class="col-md-3 col-lg-4 col-xs-12">
                                  <button type="submit" class="btn btn-block btn-success btn-lg">Guardar</button>
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
