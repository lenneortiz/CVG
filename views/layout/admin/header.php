<?php ob_start();//da comienzo al buffer ?>
<?php if (isset($_SESSION['usuario']) AND !empty($_SESSION['usuario']) ):?>
<?php else:Core::header(BASE_URL.'index');?>
<?php endif; ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php if($this->titulo ) echo $this->titulo;?></title>
<?php $fileCss = array('bootstrap.min');?>
<?php $font = array('font-awesome.min');?>
<?php $nprogress = array('nprogress');?>
<?php $dataTablesbootstrapmin = array('dataTables.bootstrap.min');?>
<?php $bootstrapValidator = array('bootstrapValidator');?>
<?php $bootstrapfile_imput_css = array('fileinput');?>
<?php $colorPicker_css = array('color-picker.min');?>
<?php $customcss = array('custom');?>
<?php $jquery_ui_css = array('jquery-ui-1.10.0.custom',);?>

<?php Core::loadCSS(VIEW_LAYOUT.'admin/css/',$fileCss); ?>
<?php Core::loadCSS(VIEW_LAYOUT.'admin/fonts/css/',$font); ?>
<?php Core::loadCSS(VIEW_LAYOUT.'admin/assets/nprogress/',$nprogress); ?>
<?php Core::loadCSS(VIEW_LAYOUT.'admin/assets/datatables.net-bs/css/',$dataTablesbootstrapmin); ?>
<?php Core::loadCSS(VIEW_LAYOUT.'admin/assets/jquery-ui-bootstrap/css/custom-theme/',$jquery_ui_css); ?>
<?php Core::loadCSS(VIEW_LAYOUT.'admin/css/',$bootstrapValidator); ?>
<?php Core::loadCSS(VIEW_LAYOUT.'admin/assets/bootstrap-file-input/css/',$bootstrapfile_imput_css); ?>
<?php Core::loadCSS(VIEW_LAYOUT.'admin/assets/colorpicker/css/',$colorPicker_css); ?>
<?php Core::loadCSS(VIEW_LAYOUT.'admin/assets/build/css/',$customcss); ?>

