<?php


namespace App\Core\Request;


use App\Core\DI\DependencyInjectionContainer;
use App\Core\FlashMessaging\FlashMessageBag;
use App\Core\Response\RedirectResponse;
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
		$controller = $reflection->newInstance($this->dic, $session);

		/**
		 * @var $response ViewResponse|TextResponse|RedirectResponse
		 */
		$response = call_user_func_array([$controller, $route->getAction()], $route->parseParameters($request->getPath()));

		if($response instanceof TextResponse) {
			echo $response->getContents();
		} elseif($response instanceof RedirectResponse) {
			$this->concatenateFlashes($session);
			header("Location: " . $response->getLocation());
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

	public function concatenateFlashes(Session $session) {
		if($session->exists("fw_old_flashes") && $session->exists("fw_new_flashes")) {
			/**
			 * @var $oldFlashes FlashMessageBag
			 */
			$oldFlashes = $session->getSession("fw_old_flashes");

			$oldFlashes->concat($session->getSession("fw_new_flashes"));

			$session->setSession("fw_old_flashes", $oldFlashes);
		} else if($session->exists("fw_new_flashes")) {
			$session->setSession("fw_old_flashes", $session->getSession("fw_new_flashes"));
		}

		$session->removeSession("fw_new_flashes");
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