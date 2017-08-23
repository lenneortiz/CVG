<?php //if($this->titulo ) echo $this->titulo ;?>

<?php //if($this->mensaje ) echo $this->mensaje ;?>



<?php if (Session::get('autenticado')): ?>
  <a href="<?php echo BASE_URL ?>login/">Iniciar Sesion</a>
<?php else: ?>
<?php echo 'usuario autenticado' ?>
<?php endif; ?>
