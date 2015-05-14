<?php


namespace App\Controllers;


use App\Core\Response\TextResponse;
use App\Core\Response\ViewResponse;
use App\Core\Templating\View;

class HomeController {
	public function index() {
		return new ViewResponse("<h1>waaat</h1>\n");
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