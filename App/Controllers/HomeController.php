<?php


namespace App\Controllers;


use App\Core\Response\TextResponse;
use App\Core\Response\ViewResponse;

class HomeController {
	public function index() {
		return new ViewResponse("Home/index");
	}
}