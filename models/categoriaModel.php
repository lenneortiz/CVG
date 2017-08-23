<?php
/**
 *
 */
class categoriaModel extends Model
{
  public $model;
  function __construct()
  {
      parent::__construct();
      $this->_model = new Model();

  }

  public function get_all_categoria()
  {
        $categorias = $this->_model->query('SELECT
        id_categoria,nombre,estado,
        EXTRACT(YEAR FROM created) AS anio,
        EXTRACT(MONTH FROM created) AS mes,
        EXTRACT(DAY FROM created) AS dia
        FROM categoria ORDER BY id_categoria DESC;');
        $categorias = $this->_model->result();
        return $categorias;

  }

  public function get_all_active_categorias()
  {
        $categorias = $this->_model->query('SELECT
        id_categoria,nombre,estado,
        EXTRACT(YEAR FROM created) AS anio,
        EXTRACT(MONTH FROM created) AS mes,
        EXTRACT(DAY FROM created) AS dia
        FROM categoria WHERE estado = "1" ORDER BY id_categoria DESC;');
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
