<?php


namespace App\Model;


use App\Core\Database\Database;

class DBUser {

	/**
	 * @var Database
	 */
	protected $db;

	public function __construct(Database $db) {
		$this->db = $db;
	}

	public function createUser($username, $password) {
		$password = md5($password);

		$statement = $this->db->getConnection()->prepare("
		INSERT INTO users
		(username, password, blocked, admin_level, registered_at)
		VALUES (:username, :password, 0, 0, NOW())");

		$statement->bindParam(":username", $username);
		$statement->bindParam(":password", $password);

		$e = $statement->execute();

		if(!$e) {
			throw new \Exception("DB Error: " . $this->db->getConnection()->errorCode());
		}
	}

	public function isUsernameTaken($username)
	{
		$statement = $this->db->getConnection()->prepare("SELECT * FROM users WHERE username = :username");
		$statement->bindParam("username", $username);

		$statement->execute();

		$q = $statement->rowCount();

		return $q > 0;
	}
}