<!-- page content -->
        <div class="right_col" role="main" id="right_col">

            <div class="clearfix"></div>

                    <div class="row">
                      <section class="content-header">
                        <h2>
                          Listado de Perfiles

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
                                     <a href="#" class="btn btn-success float-md-right" data-toggle="modal" data-target="#add-perfil">  Nuevo perfil</a>
                             </div>

                              <table id="table" class="table table-striped table-hover" >
                              <!--<table id="tableUsers" class="table table-striped">-->
                                <thead>
                                <tr>
                                <th> <span id="delete-multiple" class="fa fa-trash-o fa-fw f-3x"></span></th>
                                <th>Id</th>
                                <th>Perfil</th>
                                <th>Fecha creado</th>
                                <th>Fecha Modificado</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                                </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  foreach($this->perfiles as  $valor):
                                  ?>
                                        <tr>
                                             <td><input id="<?php echo $valor['idperfil']?>" class="checked" type="checkbox"  value="<?php echo $valor['idperfil']?>"></td>
                                             <td><?php echo $valor['idperfil']?></td>
                                             <td><?php echo $valor['nombre']?></td>
                                             <td><?php echo $valor['created']?></td>
                                             <td><?php echo $valor['modified']?></td>
                                    <td class="editar" data-edit="<?php echo $valor['idperfil']?>">
                                        <a href="<?php echo BASE_URL;?>perfil/perfil/<?php echo $valor['idperfil'] ?>" class="btn btn-succes">
                                          <span class="glyphicon glyphicon-pencil"></span>
                                        </a>
                                    </td>

                                    <td class="eliminar" data-eliminar="<?php echo $valor['idperfil']?>">
                                            <button class="btn btn-danger delete" data-href="<?php echo BASE_URL;?>perfil/delete/<?php echo $valor['idperfil'] ?>" data-toggle="modal" data-target="#confirm-delete">
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
                                  <th>Fecha creado</th>
                                  <th>Fecha Modificado</th>
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

<div class='modal fade' id='add-perfil' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
<div class='modal-dialog'>
 <div class='modal-content'>
   <div class='modal-header'>
 <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
 <h4 class='modal-title text-center'>Nuevo Perfil</h4>
   </div>
   <div class='modal-body'>
  <form id='FormAddPerfil' method='post' class='form-horizontal'  action="<?php echo BASE_URL;?>perfil/add" method="post">
          <div class="form-group label-floating">

               <input type="text" class="form-control" placeholder="Nombre"  maxlength="13" name="nombre" id="nombre" autofocus="" required="required">

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
