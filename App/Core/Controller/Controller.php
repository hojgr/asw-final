<?php


namespace App\Core\Controller;


use App\Core\FlashMessaging\FlashMessageBag;

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
	protected $flashMessages;

	public function __construct() {
		$this->saveRequestVariables($_GET, $this->_GET);
		$this->saveRequestVariables($_POST, $this->_POST);
		$this->initializeFlashBag();
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
		$this->viewVariables['flashes'] = &$this->flashMessages;
	}

	protected function sendFlashMessage($text, $type = 'success') {
		$this->flashMessages->addMessage($type, $text);
	}
}