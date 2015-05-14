<?php


namespace App\Core\Request;


use App\Core\Routing\Route;

class RequestHandler {
	public function handle(Request $request, Route $route) {
		$reflection = new \ReflectionClass($route->getController());
		$controller = $reflection->newInstance();

		call_user_func_array([$controller, $route->getAction()], $route->parseParameters($request->getPath()));
	}
}