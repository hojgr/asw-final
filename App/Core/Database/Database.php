<?php


namespace App\Core\Database;


class Database {
	protected $connection;
	public function __construct($host, $user, $password, $db) {
		$this->connection= new \PDO("mysql:host=$host;dbname=$db",$user,$password);
		if ($this->connection->errorCode()) {
			throw new \Exception($this->connection->errorCode());
		}
		$this->connection->query("SET NAMES utf8");
	}

	public function getConnection() {
		return $this->connection;
	}
}