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
                          <h2>Nuevo Bien</h2>
                  </section>


                  <!-- x_panel-->
                  <div class="x_panel">
                          <!-- x_content-->
                          <div class="x_content">
                            <?php $error = array_pop($breadcrumb); ?>
                            <?php echo Core::error_get($error); ?>

                                               <div class="title_left">
  <?php //print_r($this->categorias); ?>
                                               </div>


                               <form id="FormAddProducto" name="FormAddProducto" autocomplete="on" action="<?php echo BASE_URL;?>bienes/add" method="post" enctype="multipart/form-data">
                                 <div class="col-md-7">
                                   <div class="row">
                                     <fieldset class="scheduler-border">
                                       <div class="clearfix"></div><br>
                                       <input type="hidden" value="1" name="add" />
                                       <input type="hidden" value="articulo-sin-foto.jpg" name="foto-producto-avatar" />

                                       <div class="form-group label-floating">
                                            <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
                                                 <label for="codigo_barra">Codigo del bien:</label>
                                            </div>

                                            <div class="col-md-6 col-lg-10 col-ms-10 col-xs-10">
                                                 <input type="text" autocomplete="off" class="form-control" placeholder="Código Serial"  maxlength="10" name="codigo_barra" id="codigo_barra" autofocus="" required="required" >

                                            </div>

                                       </div>
                                       <div class="clearfix"></div><br>

                                       <div class="form-group label-floating">
                                            <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
                                                 <label for="nombre">Nombre:</label>
                                            </div>
                                            <div class="col-md-10 col-lg-10 col-ms-10 col-xs-10">
                                                 <input type="text" class="form-control" placeholder="Nombre del Bien"  maxlength="50" name="nombre" id="nombre" autofocus="" required="required">
                                            </div>
                                       </div>
                                       <div class="clearfix"></div><br>

                                       <div class="form-group label-floating">
                                            <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
                                                 <label for="descrip_producto">Descrip.:</label>
                                            </div>
                                            <div class="col-md-10 col-lg-10 col-ms-10 col-xs-10">
                                              <textarea  required="required"  class="form-control" name="descrip_producto"  id="descrip_producto" minlength="20" maxlength="200"></textarea>
                                            </div>

                                       </div>

                                       <div class="clearfix"></div><br>

                                       <div class="form-group label-floating">

                                            <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
                                                 <label for="stock">Bien.Cant:</label>
                                            </div>
                                            <div class="col-md-3 col-lg-10 col-ms-10 col-xs-10">
                                                 <input class="form-control" name="stock" id="stock" type="text" maxlength="5">
                                                 <!--<p class="help-block">Escribe tú E-mail</p>-->
                                            </div>
                                       </div>
                                       <div class="clearfix"></div><br>

                                       <div class="form-group label-floating">

                                            <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
                                                 <label for="estado">Estado:</label>
                                            </div>
                                            <div class="col-md-10 col-lg-10 col-ms-10 col-xs-10">
                                                 <select class="form-control" name="estado">
                                                      <option value="">Seleccione un estado</option>
                                                      <option value="1">OPERATIVO</option>
                                                      <option  value="0">INOPERATIVO</option>
                                                      <option  value="2">REGULAR</option>
                                                 </select>
                                            </div>
                                       </div>

                                       <div class="clearfix"></div><br>

                                       <div class="form-group label-floating">

                                            <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
                                                 <label for="id_categoria">Categoria:</label>
                                            </div>
                                            <div class="col-md-10 col-lg-10 col-ms-10 col-xs-10">
                                               <select class="form-control" name="id_categoria" id="id_categoria">

                                                 <?php foreach($this->categorias as $categoria): ?>
                                                   <option value="<?php echo $categoria['id_categoria']; ?>"><?php echo $categoria['nombre'] ?></option>
                                                 <?php endforeach; ?>
                                               </select>
                                            </div>
                                       </div>


                                       <div class="clearfix"></div><br>


                                       <div class="form-group label-floating">

                                            <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
                                                 <label for="id_marca">Unidad.<br>Adscripta:</label>
                                            </div>
                                            <div class="col-md-10 col-lg-10 col-ms-10 col-xs-10">
                                               <select class="form-control" name="id_unidad_adscripta" id="id_narca">
                                                 <?php foreach($this->unidades as $unidad): ?>
                                                   <option value="<?php echo $unidad['id_unidad_adscripta']; ?>"><?php echo $unidad['nombre'] ?></option>
                                                 <?php endforeach; ?>
                                               </select>


                                            </div>

                                       </div>

                                       <div class="clearfix"></div><br>

                                       <div class="form-group label-floating">

                                            <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
                                                 <label for="id_categoria">Funcionario<br>Respons:</label>
                                            </div>
                                            <div class="col-md-10 col-lg-10 col-ms-10 col-xs-10">
                                               <select class="form-control" name="id_funcionario" id="id_funcionario">

                                                 <?php foreach($this->funcionarios as $funcionario): ?>
                                                   <option value="<?php echo $funcionario['id_funcionario']; ?>"><?php echo $funcionario['nombre1']  ?> &nbsp;<?php echo $funcionario['apellido1']  ?></option>
                                                 <?php endforeach; ?>
                                               </select>
                                            </div>
                                       </div>


                                       <div class="clearfix"></div><br>

                                       <div class="form-group label-floating">
                                            <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
                                                 <label for="observacion" style="margin-left:-10px">Observación:</label>
                                            </div>
                                            <div class="col-md-10 col-lg-10 col-ms-10 col-xs-10">
                                              <textarea  required="required"  class="form-control" name="observacion"  id="observacion" minlength="10" maxlength="50"></textarea>
                                            </div>

                                       </div>

                                     </fieldset>
                                     </div>
                                     <!-- /row-->
                                   </div>
                                   <!-- /col-md-7-->

                                   <div class="col-md-5 col-lg-5 col-xs-12  col-sm-4" id="cont-input-foto">
                                      <div class="form-group label-floating">
                                     <div class="kv-avatar center-block">

                                         <img src="<?php echo BASE_URL ?>upload/producto.png" id="foto-user" style="width:100%;height:265px"/>

                                         <div class="clearfix"></div><br>

                                         <input id="foto" name="foto" type="file" data-show-upload="false" width="80%" class=" btn-success">

                                     </div>



                                      </div>

                                   </div>


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
