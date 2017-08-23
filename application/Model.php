<?php
/**
 *
 */
class Model extends Database
{
    protected $_db;
    protected $_config = array();
    protected $_link;
    protected $_result;
    protected $consulta;
  public function __construct()
  {
  $this->_db = new Database();

  }

  protected static function GrandpaSetup(){
       echo 'hola desde la clase model padre';

   }

   public function query($query){
    $this->stmt = $this->_db->prepare($query);
  }


  public function bind($param, $value, $type = null){

    if (is_null($type)) {
        switch (true) {
            case is_int($value):
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            default:
                $type = PDO::PARAM_STR;
        }
    }
    $this->stmt->bindValue($param, $value, $type);
}

public function execute(){
    return $this->stmt->execute();
}

public function result(){
    $this->execute();
    return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function one(){
    $this->execute();
    return $this->stmt->fetch(PDO::FETCH_ASSOC);
}

public function rowCount(){
    return $this->stmt->rowCount();
}

public function InsertId(){
    return $this->_db->lastInsertId();
}

public function single(){
    $this->execute();
    return $this->stmt->fetch(PDO::FETCH_ASSOC);
}

   public function disconnect()
  {
      $this->_db = null;
  }

  public function ExecuteQuery( $Query, $Parameters) {

   try {
     $Statement = $this->_db->prepare($Query);
   foreach ($Parameters as $Key => $Val)
       $Statement->bindValue($Key+1, $Val);

       if ($Statement->execute()) {
        return true;
       } else {
         return false;
       }

       //$this->_db = null;

 } catch ( PDOException $message ) {
      echo $message->getMessage();
   }
}


public function SearchQuery( $Query, $Parameters) {

 try {
   $Statement = $this->_db->prepare($Query);
 foreach ($Parameters as $Key => $Val)
     $Statement->bindValue($Key+1, $Val);

     if (!$Statement->execute()) return false;
     if($Statement->rowCount() > 0):
    return true;
     else:
    return false;
     endif;


     //$this->_db = null;

} catch ( PDOException $message ) {
    echo $message->getMessage();
 }
}



}

 ?>
