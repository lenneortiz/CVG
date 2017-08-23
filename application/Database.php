<?php
class Database extends PDO
{

	public function __construct() {
        parent::__construct(
            
            MYSQL,MYSQL_USER,MYSQL_PASS,
            array (
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . DB_CHAR,
				PDO::ATTR_PERSISTENT,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
            );
    }

	/*protected function Conexion($motor_conex)

	{
    try
			{

				switch ($motor_conex) {
					case 'mysql':
					try
						{

							$this->dbh=new PDO(MYSQL,MYSQL_USER,MYSQL_PASS);
							$this->dbh->exec("SET NAMES'UTF8'");
							$this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							return $this->dbh;

							//echo "conexion exitosa";

						} catch(PDOException $e) {

							die("error de conexion".$e->getMessage() );


						}
						break;

						case 'pgsql':
						try
							{

								$this->dbh=new PDO(PGSQL,PG_USER,PG_PASS);
								$this->dbh->exec("SET NAMES'UTF8'");
								$this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
								return $this->dbh;

								//echo "conexion exitosa";

							} catch(PDOException $e) {

								die("error de conexion".$e->getMessage() );


							}
							break;

					default:
						echo "error de conexion";
						break;
				}

			} catch(PDOException $e) {

				die("error de conexion".$e->getMessage() );

			}
	}*/


}
?>
