<?php


namespace App\Core\DI;

use App\Core\Request\RequestHandler;
use App\Core\Routing\Router;
use App\Core\Runtime;
use App\Core\Session\Session;
use App\Core\Templating\ViewResolver;

/**
 * System level dependencies and core services
 *
 * Class DependencyInjectionContainer
 * @package App\Core\DI
 */
abstract class DependencyInjectionContainer {

	/**
	 * @var Session
	 */
	protected $session;

	/**
	 * Returns the top most class in object hierarchy
	 *
	 * @return DependencyInjectionContainer
	 */
	abstract protected function getTopInstance();

	/**
	 * Returns a path to template folders
	 *
	 * @return mixed
	 */
	abstract public function getTemplateBasePath();

	public function getRouter() {
		return new Router($this->getTopInstance());
	}

	public function getViewResolver() {
		return new ViewResolver($this);
	}

	public function getRequestHandler() {
		return new RequestHandler($this);
	}

	public function getRuntime() {
		return new Runtime($this->getTopInstance(), $this->getRequestHandler());
	}

	public function getSession() {
		if($this->session === null)
			$this->session = new Session();

		return $this->session;
	}
}