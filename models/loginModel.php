<?php
/**
 *
 */
class loginModel extends Model
{

  public static $tablename = "user";
  public $nombre;
  public $apellido;
  public function __construct(){
        parent::__construct();
    }

  
  public function select($sql,$array = array(), $fetchMode = PDO::FETCH_ASSOC){
    $stmt =  $this->_db->prepare($sql);
    foreach($array as $key => $value){
      $stmt->bindValue("$key", $value);
    }
    $stmt->execute();
    return $stmt->fetch($fetchMode);
  }

  public function check_max_intento_login($user_id) {
      // Obtiene el timestamp del tiempo actual.
      $now = time();

      // Todos los intentos de inicio de sesión se cuentan desde las 2 horas anteriores.
      $valid_attempts = $now - (2 * 60 * 60);

      if ($stmt = $this->_db->prepare("SELECT tiempo
                                          FROM intento_login
                                          WHERE user_id = '". $user_id."'
                                          AND tiempo > '".$valid_attempts."'")) {


          // Ejecuta la consulta preparada.
          $stmt->execute();
          $stmt->fetch(PDO::FETCH_ASSOC);

          // Si ha habido más de 3 intentos de inicio de sesión fallidos.
          if ($stmt->rowCount() > 3) {
              return true;
          } else {
              return false;
          }
      }
  }

  public  function VerificaPassword($password, $hashedPassword)
	  {


	       if(password_verify($password, $hashedPassword) ):

	       return true;

	       	else:

	       	return false;


	       endif;

	  }

    public function insertIntentoLogin($user_id)
    {
      $now = time();
                              $sql="INSERT INTO intento_login VALUES (?,?)";
                              $query=$this->_db->prepare($sql);
                              $query->bindParam(1,$user_id,PDO::PARAM_INT);
                              $query->bindParam(2,$now,PDO::PARAM_INT);
                             $query->execute();

    }

    public function truncate_table_intento_login($user_id){

      $sql = "DELETE FROM intento_login WHERE user_id = ?";
      $query = $this->_db->prepare($sql);
      $query->bindParam(1, $user_id);
      $query->execute();
    }

}

 ?>
