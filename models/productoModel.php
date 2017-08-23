<?php
/**
 *
 */
class productoModel extends Model
{

  function __construct()
  {
    parent::__construct();
    $this->_model = new Model();

  }

  public function findAll($table)
    {
      //Model::GrandpaSetup();




      $table_exist = $this->_model->query('SELECT
                  IF( EXISTS
                      (SELECT * FROM information_schema.COLUMNS
                          WHERE TABLE_SCHEMA = "SICS"
                          AND TABLE_NAME = "'.$table.'"
                          LIMIT 1),
                  1, 0)
                  AS if_exists');
          $table_exist = $this->_model->result();
          if($table_exist[0]['if_exists'] == 1):
            $producto = $this->_model->query('SELECT * FROM '.$table.'');
            $producto = $this->_model->result();
            return $producto;
          else:
            return 0;
          endif;
    }

    public function lc_time_names()
    {

      $user = $this->_model->query("SET lc_time_names = 'es_ES'");
      $user = $this->_model->execute();
      return $user;
    }

    public function find($query,$id)
     {
      $this->_model->query($query);
      $this->_model->bind(1, $id);
      $row = $this->_model->result();
      return $row;

     }
}
