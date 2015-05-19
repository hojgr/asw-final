<?php


namespace App\Model;


class Contribution {
	public $id;
	public $text;
	public $author;
	public $postedAt;

	/**
	 * @var Reply[]
	 */
	public $replies;
}