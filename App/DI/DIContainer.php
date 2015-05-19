<?php


namespace App\DI;



use App\Core\DI\DependencyInjectionContainer;
use App\Model\DBUser;
use App\Services\Auth;
use App\Services\NSA;
use App\Services\Wall;

/**
 * Application specific DI container specifying
 * all application-level services
 *
 * Class DIContainer
 * @package App\DI
 */
class DIContainer extends DependencyInjectionContainer {

	protected $db_user;

	protected $auth;

	protected $nsa;

	protected $wall;

	public function getWall() {
		if($this->wall === null)
			$this->wall = new Wall($this->getDatabase());

		return $this->wall;
	}

	public function getNSA() {
		if($this->nsa === null)
			$this->nsa = new NSA($this->getDatabase());

		return $this->nsa;
	}

	public function getAuth() {
		if($this->auth === null)
			$this->auth = new Auth($this->getSession());

		return $this->auth;
	}

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