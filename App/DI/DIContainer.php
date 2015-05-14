<?php


namespace App\DI;



use App\Core\DI\DependencyInjectionContainer;

class DIContainer extends DependencyInjectionContainer {
	public function getConfigFileContents($path_appendix) {
		return file_get_contents($this->getConfigFilePath($path_appendix));
	}

	public function getConfigFilePath($path_appendix) {
		return APP_PATH . "/config/" . $path_appendix;
	}

	/**
	 * Returns the top most class in object hierarchy
	 *
	 * @return DependencyInjectionContainer
	 */
	protected function getTopInstance()
	{
		return $this;
	}
}