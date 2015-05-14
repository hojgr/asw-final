<?php


namespace App\Core\DI;

use App\Core\Routing\Router;

/**
 * System level dependencies and core services
 *
 * Class DependencyInjectionContainer
 * @package App\Core\DI
 */
abstract class DependencyInjectionContainer {
	/**
	 * Returns the top most class in object hierarchy
	 *
	 * @return DependencyInjectionContainer
	 */
	abstract protected function getTopInstance();

	public function getRouter() {
		return new Router($this->getTopInstance());
	}
}