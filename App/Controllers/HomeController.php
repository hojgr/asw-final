<?php


namespace App\Controllers;


class HomeController {
	public function index() {
		echo "<h1>waaat</h1>\n";
	}

	public function foo() {
		echo "<h1>foo!!(get) " . $_SERVER['REQUEST_METHOD'] . "</h1>\n";
	}

	public function fooPost() {
		echo "FooPost!\n";
	}

	public function bar($in) {
		echo "<h1>Bar $in!!!</h1>\n";
	}
}