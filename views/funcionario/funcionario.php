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
  <li><a href="<?php echo BASE_URL.HOME; ?>">Home</a></li>
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
                          <a class="btn btn-danger pull-right" id="expt-pdf-checkbox"  href="<?php echo BASE_URL;?>reportes/funcionario_pdf/<?php echo $this->funcionario[0]['id_funcionario'] ?>"  title="Imprimir el reporte en pdf">
                            <i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i>
                          </a>
                          <?php $error = array_pop($breadcrumb); ?>
                          <?php echo Core::error_get($error); ?>
                           <?php if(isset($this->funcionario) && !empty($this->funcionario) && count($this->funcionario)>0):?>
                                             <div class="title_left">

                                             </div>

                             <form id="FormAddFuncionario" name="FormAddFuncionario" autocomplete="on" action="<?php echo BASE_URL;?>funcionario/edit" method="post" enctype="multipart/form-data">
                               <input type="hidden" value="1" name="edit" />
                               <input type="hidden"  name="id" id="id" value="<?php echo $this->funcionario[0]['id_funcionario']?>" >
                               <input type="hidden"  name="foto-user" id="foto-user" value="<?php echo $this->funcionario[0]['foto']?>" >
                               <!-- container-fluid-->
                                 <div class="container-fluid">
                                   <!-- row-->
                                   <div class="row">
                                     <div class="col-md-5 col-sm-12 col-xs-12">
                                         <div class="form-group label-floating">
                                           <div class="kv-avatar center-block">
                                             <img src="<?php echo BASE_URL ?>upload/<?php echo $this->funcionario[0]['foto']?>" id="foto-user" style="width:100%;height:260px;margin-top:30px"/>
                                             <div class="clearfix"></div><br>
                                             <input id="foto" name="foto" type="file" data-show-upload="false" width="80%" class=" btn-success">
                                           </div>
                                         </div>
                                     </div>

                                     <div class="col-md-7 col-sm-12 col-xs-12">
                                       <div class="row"><!--row-->
                                         <div class="col-md-6 col-sm-12 col-xs-12">
                                           <div class="form-group">
                                                 <label for="cedula">Cédula</label>
                                                 <input name="cedula" id="cedula" class="form-control" maxlength="8" minlength="8" value="<?php echo $this->funcionario[0]['cedula']?>">
                                                 <p class="help-block"></p>
                                             </div>
                                         </div>

                                         <div class="col-md-6 col-sm-12 col-xs-12">
                                           <div class="form-group">
                                                 <label for="nombre1">1.er.Nombre</label>
                                                 <input name="nombre1" id="nombre1" class="form-control" placeholder="Primer nombre"  maxlength="12" minlength="3" required="required" value="<?php echo $this->funcionario[0]['nombre1']?>">
                                                 <p class="help-block"></p>
                                           </div>
                                         </div>

                                         <div class="col-md-6 col-sm-12 col-xs-12">
                                           <div class="form-group">
                                                 <label for="nombre2">2.do.Nombre</label>
                                                 <input name="nombre2" id="nombre2" class="form-control" placeholder="Segundo nombre"  maxlength="12" minlength="3" value="<?php echo $this->funcionario[0]['nombre2']?>">
                                                 <p class="help-block"></p>
                                           </div>
                                         </div>

                                         <div class="col-md-6 col-sm-12 col-xs-12">
                                           <div class="form-group">
                                                 <label for="apellido1">1.er.Apellido</label>
                                                 <input name="apellido1" id="apellido1" class="form-control" placeholder="Primer Apellido"  maxlength="12" minlength="3" required="required" value="<?php echo $this->funcionario[0]['apellido1']?>">
                                                 <p class="help-block"></p>
                                           </div>
                                         </div>

                                         <div class="col-md-6 col-sm-12 col-xs-12">
                                           <div class="form-group">
                                                 <label for="apellido2">2.do.Apellido</label>
                                                 <input name="apellido2" id="apellido2" class="form-control" placeholder="Segundo Apellido"  maxlength="12" minlength="3" value="<?php echo $this->funcionario[0]['apellido2']?>">
                                                 <p class="help-block"></p>
                                           </div>
                                         </div>

                                         <div class="col-md-6 col-sm-12 col-xs-12">
                                           <div class="form-group">
                                                 <label for="fecha_nac">Fecha Nacacimiento</label>
                                                 <input name="fecha_nac" id="fecha_nac" class="form-control" placeholder="12/30/2014"  maxlength="10" minlength="10" required="required" value="<?php echo $this->funcionario[0]['fec_nac']?>">
                                                 <p class="help-block"></p>
                                           </div>
                                         </div>

                                         <div class="col-md-6 col-sm-12 col-xs-12">
                                           <div class="form-group">
                                                 <label for="fecha_ing">Fecha Ingreso</label>
                                                 <input name="fecha_ing" id="fecha_ing" class="form-control" placeholder="12/30/2014"  maxlength="10" minlength="10" required="required" value="<?php echo $this->funcionario[0]['fec_ingreso']?>">
                                                 <p class="help-block"></p>
                                           </div>
                                         </div>

                                         <div class="col-md-6 col-sm-12 col-xs-12">
                                           <div class="form-group">
                                                 <label for="estado">Status</label>
                                                 <select class="form-control" name="estado">
                                                      <option value="">Seleccione un estatus</option>
                                                      <option value="1" <?php if($this->funcionario[0]['estado']=="1") echo "selected";?>>ACTIVO</option>
                                                      <option value="0" <?php if($this->funcionario[0]['estado']=="0") echo "selected";?>>INACTIVO</option>
                                                 </select>
                                                 <p class="help-block"></p>
                                           </div>
                                         </div>

                                   </div><!--/row-->
                                 </div><!--/container-fluid-->

                                 <div class="clearfix"></div><br>
                                 <!-- container-fluid-->
                                 <div class="container-fluid">
                                   <div class="row">
                                   <div class="col-md-5 col-sm-12 col-xs-12">
                                     <div class="form-group">
                                           <label for="grado_instruc">Grado Intrucciòn</label>
                                           <select class="form-control" name="grado_instruc">
                                             <option value="bachiller" <?php if($this->funcionario[0]['grado_intruccion']=="bachiller") echo "selected";?>>Bachiller</option>
                                             <option value="universitario" <?php if($this->funcionario[0]['grado_intruccion']=="universitario") echo "selected";?>>Universitario</option>
                                          </select>
                                           <p class="help-block"></p>
                                     </div>
                                   </div>
                                 <div class="col-md-7 col-sm-12 col-xs-12">

                                     <div class="form-group">
                                         <label for="profesion">Profesión</label>
                                         <textarea  required="required" placeholder="Describa la o las profesiones separadas por coma" class="form-control" name="profesion"  id="profesion" minlength="10" maxlength="200"><?php echo $this->funcionario[0]['profesion']?></textarea>
                                         <p class="help-block"></p>
                                     </div>

                                 </div>

                                 <div class="col-md-5 col-sm-12 col-xs-12">
                                   <div class="form-group">
                                         <label for="codigo_cargo">Código Cargo</label>
                                         <input name="codigo_cargo" id="codigo_cargo" class="form-control" placeholder="S1234567"  maxlength="10" minlength="4" readonly="reandonly" required="required" value="<?php echo $this->funcionario[0]['code_cargo']?>">
                                         <p class="help-block"></p>
                                   </div>
                                 </div>

                                 <div class="col-md-7 col-sm-12 col-xs-12">

                                     <div class="form-group">
                                         <label for="descrip_cargo">Descripción Cargo</label>
                                         <textarea  required="required" placeholder="Describe el cargo" class="form-control" name="descrip_cargo"  id="descrip_cargo" minlength="10" maxlength="200"><?php echo $this->funcionario[0]['descrip_cargo']?></textarea>
                                         <p class="help-block"></p>
                                     </div>

                                 </div>

                                 <div class="col-md-5 col-sm-12 col-xs-12">

                                     <div class="form-group">
                                         <label for="func_inhe_cargo">Funciones Inherentes al Cargo</label>
                                         <textarea  required="required" placeholder="Describe las Funciones Inherentes al Cargo" class="form-control" name="func_inhe_cargo"  id="func_inhe_cargo" minlength="10" maxlength="300"><?php echo $this->funcionario[0]['func_inhe_cargo']?></textarea>
                                         <p class="help-block"></p>
                                     </div>

                                 </div>

                                 <div class="col-md-7 col-sm-12 col-xs-12">

                                     <div class="form-group">
                                         <label for="odi">ODI</label>
                                         <textarea  required="required" placeholder="Describe Los Objetivos de Desempeño Individual" class="form-control" name="odi"  id="odi" minlength="10" maxlength="400"><?php echo $this->funcionario[0]['obj_desemp_individual']?></textarea>
                                         <p class="help-block"></p>
                                     </div>

                                 </div>

                                 <div class="col-md-5 col-sm-12 col-xs-12">

                                     <div class="form-group">
                                         <label for="observacion">Observaciones</label>
                                         <textarea  required="required" placeholder="Ingrese aqui las observaciones al funcionario" class="form-control" name="observacion"  id="observacion" minlength="10" maxlength="300"><?php echo $this->funcionario[0]['observacion']?></textarea>
                                         <p class="help-block"></p>
                                     </div>

                                 </div>
                                 <div class="col-md-7 col-sm-12 col-xs-12">
                                 <div class="form-group">
                                   <label for="id_marca">Unidad.<br>Adscripta:</label>
                                   <select class="form-control" name="id_unidad_adscripta" id="id_narca">
                                     <option value="0">Seleccione la Unidad adscripta </option>
                                           <?php foreach($this->unidades as $unidad): ?>
                                             <option value="<?php echo $unidad['id_unidad_adscripta']; ?>" <?php if($unidad['nombre']== $this->funcionario[0]['unidad']) echo "selected";?>><?php echo $unidad['nombre'] ?></option>
                                           <?php endforeach; ?>
                                   </select>
                                 </div>

                               </div>

                                 <div class="col-md-12 col-sm-12 col-xs-12">

                                     <div class="form-group">
                                         <label for="info_complentaria">Información Complementaria (Habilidades, Destrezas del Recurso)</label>
                                         <textarea  required="required" placeholder="Ingrese aqui la Información Complementaria" class="form-control" name="info_complentaria"  id="info_complentaria" minlength="10" maxlength="300"><?php echo $this->funcionario[0]['info_complentaria']?></textarea>
                                         <p class="help-block"></p>
                                     </div>

                                 </div>


                                 <div class="clearfix"></div><br>
                                 <div class="col-md-3 col-sm-3 col-lg-3 col-xs-12">
                                      <button type="submit" class="btn btn-block  btn-success btn-lg">Guardar</button>
                                 </div>

                               </div><!-- /row-->

                                 </div><!-- /container-fluid-->

                             </form>

                           <?php else:?>
                                   <div class="jumbotron">
                                           <h2>Usuario no encontrado</h2>
                                   </div>
                           <?php endif;?>

            </div>
                <!-- /x_content-->

        </div>
        <!-- /x_panel-->

</div>
<!--/row-->

</div>
<!-- /page content -->
