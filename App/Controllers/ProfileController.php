<?php


namespace App\Controllers;


use App\Core\Response\RedirectResponse;
use App\Core\Response\ViewResponse;

class ProfileController extends BaseController {
	public function index() {
		if(!$this->dic->getAuth()->isAuthed()) {
			$this->sendFlashMessage("Musite byt prihlasen!", "error");
			return $this->respond(new RedirectResponse("/"));
		}

		return $this->respond(new ViewResponse("Profile/index"));
	}
}