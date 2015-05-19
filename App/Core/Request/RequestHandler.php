<?php


namespace App\Core\Request;


use App\Core\DI\DependencyInjectionContainer;
use App\Core\Response\TextResponse;
use App\Core\Response\ViewResponse;
use App\Core\Routing\Route;
use App\Core\Session\Session;
use App\Core\Templating\View;

class RequestHandler {

	/**
	 * @var DependencyInjectionContainer
	 */
	private $dic;

	public function __construct(DependencyInjectionContainer $dic) {
		$this->dic = $dic;
	}

	public function handle(Request $request, Route $route) {
		$session = $this->dic->getSession();

		$reflection = new \ReflectionClass($route->getController());
		$controller = $reflection->newInstance($session);

		/**
		 * @var $response ViewResponse|TextResponse
		 */
		$response = call_user_func_array([$controller, $route->getAction()], $route->parseParameters($request->getPath()));

		if($response instanceof TextResponse) {
			echo $response->getContents();
		} else {

			$this->processFlashes($response->getView(), $session);

			foreach($controller->viewVariables as $k => $v) {
				$response->getView()->setVariable($k, $v);
			}

			$viewResolver = $this->dic->getViewResolver();
			$html = $viewResolver->getHTML($response->getView());
			echo $html;

		}
	}

	public function processFlashes(View $view, Session $session) {
		if($session->exists("fw_old_flashes")) {
			$old_flashes = $session->getSession("fw_old_flashes");
			$view->setVariable("flashes", $old_flashes);
			$session->removeSession("fw_old_flashes");
		}

		if($session->exists("fw_new_flashes")) {
			$new_flashes = $session->getSession("fw_new_flashes");
			$session->setSession("fw_old_flashes", $new_flashes);
			$session->removeSession("fw_new_flashes");
		}
	}
}