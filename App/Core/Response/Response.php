<?php


namespace App\Core\Response;


class Response {
	private $contents;

	public function __construct($html) {
		$this->contents = $html;
	}

	public function render() {
		echo $this->contents;
	}

	/**
	 * @return mixed
	 */
	public function getContents()
	{
		return $this->contents;
	}

	/**
	 * @param mixed $contents
	 */
	public function setContents($contents)
	{
		$this->contents = $contents;
	}

}