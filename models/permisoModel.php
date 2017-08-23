<?php
/**
 *
 */
class permisoModel extends Model
{
  public $model;
  function __construct()
  {
      parent::__construct();
      $this->_model = new Model();

  }

  public function findAll($table)
  {
    $data = $this->_model->query('SELECT * FROM '.$table.'');
    $data = $this->_model->result();
    return $data;

  }
  public function find($query,$id)
   {
    $this->_model->query($query);
    $this->_model->bind(1, $id);
    $row = $this->_model->result();
    return $row;

   }
  public function Insert_Multiple_Permisos($consultar,$registrar,$editar,$eliminar,$reporte,$IdPerfil)
   {
     $Query = "SELECT *
      FROM
       perfiles PER
       INNER JOIN perfiles_recursos PR ON PER.idperfil = PR.idperfil
       WHERE PER.idperfil = ?
       LIMIT 0 , 30;";
       //$data = implode(", ", $IdPerfil); ;
     $Paramaters= array($IdPerfil);
     if ($this->_model->SearchQuery($Query, $Paramaters) == true):
        //echo "ya existen recursos asociados a este perfil ahora procedemos a editarlos";
        //exit;

          $sql = "UPDATE perfiles_recursos
              SET consultar = ?,
                agregar = ?,
                editar = ?,
                eliminar = ?,
                reporte = ?
                WHERE idperfil = ?;";
         //echo "<pre>";
         //echo $sql;
         //echo "<br>";
         //print_r($id_recurso);
          $stmt = $this->_db->prepare($sql);
          $stmt->bindParam(1,$consultar,PDO::PARAM_INT);
          $stmt->bindParam(2,$registrar,PDO::PARAM_INT);
          $stmt->bindParam(3,$editar,PDO::PARAM_INT);
          $stmt->bindParam(4,$eliminar,PDO::PARAM_INT);
          $stmt->bindParam(5,$reporte,PDO::PARAM_INT);
          $stmt->bindParam(6,$IdPerfil,PDO::PARAM_INT);
          if($stmt->execute()):
            return true;
          else:
            return false;
          endif;


     else:
      //echo "no existen recursos asociados a este perfil ahora procedemos a insertarlos";
        //exit;

          $sql = "INSERT INTO perfiles_recursos
          VALUES(NULL,?,?,?,?,?,?);";
          $stmt = $this->_db->prepare($sql);
          $stmt->bindParam(1,$consultar,PDO::PARAM_INT);
          $stmt->bindParam(2,$registrar,PDO::PARAM_INT);
          $stmt->bindParam(3,$editar,PDO::PARAM_INT);
          $stmt->bindParam(4,$eliminar,PDO::PARAM_INT);
          $stmt->bindParam(5,$reporte,PDO::PARAM_INT);
          $stmt->bindParam(6,$IdPerfil,PDO::PARAM_INT);
          if($stmt->execute()):
            return true;
          else:
            return false;
          endif;



     endif;


   }
}
