<div class="clearfix">&nbsp;</div>

<!-- footer content -->
<footer class="navbar-fixed-bottom">
<div class="pull-right">
ADMIN |SISTEM <strong>CVG</strong> Desarrollado por  <a href="#">SistemYara</a>
</div>
<div class="clearfix"></div>
</footer>
<!-- /footer content -->

</div>
<!-- /main container-->

</div>

<!-- / container body-->

<?php $fileJs = array('jquery-2.1.4',
                      'bootstrap.min'
                     );?>
<?php $fastclick = array('fastclick');?>
<?php $nprogress = array('nprogress');?>
<?php $jquery_dataTables_min_js = array('jquery.dataTables.min');?>
<?php $dataTables_bootstrap_min_js = array('dataTables.bootstrap.min');?>
<?php $bootstrapValidator_js = array('bootstrapValidator');?>
<?php $bootstrapfile_imput_js = array('fileinput');?>
<?php $locale_es_js = array('es');?>
<?php $color_picker_min_js = array('color-picker.min');?>
<?php $customJs = array('custom');?>
<?php $jquery_ui_Js = array('jquery-ui-1.10.0.custom.min');?>
<?php $highcharts = array('highcharts');?>
<?php $exporting = array('exporting');?>

<?php Core::loadJS(VIEW_LAYOUT.'admin/js/',$fileJs); ?>
<?php Core::loadJS(VIEW_LAYOUT.'admin/assets/jquery-ui-bootstrap/assets/js/',$jquery_ui_Js); ?>
<?php Core::loadJS(VIEW_LAYOUT.'admin/assets/fastclick/lib/',$fastclick); ?>
<?php Core::loadJS(VIEW_LAYOUT.'admin/assets/nprogress/',$nprogress); ?>
<?php Core::loadJS(VIEW_LAYOUT.'admin/assets/datatables.net/js/',$jquery_dataTables_min_js); ?>
<?php Core::loadJS(VIEW_LAYOUT.'admin/assets/datatables.net-bs/js/',$dataTables_bootstrap_min_js); ?>
<?php Core::loadJS(VIEW_LAYOUT.'admin/js/',$bootstrapValidator_js); ?>
<?php Core::loadJS(VIEW_LAYOUT.'admin/assets/bootstrap-file-input/js/',$bootstrapfile_imput_js); ?>
<?php Core::loadJS(VIEW_LAYOUT.'admin/assets/bootstrap-file-input/locales/',$locale_es_js); ?>
<?php Core::loadJS(VIEW_LAYOUT.'admin/assets/colorpicker/js/',$color_picker_min_js); ?>
<?php Core::loadJS(VIEW_LAYOUT.'admin/assets/build/js/',$customJs); ?>
<?php Core::loadJS(VIEW_LAYOUT.'admin/assets/chartjs/',$highcharts); ?>
<?php Core::loadJS(VIEW_LAYOUT.'admin/assets/chartjs/',$exporting); ?>
<script>

</script>
</body>
</html>
<?php ob_flush() //permite limpiar el buffer imprimiendo toda la salida ?>
