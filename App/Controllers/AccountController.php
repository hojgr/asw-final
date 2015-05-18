<?php


namespace App\Controllers;


use App\Core\Response\TextResponse;
use App\Core\Response\ViewResponse;

class AccountController {
	public function register() {
		return new ViewResponse("Account/register");
	}

	public function registerPost() {
		var_dump($_POST);
		return new TextResponse("end");
	}
}