<?php
/**
 *
 */
class funcionarioModel extends Model
{
  public $model;
  function __construct()
  {
      parent::__construct();
      $this->_model = new Model();

  }

  public function get_funcionarios_limit_5()
  {
        $funcionarioss = $this->_model->query('SELECT
        id_funcionario,foto,nombre1,apellido1,
        estado,created,modified,
        EXTRACT(YEAR FROM created) AS anio,
        EXTRACT(MONTH FROM created) AS mes,
        EXTRACT(DAY FROM created) AS dia
        FROM funcionarios  ORDER BY id_funcionario DESC LIMIT 5;');
        $funcionarios = $this->_model->result();
        return $funcionarios;

  }
  public function get_funcionarios()
  {
        $funcionarioss = $this->_model->query('SELECT
          id_funcionario,
          foto,
          CONCAT(nombre1, " ", nombre2, " ", apellido1, " ",apellido2) nombres_apellidos,
          DATE_FORMAT(fec_nac,"%d/%m/%Y") AS fec_nac,
          DATE_FORMAT(fec_ingreso,"%d/%m/%Y") AS fec_ingreso,
          estado,
          grado_intruccion,
          profesion,
          code_cargo,
          descrip_cargo,
          func_inhe_cargo,
          obj_desemp_individual,
          id_unidad_adscripta,
          info_complentaria,
          DATE_FORMAT(modified,"%d/%m/%Y") AS fec_modified,
          DATE_FORMAT(created,"%d/%m/%Y") AS fec_created
          FROM funcionarios
          ORDER BY id_funcionario DESC;');
        $funcionarios = $this->_model->result();
        return $funcionarios;

  }
  public function get_funcionarios_active()
  {
        $funcionarioss = $this->_model->query('SELECT
        id_funcionario,foto,nombre1,apellido1,
        estado,created,modified,
        EXTRACT(YEAR FROM created) AS anio,
        EXTRACT(MONTH FROM created) AS mes,
        EXTRACT(DAY FROM created) AS dia
        FROM funcionarios  WHERE estado = "1" ORDER BY id_funcionario DESC;');
        $funcionarios = $this->_model->result();
        return $funcionarios;

  }

  public function find($query,$id)
   {
    $this->_model->query($query);
    $this->_model->bind(1, $id);
    $row = $this->_model->result();
    return $row;

   }

   public function set_exist_email($email,$id)
    {
       $sql="SELECT correo FROM funcionario WHERE correo = ? and id_funcionario <> ?;";
       $query=$this->_db->prepare($sql);
       $query->bindParam(1,$email,PDO::PARAM_STR);
       $query->bindParam(2,$id,PDO::PARAM_INT);
       if(!$query->execute() )return false;
       if($query->rowCount()> 0):

         return true;
       else:
         return false;

       endif;



    }

    public function SelectMaxId($table)
    {
      $user = $this->_model->query('SELECT MAX(id_funcionario) AS id FROM '.$table.'');
      $user = $this->_model->result();
      foreach ($user as $value) {
      return $value['id'];
      }

    }
}
