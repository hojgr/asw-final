<?php


namespace App\Core\Response;


use App\Core\Templating\View;

class ViewResponse {
	/**
	 * @var View
	 */
	private $view;

	public function __construct($path, $options = []) {
		$this->view = new View($path, $options);
	}

	public function getView() {
		return $this->view;
	}
}