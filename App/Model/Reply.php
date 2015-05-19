<?php


namespace App\Model;


class Reply {
	public $id;
	public $text;
	public $author;
	public $postedAt;

	/**
	 * @var Contribution
	 */
	public $parent;
}