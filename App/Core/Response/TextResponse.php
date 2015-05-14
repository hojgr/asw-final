<?php


namespace App\Core\Response;


class TextResponse {
	private $text;

	public function __construct($text) {
		$this->text = $text;
	}

	public function getContents() {
		return $this->text;
	}
}