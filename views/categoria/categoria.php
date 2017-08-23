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
                             <?php if(isset($this->categoria) && !empty($this->categoria) && count($this->categoria)>0):?>

                                             <div class="title_left">
                                              <h4 class='modal-title '>Categoria creada el <?php echo $this->categoria[0]['dia'].'/'.$this->categoria[0]['mes'].'/'.$this->categoria[0]['anio']?></h4>
                                             </div>
                                             <div class="clearfix"></div><br>

                             <form id="FormEditCategoria" name="FormEditCategoria" autocomplete="on" action="<?php echo BASE_URL;?>categoria/edit" method="post" enctype="multipart/form-data">


                                 <input type="hidden" value="1" name="update" />
                                  <input type="hidden"  name="id_categoria" id="id_categoria" value="<?php echo $this->categoria[0]['id_categoria']?>" >

                                  <div class="form-group label-floating">

                                       <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
                                            <label for="estado">Nombre:</label>
                                       </div>
                                       <div class="col-md-10 col-lg-10 col-ms-10 col-xs-10">
                                         <input type="text" class="form-control" placeholder="Nombre"  value="<?php echo $this->categoria[0]['nombre']?>"  maxlength="30" name="nombre" id="nombre" autofocus="" required="required">

                                       </div>
                                  </div>

                                  <div class="clearfix"></div><br>

                                  <div class="form-group label-floating">

                                       <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
                                            <label for="estado">estado:</label>
                                       </div>
                                       <div class="col-md-10 col-lg-10 col-ms-10 col-xs-10">
                                          <select class="form-control" name="estado" id="estado">
                                            <option value="1"  <?php if($this->categoria[0]['estado']== 1) echo "selected";?>>ACTIVO</option>
                                            <option value="0"  <?php if($this->categoria[0]['estado']== 0) echo "selected";?>>INACTIVO</option>
                                          </select>
                                       </div>
                                  </div>

                                  <div class="clearfix"></div><br>


                                  <button type="submit" class="btn btn-success" >Guardar Cambios</button>
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
