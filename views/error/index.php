
<section id="contenedor" style="max-width: 600px !important;">

<?php //print_r($_GET['url']); ?>
    <?php if (isset($this->mensaje)): ?>
        <div id="error"><?php echo $this->mensaje; ?></div>
      <?php else: ?>

        <h2>Mensaje vacio</h2>
    <?php endif; ?>

    <a href="<?php echo BASE_URL ?>index">Ir al Inicio</a>

    <a href="javascript:history.back(1)">Volver Página anterior</a>

</section>
