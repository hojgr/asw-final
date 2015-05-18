<?php


namespace App\Controllers;


use App\Core\Controller\Controller;
use App\Core\Response\ViewResponse;

class HomeController extends Controller {
	public function index() {
		$this->sendFlashMessage("wat wat");
		return new ViewResponse("Home/index");
	}
}