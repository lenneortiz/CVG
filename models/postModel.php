<?php
/**
 *
 */
class postModel extends Model
{

  public function __construct()
  {
    parent::__construct();
  }
  public function getPost()
  {
    $post = array(
                              'id' => '1',
                              'titulo' => 'primer post',
                              'contenido' => 'este es mi primer post',
                              'autor' => 'lenne ortiz'
                              );
    return $post;
  }

}

 ?>
