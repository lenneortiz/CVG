<?php
/**
 *
 */
class unidadesModel extends Model
{
  public $model;
  function __construct()
  {
      parent::__construct();
      $this->_model = new Model();

  }

  public function get_all_unidades()
  {
        $categorias = $this->_model->query('SELECT
        id_unidad_adscripta,nombre,estado,
        EXTRACT(YEAR FROM created) AS anio,
        EXTRACT(MONTH FROM created) AS mes,
        EXTRACT(DAY FROM created) AS dia
        FROM unidad_adscripta WHERE estado = "1" ORDER BY id_unidad_adscripta DESC;');
        $categorias = $this->_model->result();
        return $categorias;

  }

  public function get_all_active_unidades()
  {
        $categorias = $this->_model->query('SELECT
        id_unidad_adscripta,nombre,estado,
        EXTRACT(YEAR FROM created) AS anio,
        EXTRACT(MONTH FROM created) AS mes,
        EXTRACT(DAY FROM created) AS dia
        FROM unidad_adscripta WHERE estado = "1" ORDER BY id_unidad_adscripta DESC;');
        $categorias = $this->_model->result();
        return $categorias;

  }

  public function find($query,$id)
   {
    $this->_model->query($query);
    $this->_model->bind(1, $id);
    $row = $this->_model->result();
    return $row;

   }
}
