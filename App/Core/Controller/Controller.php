<?php


namespace App\Core\Controller;


class Controller {

	protected $_POST;
	protected $_GET;

	public function __construct() {
		$this->saveRequestVariables($_GET, $this->_GET);
		$this->saveRequestVariables($_POST, $this->_POST);
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
}