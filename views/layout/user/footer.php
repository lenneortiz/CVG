<!-- footer content -->
<footer class="navbar-fixed-bottom">
<div class="pull-right">
ADMIN |SISTEM Desarrollado por  <a href="#">Sistemyaracuy2021</a>
</div>
<div class="clearfix"></div>
</footer>
<!-- /footer content -->

</div>
<!-- /main container-->

</div>

<!-- / container body-->

<?php $fileJs = array('jquery.min',
                      'bootstrap.min',
                     );?>
<?php $fastclick = array('fastclick',);?>
<?php $nprogress = array('nprogress',);?>
<?php $customJs = array('custom',);?>

<?php Core::loadJS(VIEW_LAYOUT.'admin/js/',$fileJs); ?>
<?php Core::loadJS(VIEW_LAYOUT.'admin/assets/fastclick/lib/',$fastclick); ?>
<?php Core::loadJS(VIEW_LAYOUT.'admin/assets/nprogress/',$nprogress); ?>
<?php Core::loadJS(VIEW_LAYOUT.'admin/assets/build/js/',$customJs); ?>

</body>
</html>
