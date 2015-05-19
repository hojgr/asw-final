<?php


namespace App\Controllers;


use App\Core\Controller\Controller;
use App\Core\Response\RedirectResponse;
use App\Core\Response\ViewResponse;

class AccountController extends Controller {
	public function register() {
		return $this->respond(new ViewResponse("Account/register"));
	}

	public function registerPost() {
		if(!preg_match("/^[a-zA-Z0-9 _\\-]+$/", $this->getPost('username'))) {
			$this->sendFlashMessage("Zadane uzivatelske jmeno obsahuje nepovolene znaky.", "error");
			return $this->respond(new RedirectResponse("/signup"));
		} else if($this->getPost('password') != $this->getPost("password_again")) {
			$this->sendFlashMessage("Hesla se neshoduji.", "error");
			return $this->respond(new RedirectResponse("/signup"));
		} else if(strlen($this->getPost("password")) == 0) {
			$this->sendFlashMessage("Musite zadat heslo!", "error");
			return $this->respond(new RedirectResponse("/signup"));
		}

		$dbu = $this->dic->getDBUser();

		if($dbu->isUsernameTaken($this->getPost("username"))) {
			$this->sendFlashMessage("Uzivatelske jmeno je zabrane!", "error");
			return $this->respond(new RedirectResponse("/signup"));
		}

		$dbu->createUser($this->getPost("username"), $this->getPost("password"));
		$this->sendFlashMessage("Registrace probehla uspesne.");

		return $this->respond(new RedirectResponse("/"));
	}

	public function login() {
		return $this->respond(new ViewResponse("Account/login"));
	}

	public function loginPost() {
		if($this->getPost("username") == "") {
			$this->sendFlashMessage("Musite zadat uzivatelske jmeno!", "error");
			return $this->respond(new RedirectResponse("/login"));
		}

		if($this->getPost("password") == "") {
			$this->sendFlashMessage("Musite zadat heslo!", "error");
			return $this->respond(new RedirectResponse("/login"));
		}

		$dbu = $this->dic->getDBUser();

		$user = $dbu->findByUsername($this->getPost("username"));

		if($user === false) {
			$this->sendFlashMessage("Zadany uzivatel neexistuje!", "error");
			return $this->respond(new RedirectResponse("/login"));
		} if($user->password !== md5($this->getPost("password"))) {
			$this->sendFlashMessage("Nespravne heslo!", "error");
			return $this->respond(new RedirectResponse("/login"));
		}

		$this->dic->getAuth()->auth($user);

		$this->sendFlashMessage("Prihlaseni probehlo uspesne!");
		return $this->respond(new RedirectResponse("/"));
	}
}