<?php
/**
 *
 */
class unidadModel extends Model
{
  public $model;
  function __construct()
  {
      parent::__construct();
      $this->_model = new Model();

  }

  public function get_unidades()
  {
        $unidadess = $this->_model->query('SELECT
        id_unidad_adscripta,nombre,estado,
        EXTRACT(YEAR FROM created) AS anio,
        EXTRACT(MONTH FROM created) AS mes,
        EXTRACT(DAY FROM created) AS dia
        FROM unidad_adscripta WHERE estado = "1" ORDER BY id_unidad_adscripta DESC;');
        $unidades = $this->_model->result();
        return $unidades;

  }
}
