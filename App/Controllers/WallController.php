<?php


namespace App\Controllers;


use App\Core\Response\TextResponse;

class WallController extends BaseController {
	public function post() {
		$user = $this->dic->getAuth()->getUser();
		$text = $this->getPost("text");

		$this->dic->getWall()->create($user->id, $text);

		return $this->respond(new TextResponse("200"));
	}
}