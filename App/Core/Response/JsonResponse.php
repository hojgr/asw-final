<?php


namespace App\Core\Response;


class JsonResponse {
	private $data;

	public function __construct($data) {
		$this->data = $data;
	}

	public function getJson() {
		return json_encode($this->data);
	}
}