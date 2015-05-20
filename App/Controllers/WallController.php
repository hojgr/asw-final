<?php


namespace App\Controllers;


use App\Core\Response\JsonResponse;
use App\Core\Response\TextResponse;

class WallController extends BaseController {
	public function post() {
		$user = $this->dic->getAuth()->getUser();
		$text = $this->getPost("text");

		$this->dic->getWall()->create($user->id, $text);

		return $this->respond(new TextResponse("200 post"));
	}

	public function reply() {
		$user = $this->dic->getAuth()->getUser();
		$text = $this->getPost("text");
		$parent = $this->getPost('parent');
		$this->dic->getWall()->createReply($user->id, $parent, $text);

		return $this->respond(new TextResponse("200 reply"));
	}

	public function getPosts() {
		return $this->respond(new JsonResponse($this->dic->getWall()->getPosts()));
	}

}