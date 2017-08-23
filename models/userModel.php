<?php
/**
 *
 */
class userModel extends Model
{
    public $id;
    public $model;
  public function __construct(){
        parent::__construct();

      $this->_model = new Model();
    }


  public function findAll($table)
    {
      //Model::GrandpaSetup();


      $user = $this->_model->query('SELECT * FROM '.$table.'');
      $user = $this->_model->result();
      return $user;
    }
    public function SelectMaxId($table)
    {
      $user = $this->_model->query('SELECT MAX(iduser) AS id FROM '.$table.'');
      $user = $this->_model->result();
      foreach ($user as $value) {
      return $value['id'];
      }

    }

    public function find($query,$id)
     {
      $this->_model->query($query);
      $this->_model->bind(1, $id);
      $row = $this->_model->result();
      return $row;

     }
     public function set_PerfilUser($id)
      {
       $this->_model->query('SELECT
                            P.nombre,
                            P.idperfil
                              FROM
                              perfiles P
                              INNER JOIN usuarios_perfiles UP ON P.idperfil = UP.idperfil
                              WHERE UP.id_user = ?;');
       $this->_model->bind(1, $id);
       $row = $this->_model->result();
       return $row;

      }
      public function set_Usuarios_Perfiles($id)
       {
        $this->_model->query('SELECT
                            iduser_perfil
                               FROM
                               usuarios_perfiles

                               WHERE id_user = ?;');
        $this->_model->bind(1, $id);
        $row = $this->_model->result();
        return $row;

       }

      public function set_exist_email($email,$id)
       {
          $sql="SELECT correo FROM user WHERE correo = ? and iduser <> ?;";
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
       public function set_verifi_email_bd($email)
        {
           $sql="SELECT correo FROM user WHERE correo = ? ;";
    				$query=$this->_db->prepare($sql);
           $query->bindParam(1,$email,PDO::PARAM_STR);
    				if(!$query->execute() )return false;
    				if($query->rowCount()> 0):

    					return true;
           else:
             return false;

    				endif;



        }

        public function set_verifi_exitste_perfil_user($id_perfil)
         {
            $sql="SELECT
            iduser_perfil
            FROM
            usuarios_perfiles
            WHERE id_user = ?;";
     				$query=$this->_db->prepare($sql);
            $query->bindParam(1,$id_perfil,PDO::PARAM_STR);
     				if(!$query->execute() )return false;
     				if($query->rowCount()> 0):

     					return true;
            else:
              return false;

     				endif;



         }

     public function listar_permisos($id = null,$recurso)
      {

        $this->_model->query('SELECT
                              PR.consultar,
                              PR.agregar,
                              PR.editar,
                              PR.eliminar,
                              PR.reporte
                              FROM
                              perfiles_recursos PR
                              INNER JOIN perfiles P ON P.idperfil = PR.idperfil
                              INNER JOIN usuarios_perfiles UP ON UP.idperfil = PR.idperfil
                              WHERE UP.id_user = ?');
        $this->_model->bind(1, $id,PDO::PARAM_INT);
        $data = $this->_model->result();
        if($this->_model->rowCount() > 0):

          foreach ($data as $value):
            if (in_array($recurso, $value)) {

            }else {
              Core::header(BASE_URL.'error/index/5050');
            }
            endforeach;

        else:

          Core::header(BASE_URL.'error/index/5050');
        endif;






      }

      function pdoMultiInsert($tableName, $data){

      //Will contain SQL snippets.
      $rowsSQL = array();

      //Will contain the values that we need to bind.
      $toBind = array();

      //Get a list of column names to use in the SQL statement.
      $columnNames = array_keys($data[0]);

      //Loop through our $data array.
      foreach($data as $arrayIndex => $row){
          $params = array();
          foreach($row as $columnName => $columnValue){
              $param = ":" . $columnName . $arrayIndex;
              $params[] = $param;
              $toBind[$param] = $columnValue;
          }
          $rowsSQL[] = "(" . implode(", ", $params) . ")";
      }

      //Construct our SQL statement
      $sql = "INSERT INTO '".$tableName."' (" . implode(", ", $columnNames) . ") VALUES " . implode(", ", $rowsSQL);

  echo $sql;
  }



}
