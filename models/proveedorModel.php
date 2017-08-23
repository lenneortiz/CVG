<?php
/**
 *
 */
class proveedorModel extends Model
{
  public $model;
  function __construct()
  {
      parent::__construct();
      $this->_model = new Model();

  }

  public function get_estado()
  {
        $estados = $this->_model->query('SELECT * FROM estado;');
        $estados = $this->_model->result();
        return $estados;

  }
  public function find($query,$id)
   {
    $this->_model->query($query);
    $this->_model->bind(1, $id);
    $row = $this->_model->result();
    return $row;

   }
}
