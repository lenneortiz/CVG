<?php if (isset($_SESSION['usuario']) AND !empty($_SESSION['usuario']) ):?>
<?php else:Core::header(BASE_URL.'index');?>
<?php endif; ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ADMIN| </title>
<?php $fileCss = array('bootstrap.min');?>
<?php $font = array('font-awesome.min',);?>
<?php $nprogress = array('nprogress',);?>
<?php $customcss = array('custom',);?>

<?php Core::loadCSS(VIEW_LAYOUT.'admin/css/',$fileCss); ?>
<?php Core::loadCSS(VIEW_LAYOUT.'admin/fonts/css/',$font); ?>
<?php Core::loadCSS(VIEW_LAYOUT.'admin/assets/nprogress/',$nprogress); ?>
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
              <a href="<?php echo BASE_URL ?>admin" class="site_title"><i class="fa fa-paw"></i> <span>ADMIN|SISTEM</span></a>
          </div>
          <!-- /nav_title-->

          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic">
              <img src="<?php echo VIEW_LAYOUT ?>admin/images/img.jpg" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Bienvenido,</span>
              <h2>Usuario : <?php echo $_SESSION['usuario']; ?></h2>
            </div>
            <div class="clearfix"></div>
          </div>
          <!-- /menu profile quick info -->


            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

              <div class="menu_section">
                <h3><?php echo $_SESSION['level']; ?></h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-group"></i> Usuarios <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="#"><i class="glyphicon glyphicon-floppy-open"></i> Registar Usario </a></li>
                        <li><a href="#"><i class="glyphicon glyphicon-list"></i> Lista Usuarios</a></li>

                    </ul>
                  </li>
                  <li><a><i class="fa fa-group"></i> Cliente <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="#"><i class="glyphicon glyphicon-floppy-open"></i> Registar Cliente</a></li>
                      <li><a href="#"><i class="glyphicon glyphicon-list"></i> Lista Cliente</a></li>

                    </ul>
                  </li>
                  <li><a><i class="fa fa-wrench"></i>Reparación de Equipos <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="#"> <i class="glyphicon glyphicon-floppy-open"></i> Reparación de Equipo</a></li>
                      <li><a href="#"><i class="glyphicon glyphicon-list"></i> Lista De Equipos en taller</a></li>
                      <li><a href="#"><i class="glyphicon glyphicon-usd"></i> Entrega o Devolucion</a></li>

                    </ul>
                  </li>

                  <li><a><i class="glyphicon glyphicon-phone"></i> Equipos y Repuesto <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="#"><i class=" glyphicon glyphicon-floppy-open"></i> Registrar Equipo Nuevo</a></li>
                      <li><a href="#"><i class="glyphicon glyphicon-download-alt"></i> Cargos</a></li>
                      <li><a href="#"><i class=" glyphicon glyphicon-list"></i> Lista De Equipos </a></li>
                      <li><a href="#"><i class="glyphicon glyphicon-usd"></i> Descargos o Ventas </a></li>

                    </ul>
                  </li>
                </ul>
              </div>

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
                <img src="<?php echo VIEW_LAYOUT ?>admin/images/img.jpg" alt="">Usuario : <?php echo $_SESSION['usuario']; ?>
                <span class=" fa fa-angle-down"></span>
              </a>
              <ul class="dropdown-menu dropdown-usermenu pull-right">
                <li><a href="javascript:;"> Profile</a></li>
                <li>
                  <a href="javascript:;">
                    <span class="badge bg-red pull-right">50%</span>
                    <span>Settings</span>
                  </a>
                </li>
                <li><a href="javascript:;">Help</a></li>
                <li><a href="<?php echo BASE_URL; ?>login/close"><i class="fa fa-sign-out pull-right"></i> Cerrar Sesion</a></li>
              </ul>
            </li>

            <li role="presentation" class="dropdown">
              <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-envelope-o"></i>
                <span class="badge bg-green">6</span>
              </a>
              <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                <li>
                  <a>
                    <span class="image"><img src="public/images/img.jpg" alt="Profile Image" /></span>
                    <span>
                      <span>John Smith</span>
                      <span class="time">3 mins ago</span>
                    </span>
                    <span class="message">
                      Film festivals used to be do-or-die moments for movie makers. They were where...
                    </span>
                  </a>
                </li>
                <li>
                  <a>
                    <span class="image"><img src="public/images/img.jpg" alt="Profile Image" /></span>
                    <span>
                      <span>John Smith</span>
                      <span class="time">3 mins ago</span>
                    </span>
                    <span class="message">
                      Film festivals used to be do-or-die moments for movie makers. They were where...
                    </span>
                  </a>
                </li>
                <li>
                  <a>
                    <span class="image"><img src="public/images/img.jpg" alt="Profile Image" /></span>
                    <span>
                      <span>John Smith</span>
                      <span class="time">3 mins ago</span>
                    </span>
                    <span class="message">
                      Film festivals used to be do-or-die moments for movie makers. They were where...
                    </span>
                  </a>
                </li>
                <li>
                  <a>
                    <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                    <span>
                      <span>John Smith</span>
                      <span class="time">3 mins ago</span>
                    </span>
                    <span class="message">
                      Film festivals used to be do-or-die moments for movie makers. They were where...
                    </span>
                  </a>
                </li>
                <li>
                  <div class="text-center">
                    <a>
                      <strong>See All Alerts</strong>
                      <i class="fa fa-angle-right"></i>
                    </a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>

          <!-- //////////////////////////////// fin del contenido menu top-->
        </nav>

        </div>
        <!-- /nav_menu -->
        </div>
        <!-- /top navigation -->
