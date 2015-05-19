<?php


namespace App\Core\Controller;


use App\Core\DI\DependencyInjectionContainer;
use App\Core\FlashMessaging\FlashMessageBag;
use App\Core\Session\Session;
use App\DI\DIContainer;

class Controller {

	protected $_POST;
	protected $_GET;

	/**
	 * @var array
	 */
	public $viewVariables = [];

	/**
	 * @var FlashMessageBag
	 */
	public $flashMessages;

	/**
	 * @var Session
	 */
	protected $session;
	/**
	 * @var DIContainer
	 */
	public $dic;

	public function __construct(DependencyInjectionContainer $dic, Session $session) {
		$this->saveRequestVariables($_GET, $this->_GET);
		$this->saveRequestVariables($_POST, $this->_POST);
		$this->initializeFlashBag();

		$this->session = $session;
		$this->dic = $dic;
	}

	/**
	 * Is called upon controller instantiation
	 */
	public function startup() {

	}

	/**
	 * Can't dynamically construct $_GET
	 * with variable variables.
	 * @see http://php.net/manual/en/language.variables.variable.php
	 *
	 * @param $source
	 * @param $destination
	 * @internal param $type
	 */
	private function saveRequestVariables(&$source, &$destination) {
		$destination = $source;
	}

	protected function getPost($key)
	{
		return $this->_POST[$key];
	}

	protected function getGet($key) {
		return $this->_GET[$key];
	}

	private function initializeFlashBag()
	{
		$this->flashMessages = new FlashMessageBag();
	}

	protected function sendFlashMessage($text, $type = 'success') {
		$this->flashMessages->addMessage($type, $text);
	}

	/**
	 * Packs things up
	 */
	private function pack() {
		$this->session->setSession("fw_new_flashes", $this->flashMessages);
	}

	protected function respond($response) {

		$this->pack();

		return $response;
	}
}