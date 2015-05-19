<?php


namespace App\Core;


use App\Core\DI\DependencyInjectionContainer;
use App\Core\Request\Request;
use App\Core\Request\RequestHandler;
use App\Core\Routing\Router;

/**
 * Class that instantiates everything necessary for runtime
 *
 * Class Runtime
 * @package App\Core
 */
class Runtime {

	/**
	 * @var Router
	 */
	protected $router;

	/**
	 * @var DependencyInjectionContainer
	 */
	private $dic;

	/**
	 * @var string
	 */
	private $route_file;

	/**
	 * @var array
	 */
	private $options;
	/**
	 * @var RequestHandler
	 */
	private $requestHandler;

	/**
	 * @var Request
	 */
	private $requestInstance;

	public function __construct(DependencyInjectionContainer $dic, RequestHandler $rh) {
		$this->dic = $dic;
		$this->requestHandler = $rh;
	}

	/**
	 * @param $config_file
	 * @param array $options
	 */
	public function initialize($config_file, $options = []) {
		error_reporting(E_ALL);
		ini_set('display_errors', 1);

		$this->route_file = $config_file;
		$this->options = $options;

		$this->initializeRouter();
		$this->requestHandler->handle($this->getRequestInstance(), $this->router->getRoute($this->getRequestInstance()));
	}

	/**
	 * Returns an instance of Request
	 *
	 * @return Request
	 */
	public function getRequestInstance() {
		if($this->requestInstance !== null)
			return $this->requestInstance;

		$request = new Request();
		$request->setPath($_SERVER['REQUEST_URI']);
		$request->setMethod($_SERVER['REQUEST_METHOD']);

		$this->requestInstance = $request;

		return $this->requestInstance;
	}

	public function initializeRouter() {
		$router = $this->dic->getRouter();

		$router->setRouteFile($this->route_file);
		$router->initialize();

		$this->router = $router;
	}
}