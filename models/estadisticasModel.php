<?php
/**
 *
 */
class estadisticasModel extends Model
{
  public $model;
  function __construct()
  {
      parent::__construct();
      $this->_model = new Model();


  }

  

   public function joins($query)
    {
     $this->_model->query($query);
     $row = $this->_model->result();
     return $row;

    }
}
