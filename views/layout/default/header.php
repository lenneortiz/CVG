<?php ob_start();//da comienzo al buffer ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php if($this->titulo ) echo $this->titulo;?></title>
    <!--<link rel="stylesheet" href="<?php //echo $_layout_aparams['url_css']; ?>style.css">
    <link rel="stylesheet" href="<?php //echo $_layout_aparams['url_css']; ?>bootstrap.min.css">-->
    <?php $fileCss = array('bootstrap.min',
                            'bootstrap-material-design.min',
                            'ripples.min',
                            'sweetalert2',
                            'material-design-iconic-font.min',
                            'bootstrapValidator','main'
                          );?>
<?php echo Core::loadCSS(VIEW_LAYOUT.'default/css/',$fileCss);?>
</head>
  <body class="lockscreen">
