<?php
/**
 *
 */
class marcaModel extends Model
{
  public $model;
  function __construct()
  {
      parent::__construct();
      $this->_model = new Model();

  }

  public function get_marca()
  {
        $marcas = $this->_model->query('SELECT
        id_marca,nombre,estado,
        EXTRACT(YEAR FROM created) AS anio,
        EXTRACT(MONTH FROM created) AS mes,
        EXTRACT(DAY FROM created) AS dia
        FROM marca WHERE estado = "1" ORDER BY id_marca DESC;');
        $marcas = $this->_model->result();
        return $marcas;

  }
}
