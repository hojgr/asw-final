<?php


namespace App\Core\FlashMessaging;


class FlashMessageBag {
	protected $flashes = [];

	public function addFlashMessage(FlashMessage $fm) {
		$this->flashes[] = $fm;
	}

	public function getFlashMessages() {
		return $this->flashes;
	}

	public function addMessage($type, $text) {
		$this->addFlashMessage(new FlashMessage($type, $text));
	}
}