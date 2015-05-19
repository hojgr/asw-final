<?php

namespace App\Core\Session;

class Session {
	/**
	 * @var array
	 */
	private $sessions;

	public function __construct() {
		$this->sessions = $_SESSION;
	}

	public function exists($name) {
		return isset($this->sessions[$name]);
	}

	public function getSession($name) {
		return $this->sessions[$name];
	}

	public function setSession($k, $v) {
		$this->sessions[$k] = $v;
		$_SESSION[$k] = $v;
	}

	public function getSessions() {
		return $this->sessions;
	}

	public function removeSession($k)
	{
		unset($_SESSION[$k]);
		unset($this->sessions[$k]);
	}
}