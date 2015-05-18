<?php


namespace App\Controllers;


use App\Core\Controller\Controller;
use App\Core\Response\TextResponse;
use App\Core\Response\ViewResponse;

class AccountController extends Controller {
	public function register() {
		return new ViewResponse("Account/register");
	}

	public function registerPost() {
		if(!preg_match("/^[a-zA-Z0-9 _\\-]+$/", $this->getPost('username'))) {
			die("bad username");
		} else if($this->getPost('password') != $this->getPost("password_again")) {
			die("passwords dont match");
		}

		die("registered");

		return new TextResponse("end");
	}
}