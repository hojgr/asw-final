<?php

namespace App\Core\Session;

class Session {
	public function exists($name) {
		return isset($_SESSION[$name]);
	}

	public function getSession($name) {
		return $_SESSION[$name];
	}

	public function setSession($k, $v) {
		$_SESSION[$k] = $v;
	}

	public function getSessions() {
		return $_SESSION;
	}

	public function removeSession($k)
	{
		unset($_SESSION[$k]);
	}
}