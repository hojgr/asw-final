<?php


namespace App\Controllers;


use App\Core\Response\TextResponse;
use App\Core\Response\ViewResponse;

class HomeController {
	public function index() {
		return new ViewResponse("<h1>what</h1>\n");
	}

	public function foo() {
		return new ViewResponse("Home/foo", ["test" => "one two three four"]);
	}

	public function fooPost() {
		return new TextResponse("Text response!");
	}

	public function bar($in) {
		return new ViewResponse("<h1>Bar $in!!!</h1>\n");
	}
}