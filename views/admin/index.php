<!-- page content -->
        <div class="right_col" role="main" id="right_col">

            <div class="clearfix"></div>

                    <div class="row">
                      <section class="content-header" id="pp">
                        <h1>
                          Acceso Frecuentes

                        </h1>

                      </section>


                        <!-- x_panel-->
                        <div class="x_panel">
                          <!-- x_content-->
                          <div class="x_content">

                            <!-- tablero de acciones-->

                            <div class="col-md-6 col-sm-12 col-xs-12">

                              <!-- small box -->
                              <div class="small-box bg-aqua">
                                  <div class="inner">
                                      <h3>Funcionarios</h3>
                                      <p>Area de administración de Funcionarios</p>
                                  </div>
                                <div class="icon">
                                  <i class="fa fa-users" aria-hidden="true"></i>
                                </div>
                                <a href="<?php echo BASE_URL ?>funcionario" class="small-box-footer">
                                    MAS INFORMACION <i class="fa fa-arrow-circle-right"></i>
                                </a>
                              </div>
                                <!-- /small box -->
                            </div>



                            <div class="col-md-6 col-sm-12 col-xs-12">

                              <!-- small box -->
                              <div class="small-box bg-green">
                                  <div class="inner">
                                      <h3>Bienes<sup style="font-size: 20px"></sup></h3>
                                      <p>Area de administración de Bienes</p>
                                  </div>
                                  <div class="icon">
                                   <i class="fa fa-reorder" aria-hidden="true"></i>
                                  </div>
                                  <a href="<?php echo BASE_URL ?>bienes" class="small-box-footer">
                                      MAS INFORMACION <i class="fa fa-arrow-circle-right"></i>
                                  </a>
                              </div>
                                <!-- /small box -->
                            </div>

                            <div class="col-md-6 col-sm-12 col-xs-12">

                              <!-- small box -->
                              <div class="small-box bg-yellow">

                                  <div class="inner">
                                      <h3>Respaldo</h3>
                                      <p>Control Diario.</p>
                                  </div>
                                  <div class="icon">
                                      <i class="fa fa-database" aria-hidden="true"></i>
                                  </div>
                                  <a href="#" class="small-box-footer">
                                      MAS INFORMACION <i class="fa fa-arrow-circle-right"></i>
                                  </a>
                              </div>
                                <!-- /small box -->
                            </div>

                            <div class="col-md-6 col-sm-12 col-xs-12">

                              <!-- small box -->
                              <div class="small-box bg-blue">
                                  <div class="inner">
                                      <h3>Usuarios</h3>
                                      <p>Area de administración de usuarios.</p>
                                  </div>
                                  <div class="icon">
                                          <i class="fa fa-male" aria-hidden="true"></i>
                                  </div>
                                  <a href="<?php echo BASE_URL ?>user" class="small-box-footer">
                                      MAS INFORMACION <i class=""></i>
                                  </a>
                              </div>
                                <!-- /small box -->
                            </div>

                            <div class="col-md-6 col-sm-12 col-xs-12">

                              <!-- small box -->
                              <div class="small-box bg-carrot">
                                  <div class="inner">
                                      <h3>Movimientos</h3>
                                      <p>Area de administración de los Movimientos.</p>
                                  </div>
                                  <div class="icon">
                                      <i class="fa fa-users" aria-hidden="true"></i>
                                  </div>
                                  <a href="<?php echo BASE_URL ?>user" class="small-box-footer">
                                      MAS INFORMACION <i class=""></i>
                                  </a>
                              </div>
                                <!-- /small box -->
                            </div>



                            <div class="col-md-6 col-sm-12 col-xs-12">

                              <!-- small box -->
                              <div class="small-box bg-concrete">
                                  <div class="inner">
                                      <h3>Configuración</h3>
                                      <p>Area de configuaraciones del sistema.</p>
                                  </div>
                                  <div class="icon">
                                    <i class="fa fa-cog fa-spin fa-1x fa-fw"></i>
                                    <span class="sr-only">Loading...</span>
                                  </div>
                                  <a href="<?php echo BASE_URL ?>user" class="small-box-footer">
                                      MAS INFORMACION <i class=""></i>
                                  </a>
                              </div>
                                <!-- /small box -->
                            </div>

                            <div class="col-md-6 col-sm-12 col-xs-12">

                              <!-- small box -->
                              <div class="small-box bg-turquesa">
                                  <div class="inner">
                                      <h3>Reportes</h3>
                                      <p>Graficos estadisticos de las ventas y compras.</p>
                                  </div>
                                  <div class="icon">
                                    <i class="fa fa-bar-chart "></i>

                                  </div>
                                  <a href="<?php echo BASE_URL ?>user" class="small-box-footer">
                                      MAS INFORMACION <i class=""></i>
                                  </a>
                              </div>
                                <!-- /small box -->
                            </div>

<div id="grafica" data-href="<?php echo BASE_URL;?>estadisticas/estadisticaBienes/"></div>

<div class="clearfix"><br></div>

                            <div class="col-md-12 col-sm-12 col-xs-12">

                              <div class="title_left">
                                <h3>Listado de ultimos Funcionarios Activos</h3>
                              </div>
                              <?php if(isset($this->funcionario) && !empty($this->funcionario) && count($this->funcionario)>0):?>
                              <table class="table table-striped table-hover" >
                              <!--<table id="tableUsers" class="table table-striped">-->
                              <thead>
                              <tr>
                              <th>Id</th>
                              <th>Nombre</th>
                              <th>Apellido</th>
                                <th>Fecha.Registrado</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php
                              foreach($this->funcionario as  $valor):
                              ?>
                              <tr>
                              <td><?php echo $valor['id_funcionario']?></td>
                              <td><?php echo $valor['nombre1']?></td>
                              <td><?php echo $valor['apellido1']?></td>
                              <td><?php echo $valor['dia'].' / '.$valor['mes'].' / '.$valor['anio']?></td>
                               </tr>
                              <?php
                              endforeach;
                              ?>
                              </tbody>
                              <tfoot>
                              <th>Id</th>
                              <th>Nombre</th>
                              <th>Apellido</th>
                              <th>Fecha.Registrado</th>
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
