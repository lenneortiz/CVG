<?php
/**
 *
 */
class perfilModel extends Model
{
  public $model;
  function __construct()
  {
      parent::__construct();
      $this->_model = new Model();

  }

  public function findAll($table)
  {
    $perfiles = $this->_model->query('SELECT * FROM '.$table.'');
    $perfiles = $this->_model->result();
    return $perfiles;

  }
}
