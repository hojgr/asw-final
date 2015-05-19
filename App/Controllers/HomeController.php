<?php


namespace App\Controllers;


use App\Core\Response\ViewResponse;

class HomeController extends BaseController {
	public function index() {
		return $this->respond(new ViewResponse("Home/index", ["posts" => $this->dic->getWall()->getPosts()]));
	}
}