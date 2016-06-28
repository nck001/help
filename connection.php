<?php
//mysql database connection instance
class Connection {
	private $_connection;
	private static $_instance;
	private $_host = "localhost";
	private $_username = "root";
	private $_password = "";
	private $_database = "help";

	//database instance make method
	public static function getInstance() {
		if(!self::$_instance) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	// Constructor
	private function __construct() {
		$this->_connection = new mysqli($this->_host, $this->_username,
			$this->_password, $this->_database);

		//mysql error handling
		if(mysqli_connect_error()) {
			trigger_error("Failed to conencto to MySQL: " . mysql_connect_error(),
				 E_USER_ERROR);
		}
	}
	//prevent duplication of connection
	private function __clone() { }
	// Get mysqli connection
	public function getConnection() {
		return $this->_connection;
	}
}