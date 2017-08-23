VG sistema de control de inventarios  Version:1.0

configuración:
paso-1:descargar los archivos correspondientes a la aplicaciòn.
paso-2:habrir phpmyadmin y crear una base de datos llamada cvg y seleccionar la base de datos creada.
paso-3:importar el archivo CVG.sql que esta ubicado en la raiz del direcctorio del proyecto con phpmyadmin.
paso-4:entrar al directorio application y habrir el archivo Config.php y editar  lo siguiente

define("DSN", "mysql:host=localhost;dbname=cvg");
define("DB_USER", "tu usuario");
define("DB_PASS", "tu clave");

paso-4:habrir un navegdor y escribir e la barra de dirección lo siguiente http://localhost/CVG/index para entrar a la pantalla de inicio del sistema.

Usuario y Clave para entrar a la aplicación

usuario:yamirokuay.lo@gmail.com
clave:lenne20


