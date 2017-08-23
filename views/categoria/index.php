<!-- page content -->
        <div class="right_col" role="main" id="right_col">

            <div class="clearfix"></div>

                    <div class="row">
                      <section class="content-header">
                        <h2>
                          Listado de Categorias

                        </h2>

                      </section>


                        <!-- x_panel-->
                      <div class="x_panel">
                          <!-- x_content-->
                          <div class="x_content">
                        <?php $breadcrumb = explode("/",$_SERVER["REQUEST_URI"]);?>
                            <?php $error = array_pop($breadcrumb); ?>
                            <?php echo Core::error_get($error); ?>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                     <a href="#" class="btn btn-success float-md-right" data-toggle="modal" data-target="#add-categoria">Nueva Categoria</a>
                             </div>
                             <?php if(isset($this->categorias) && !empty($this->categorias) && count($this->categorias)>0):?>
                              <table id="table" class="table table-striped table-hover" >
                              <!--<table id="tableUsers" class="table table-striped">-->
                                <thead>
                                <tr>
                                <th> <span id="delete-multiple" class="fa fa-trash-o fa-fw f-3x"></span></th>
                                <th>Id</th>
                                <th>Perfil</th>
                                <th>Estado</th>
                                <th>Fecha creado</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                                </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  foreach($this->categorias as  $valor):
                                  ?>
                                        <tr>
                                             <td><input id="<?php echo $valor['id_categoria']?>" class="checked" type="checkbox"  value="<?php echo $valor['id_categoria']?>"></td>
                                             <td><?php echo $valor['id_categoria']?></td>
                                             <td><?php echo $valor['nombre']?></td>
                                             <td>       <?php if($valor['estado'] == 1):?>
                                                        <span class="label label-warning">ACTIVA</span>
                                                        <?php else: ?>
                                                        <span class="label label-danger">INACTIVA</span>
                                                        <?php endif; ?>
                                             </td>
                                             <td><?php echo $valor['dia'].'/'.$valor['mes'].'/'.$valor['anio']?></td>
                                    <td class="editar" data-edit="<?php echo $valor['id_categoria']?>">
                                        <a href="<?php echo BASE_URL;?>categoria/categoria/<?php echo $valor['id_categoria'] ?>" class="btn btn-succes">
                                          <span class="glyphicon glyphicon-pencil"></span>
                                        </a>
                                    </td>

                                    <td class="eliminar" data-eliminar="<?php echo $valor['id_categoria']?>">
                                            <button class="btn btn-danger delete" data-href="<?php echo BASE_URL;?>categoria/delete/<?php echo $valor['id_categoria'] ?>" data-toggle="modal" data-target="#confirm-delete">
                                                    <span class="fa fa-trash-o fa-fw fa-1x"></span>
                                            </button>
                              </td>

                                    <!--<td class="reporte" data-print="<?php //echo $valor['id']?>">
                                      <a href="<?php //echo BASE_URL;?>user/report/<?php //echo $valor['id'] ?>" class="btn btn-danger">
                                        <span class="glyphicon glyphicon-print"></span>
                                      </a>

                              </td>-->

                                        </tr>
                                        <?php
                                        endforeach;
                                        ?>
                                </tbody>
                                <tfoot>
                                <th> <span id="delete-multiple" class="fa fa-trash-o fa-fw f-3x"></span></th>
                                  <th>Id</th>
                                  <th>Perfil</th>
                                  <th>Estado</th>
                                  <th>Fecha creado</th>
                                  <th>Editar</th>
                                  <th>Eliminar</th>
                                </tfoot>
                              </table>
                            <?php else:?>
                                    <div class="jumbotron">
                                            <h2>No se encontraron Categorias</h2>
                                    </div>
                            <?php endif;?>
                            </div>

                            <!--/tablero de acciones-->
                          </div>
                            <!-- /x_content-->

                        </div>
                        <!-- /x_panel-->

                    </div>
                    <!--/row-->

        </div>
        <!-- /page content -->

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Eliminar</h3>
            </div>
            <div class="modal-body">
                Esta seguro que decea realizar esta acción?.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <a href="#" class="btn btn-danger btn-ok" id="eliminar-registro" data-dismiss="modal">Eliminar</a>
            </div>
        </div>
    </div>
</div>

<div class='modal fade' id='add-categoria' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
<div class='modal-dialog'>
 <div class='modal-content'>
   <div class='modal-header'>
 <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
 <h4 class='modal-title text-center'>Nueva Categoria</h4>
   </div>
   <div class='modal-body'>
  <form id='FormAddCategoria' method='post' class='form-horizontal'  action="<?php echo BASE_URL;?>categoria/add" method="post">
          <input type="hidden" value="1" name="add" />
          <div class="form-group label-floating">
          <label for="nombre">Nombre:</label>
               <input type="text" class="form-control" placeholder="Nombre de la Categoria"  maxlength="30" name="nombre" id="nombre" autofocus="" required="required">

       </div>

       <div class="form-group label-floating">
               <label for="estado">Estado:</label>
               <select class="form-control" name="estado" id="estado">
                       <option value="" >SELECCIONE UN ESTADO</option>
                       <option value="1" >ACTIVA</option>
                       <option value="0" >INACTIVA</option>
               </select>
       </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success" >Agregar</button>
            </div>
      </form>
    </div>
  </div>
</div>
</div>
