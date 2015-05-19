<?php


namespace App\Controllers;


use App\Core\Controller\Controller;

class BaseController extends Controller {
	public function startup() {

		$user_id = null;

		if($this->dic->getAuth()->getUser() !== null)
			$user_id = $this->dic->getAuth()->getUser()->id;

		$this->dic->getNSA()->log(
			$user_id,
			$_SERVER['REMOTE_ADDR'],
			$_SERVER['REQUEST_URI']
		);
	}
}