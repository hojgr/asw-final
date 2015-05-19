<?php


namespace App\Controllers;


use App\Core\Controller\Controller;
use App\Core\Response\RedirectResponse;
use App\Core\Response\TextResponse;
use App\Core\Response\ViewResponse;

class AccountController extends Controller {
	public function register() {
		return new ViewResponse("Account/register");
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

		$this->sendFlashMessage("Registrace probehla uspesne.");

		return $this->respond(new RedirectResponse("/"));
	}
}