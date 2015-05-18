<?php


namespace App\Core\FlashMessaging;


class FlashMessage {
	private $type;
	private $text;

	public function __construct($type, $text) {
		$this->type = $type;
		$this->text = $text;
	}

	/**
	 * @return mixed
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * @return mixed
	 */
	public function getText()
	{
		return $this->text;
	}
}