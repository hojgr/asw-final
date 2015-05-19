<?php


namespace App\Services;


use App\Core\Database\Database;

class NSA {
	/**
	 * @var Database
	 */
	private $db;

	/**
	 * @param Database $db
	 */
	public function __construct(Database $db) {
		$this->db = $db;
	}

	public function log($user_id, $ip, $path) {
		$statement = $this->db->getConnection()->prepare("INSERT INTO user_accesses
		(user_id, ip, path, `timestamp`) VALUES (:user_id, :ip, :path, NOW())");

		$statement->bindParam("user_id", $user_id);
		$statement->bindParam("ip", $ip);
		$statement->bindParam("path", $path);

		$e = $statement->execute();

		if(!$e) {
			throw new \Exception("DB Error: " . $this->db->getConnection()->errorCode());
		}
	}
}