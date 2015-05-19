<?php


namespace App\Controllers;


use App\Core\Controller\Controller;
use App\Core\Response\ViewResponse;

class HomeController extends Controller {
	public function index() {
		return $this->respond(new ViewResponse("Home/index"));
	}
}