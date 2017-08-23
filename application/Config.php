<?php
//ruta del proyecto
define('BASE_URL', 'http://localhost/CVG/');
define('HOME', 'admin');
define('DEFAULT_LAYOUT', 'default');
define('DEFAULT_LOGIN', 'login');
define("VIEW_LAYOUT","views/layout/");
/**
 * Definir los permisos en constantes
 */
define('ACCESS_VIEW',1);
define('ACCESS_CREATE',2);
define('ACCESS_EDIT',3);
define('ACCESS_DELETE',4);
define('ACCESS_REPORT',5);


//CONEXION A MYSQL
define("NAME_DATABASE",'cvg_prueba');
define("MYSQL", "mysql:host=localhost;dbname=".NAME_DATABASE."");
define("MYSQL_USER", "root");
define("MYSQL_PASS", "12345");
define("CHAR_SET", "utf8");

//CONEXION A POSTGREsQL
define("PGSQL", "pgsql:host=localhost;dbname=crud");
define("PG_USER", "postgres");
define("PG_PASS", "12345");

defined('DB_HOST')              ? null : define('DB_HOST', 'localhost');
defined('DB_USER')              ? null : define('DB_USER', 'root');
defined('DB_PASS')              ? null : define('DB_PASS', '12345');
//defined('DB_PASS')              ? null : define('DB_PASS', 'e4e5e6e7');
defined('DB_NAME')              ? null : define('DB_NAME', 'crud');
defined('DB_CHAR')              ? null : define('DB_CHAR', 'utf8');

?>
