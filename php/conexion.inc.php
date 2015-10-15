<?php
require_once ("globales.inc.php");
class Conexion {
	private $servidor;
	private $usuario;
	private $password;
	private $base_datos;
	private static $_instance;
	private static $_conexion;
	
	/* La función construct es privada para evitar que el objeto pueda ser creado mediante new */
	private function __construct() {
		$this->setConexion ();
		$this->conectar ();
	}
	
	/* Método para establecer los parámetros de la conexión */
	private function setConexion() {
		$conf = Conf::getInstance ();
		$this->servidor = $conf->getHostDB ();
		$this->base_datos = $conf->getDB ();
		$this->usuario = $conf->getUserDB ();
		$this->password = $conf->getPassDB ();
	}
	
	/* Realiza la conexión a la base de datos. */
	private function conectar() {
		if (self::$_conexion == null) {
			// PDO
			$dsn = 'mysql:dbname=' . $this->base_datos . ';host=' . $this->servidor . ';charset=utf8';
			//var_dump ( $dsn );
			$usuario = $this->usuario;
			$contraseña = $this->password;
			
			try {
				self::$_conexion = new PDO ( $dsn, $usuario, $contraseña );
			} catch ( PDOException $e ) {
				error_log ( "Error de conexion " . $e->getMessage (), 0 );
				exit ( 'Lo sentimos hay un error grave' );
			}
		}
	}
	/* Evitamos el clonaje del objeto. Patrón Singleton */
	private function __clone() {
	}
	
	/* Función encargada de crear, si es necesario, el objeto. Esta es la función que debemos llamar desde fuera de la clase para instanciar el objeto, y así, poder utilizar sus métodos */
	public static function getConexionPDO() {
		if (! (self::$_instance instanceof self)) {
			self::$_instance = new self ();
		}
		//self::$_conexion->query("SET NAMES 'utf8'");
		return self::$_conexion;
	}
}
?>