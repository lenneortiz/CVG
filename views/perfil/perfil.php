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
                          <h2></h2>
                  </section>


                  <!-- x_panel-->
                  <div class="x_panel">
                          <!-- x_content-->
                          <div class="x_content">

                               <?php $error = array_pop($breadcrumb); ?>
                               <?php echo Core::error_get($error); ?>
                               <?php if(isset($this->perfil) && !empty($this->perfil) && count($this->perfil)>0):?>

                                               <div class="title_left">
                                                <h4 class='modal-title '>Perfil credo el <?php echo $this->perfil[0]['dia'].'/'.$this->perfil[0]['mes'].'/'.$this->perfil[0]['anio']?></h4>
                                               </div>
                                               <div class="clearfix"></div><br>

                               <form id="FormEdiPerfil" name="FormEditPerfil" autocomplete="on" action="<?php echo BASE_URL;?>perfil/edit" method="post" enctype="multipart/form-data">


                                   <input type="hidden" value="1" name="update" />
                                    <input type="hidden"  name="id_perfil" id="id_perfil" value="<?php echo $this->perfil[0]['idperfil']?>" >
                                    <div class="form-group label-floating">
                                      <input type="text" class="form-control" placeholder="Nombre"  value="<?php echo $this->perfil[0]['nombre']?>"  maxlength="13" name="nombre" id="nombre" autofocus="" required="required">
                                    </div>


                                    <button type="submit" class="btn btn-success" >Guardar</button>
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