<!--[if lt IE 9]>
<script src="../assets/js/ie8-responsive-file-warning.js"></script>
<![endif]-->

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body class="nav-md">
  <div class="base_url" data-href="<?php echo BASE_URL;?>"></div>

  <!-- container body-->
  <div class="container body">
      <!-- main_container-->
      <div class="main_container">

        <!-- area del sidebar-->
        <div class="col-md-3 left_col">

          <!-- scroll-view-->
          <div class="left_col scroll-view" >

            <!-- nav_title-->
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo BASE_URL ?>admin" class="site_title"><i class="fa fa-paw"></i> <span>CVG</span></a>
          </div>
          <!-- /nav_title-->

          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic">
              <img src="<?php echo BASE_URL?>upload/<?php echo $_SESSION['foto'] ?>" alt="..." class="img-circle img-thumbnail" style="max-height:80px">
            </div>
            <!--<div class="profile_info">
              <span>Bienvenido: <?php //echo $_SESSION['usuario']; ?></span>
              <h2>Perfil: <p><?php  /*if (isset($_SESSION['perfil'])):
                                          echo $_SESSION['perfil'];
                                        else:
                                          echo "Usuario sin perfil";
                                        endif;*/?></p></h2>
            </div>-->
            <div class="clearfix"></div>
          </div>
          <!-- /menu profile quick info -->


            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

              <div class="menu_section">
                <h3><?php //echo $_SESSION['level']; ?></h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-group"></i> Usuarios <span class="fa fa-chevron-down"></span></a>
                    <?php $modulo = 'user'; ?>
                    <?php if($modulo == 'user'): ?>
                      <ul class="nav child_menu">
                          <li><a href="<?php echo BASE_URL ?>user"><i class="glyphicon glyphicon-list"></i> Listar Usuarios</a></li>
                          <li><a href="<?php echo BASE_URL ?>user/add"><i class="glyphicon glyphicon-list"></i> Agreagar Usuario</a></li>
                          <li><a href="<?php echo BASE_URL ?>perfil"><i class="glyphicon glyphicon-floppy-open"></i> Listar Perfiles </a></li>
                          <li><a href="<?php echo BASE_URL ?>permiso"><i class="glyphicon glyphicon-floppy-open"></i>Asignar Permisos </a></li>
                          <li><a href="<?php echo BASE_URL ?>permiso/edit"><i class="glyphicon glyphicon-floppy-open"></i>Editar Permisos </a></li>
                    </ul>
                    <?php else: ?>

                    <?php endif; ?>
                  </li>
                  <li><a><i class="fa fa-group"></i> Funcionarios <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo BASE_URL ?>funcionario"><i class="glyphicon glyphicon-list"></i> Listar Funcionarios</a></li>
                      <li><a href="<?php echo BASE_URL ?>funcionario/add"><i class="glyphicon glyphicon-floppy-open"></i> Registrar Funcionario</a></li>


                    </ul>
                    <li><a><i class="fa fa-group"></i> Movimientos <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="<?php echo BASE_URL ?>proveedor/add"><i class="glyphicon glyphicon-floppy-open"></i>Agregar Movimieto</a></li>
                        <li><a href="<?php echo BASE_URL ?>proveedor"><i class="glyphicon glyphicon-list"></i> Control Movimientos</a></li>

                      </ul>
                      <li><a><i class="fa fa-group"></i> Control de Bienes <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="<?php echo BASE_URL ?>bienes"><i class="glyphicon glyphicon-list"></i> Listar Bienes</a></li>
                          <li><a href="<?php echo BASE_URL ?>bienes/add"><i class="glyphicon glyphicon-floppy-open"></i> Registrar Bien</a></li>
                          <li><a href="<?php echo BASE_URL ?>unidades"><i class="glyphicon glyphicon-list"></i> Listar Unidades Adscriptas</a></li>
                          <li><a href="<?php echo BASE_URL ?>categoria"><i class="glyphicon glyphicon-list"></i> Listar Categorias</a></li>
                        </ul>




                </ul>
              </div>
<!--seleccione un color:<input type="color" id="color" value="#F7F7F7" >-->
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="cerrar sesion" href="<?php echo BASE_URL; ?>login/close">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->

          </div>
          <!-- /scroll-view-->



        </div>
        <!-- /area del sidebar-->


        <!-- top navigation -->
        <div class="top_nav">
        <!-- nav_menu -->
        <div class="nav_menu">

        <nav>
          <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
          </div>

          <!-- //////////////////////////contenido del menu top-->
          <ul class="nav navbar-nav navbar-right">
            <li class="">
              <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <img src="<?php echo BASE_URL?>upload/<?php echo $_SESSION['foto'] ?>" alt="">Usuario : <?php echo $_SESSION['usuario']; ?>
                <span class=" fa fa-angle-down"></span>
              </a>
              <ul class="dropdown-menu dropdown-usermenu pull-right">
                <li>
                  <a href="javascript:;"> Perfil:
                      <?php  if (isset($_SESSION['perfil'])):
                              echo $_SESSION['perfil'];
                              else:
                              echo "Usuario sin perfil";
                            endif;?>
                    </a>
                </li>
                <li>
                  <a href="javascript:;">
                    <span class="pull-right"><?php echo  $_SESSION['dia'].'/'.$_SESSION['mes'].'/'.$_SESSION['anio'] ?></span>
                    <span>Registrado el:</span>
                  </a>
                </li>
                <li><a href="javascript:;">Ayuda</a></li>
                <li><a href="<?php echo BASE_URL; ?>login/close"><i class="fa fa-sign-out pull-right"></i> Cerrar Sesion</a></li>
              </ul>
            </li>



          <!-- //////////////////////////////// fin del contenido menu top-->
        </nav>

        </div>
        <!-- /nav_menu -->
        </div>
        <!-- /top navigation -->
