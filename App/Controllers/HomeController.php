<?php


namespace App\Controllers;


use App\Core\Response\Response;

class HomeController {
	public function index() {
		return new Response("<h1>waaat</h1>\n");
	}

	public function foo() {
		return new Response("<h1>foo!!(get) " . $_SERVER['REQUEST_METHOD'] . "</h1>\n");
	}

	public function fooPost() {
		return new Response("FooPost!\n");
	}

	public function bar($in) {
		return new Response("<h1>Bar $in!!!</h1>\n");
	}
}