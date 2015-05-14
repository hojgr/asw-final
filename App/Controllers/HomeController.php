<?php


namespace App\Controllers;


class HomeController {
	public function index() {
		echo "<h1>waaat</h1>";
	}

	public function foo() {
		echo "<h1>foo!!</h1>";
	}

	public function bar($in) {
		echo "<h1>Bar $in!!!</h1>";
	}
}