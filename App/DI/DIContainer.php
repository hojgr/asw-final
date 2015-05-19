<?php


namespace App\DI;



use App\Core\DI\DependencyInjectionContainer;
use App\Model\DBUser;

/**
 * Application specific DI container specifying
 * all application-level services
 *
 * Class DIContainer
 * @package App\DI
 */
class DIContainer extends DependencyInjectionContainer {

	protected $db_user;

	public function getDBUser() {
		if($this->db_user === null)
			$this->db_user = new DBUser($this->getDatabase());

		return $this->db_user;
	}

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

	public function getTemplateBasePath() {
		return APP_PATH . "/Templates/";
	}
}