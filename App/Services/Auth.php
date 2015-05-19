<?php


namespace App\Services;


use App\Core\Session\Session;
use App\Model\User;

class Auth {

	/**
	 * @var User
	 */
	private $user;

	/**
	 * @var Session
	 */
	private $session;

	public function __construct(Session $session) {
		$this->session = $session;

		if($this->session->exists("user")) {
			$this->user = $this->session->getSession("user");
		}
	}

	public function isAuthed() {
		return $this->user !== null;
	}

	public function auth(User $user) {
		$this->user = $user;
		$this->session->setSession("user", $this->user);

		return true;
	}

	public function logout() {
		$this->user = null;
		$this->session->removeSession("user");
	}

	/**
	 * @return User
	 */
	public function getUser()
	{
		return $this->user;
	}
}