
<?php $fileJs = array('jquery-3.1.1.min',
                      'bootstrap.min',
                      'material.min',
                      'ripples.min',
                      'sweetalert2.mi',
                      'bootstrapValidator',
                      'main'

                    );?>
<?php Core::loadJS(VIEW_LAYOUT.'default/js/',$fileJs); ?>
<?php
ob_flush() //permite limpiar el buffer imprimiendo toda la salida
?>
