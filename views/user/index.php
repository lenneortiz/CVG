<!-- page content -->
        <div class="right_col" role="main" id="right_col">

            <div class="clearfix"></div>

                    <div class="row">
                      <section class="content-header">
                        <h2>
                          Listado de Usuarios

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

                                  <button class="btn btn-success" type="button" id="export-exel-checkbox" data-href="<?php echo BASE_URL;?>reportes/user_excel/" title="Seleccione registros para exportar">
                                        <i class="fa fa-file-excel-o fa-2x" ></i>
                                  </button>
                                  <button class="btn btn-danger" id="expt-pdf-checkbox" type="button" data-href="<?php echo BASE_URL;?>reportes/user_pdf/" title="Seleccione registros para exportar">
                                        <i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i>
                                  </button>
                                  <label class="btn btn-danger"><input type="checkbox" id="checkAll"/> Marcar Todo</label>
                                  <a href="<?php echo BASE_URL;?>user/add" class="btn btn-primary float-md-right">  Nuevo usuario</a>
                                  <div class="btn-group">
                                        <button type="button" class="btn btn-danger">Exportar toda la data</button>
                                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              <span class="caret"></span>
                                              <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu">
                                              <li><a href="javascript:void(0);" id="export-pdf-all" data-href="<?php echo BASE_URL;?>reportes/user_pdf_all/">PDF</a></li>
                                              <li><a href="javascript:void(0);" id="export-excel-all" data-href="<?php echo BASE_URL;?>reportes/user_excel_all/">EXCEL</a></li>

                                        </ul>
                                  </div>



                            </div>

                              <table id="table" class="table table-striped table-hover" >
                              <!--<table id="tableUsers" class="table table-striped">-->
                                <thead>
                                <tr>
                                <th> <span id="delete-multiple" class="fa fa-trash-o fa-fw f-3x"></span></th>
                                  <th>Id</th>
                                  <th>Foto</th>
                                  <th>Nombre</th>
                                  <th>Usuario</th>
                                  <th>Correo</th>
                                  <th>Estado</th>
                                  <th>Editar</th>
                                  <th>Eliminar</th>
                                </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  foreach($this->user as  $valor):
                                  ?>
                                        <tr>
                                             <td><input id="<?php echo $valor['iduser']?>" class="checkItem" type="checkbox"  value="<?php echo $valor['iduser']?>"></td>
                                             <td><?php echo $valor['iduser']?></td>
                                             <td> <img src="<?php echo BASE_URL ?>upload/<?php echo $valor['foto']?>" alt="" width="70px" height="40px"> </td>
                                             <td><?php echo $valor['nombre']?></td>
                                             <td><?php echo $valor['usuario']?></td>
                                             <td><?php echo $valor['correo']?></td>
                                             <?php if ($valor['estado'] == 1): ?>
                                               <td><span class="label label-warning">ACTIVO</span></td>
                                             <?php else:?>
                                               <td><span class="label label-danger">INACTIVO</span></td>
                                             <?php endif; ?>
                                    <td class="editar" data-edit="<?php echo $valor['iduser']?>">
                                        <a href="<?php echo BASE_URL;?>user/usuario/<?php echo $valor['iduser'] ?>" class="btn btn-succes">
                                          <span class="glyphicon glyphicon-pencil"></span>
                                        </a>
                                    </td>

                                    <td class="eliminar" data-eliminar="<?php echo $valor['iduser']?>">
                                            <button class="btn btn-danger delete" data-href="<?php echo BASE_URL;?>user/delete/<?php echo $valor['iduser'] ?>" data-toggle="modal" data-target="#confirm-delete">
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
                                  <th>Foto</th>
                                  <th>Nombre</th>
                                  <th>Apellido</th>
                                  <th>Correo</th>
                                  <th>Estado</th>
                                  <th>Editar</th>
                                  <th>Eliminar</th>
                                </tfoot>
                              </table>

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
        <div id="modal-dialog-invalid"></div>

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
