<?php


namespace App\Core\Request;


use App\Core\DI\DependencyInjectionContainer;
use App\Core\Response\TextResponse;
use App\Core\Response\ViewResponse;
use App\Core\Routing\Route;

class RequestHandler {

	/**
	 * @var DependencyInjectionContainer
	 */
	private $dic;

	public function __construct(DependencyInjectionContainer $dic) {
		$this->dic = $dic;
	}

	public function handle(Request $request, Route $route) {
		$reflection = new \ReflectionClass($route->getController());
		$controller = $reflection->newInstance();

		/**
		 * @var $response ViewResponse|TextResponse
		 */
		$response = call_user_func_array([$controller, $route->getAction()], $route->parseParameters($request->getPath()));

		if($response instanceof TextResponse) {
			echo $response->getContents();
		} else {

			$response->getView()->setVariable("flashes", []);

			$viewResolver = $this->dic->getViewResolver();
			$html = $viewResolver->getHTML($response->getView());
			echo $html;
		}
	}
}