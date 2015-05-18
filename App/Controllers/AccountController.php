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
		var_dump($this->_POST);
		return new TextResponse("end");
	}
}