<?php


namespace App\Services;


use App\Core\Database\Database;
use App\Model\Contribution;
use App\Model\Reply;

class Wall {
	/**
	 * @var Database
	 */
	private $db;

	/**
	 * @param Database $db
	 */
	public function __construct(Database $db) {
		$this->db = $db;
	}

	public function create($user_id, $text) {
		$statement = $this->db->getConnection()->prepare("
		INSERT INTO contributions
		(user_id, text, posted_at) VALUES (:uid, :text, NOW())");

		$statement->bindParam("uid", $user_id);
		$statement->bindParam("text", $text);

		$statement->execute();
	}

	public function getPosts() {
		$contribs = [];

		foreach($this->getContributions() as $post) {
			$c = new Contribution();
			$c->id = $post['id'];
			$c->author = $post['username'];
			$c->postedAt = date("d.m.Y H:i:s", strtotime($post['posted_at']));
			$c->text = $post['text'];

			$c->replies = $this->getReplies($c);

			$contribs[] = $c;
		}

		return $contribs;
	}

	public function getReplies(Contribution $contrib) {
		$replies = [];

		foreach($this->getContributions($contrib->id) as $reply) {
			$r = new Reply();
			$r->id = $reply['id'];
			$r->text = $reply['text'];
			$r->postedAt = date("d.m.Y H:i:s", strtotime($post['posted_at']));
			$r->author = $reply['username'];
			$r->parent = $contrib;

			$replies[] = $r;
		}

		return $replies;
	}

	public function getContributions($post_id = null) {
		$statement = $this->db->getConnection()->prepare(
			"
		SELECT contributions.id, contributions.posted_at, contributions.text, users.username
		FROM contributions
		 LEFT JOIN users ON users.id = contributions.user_id
		WHERE contribution_id " . ($post_id === null ? 'IS NULL' : '= \'' . $post_id . '\'') ."
		ORDER BY id DESC"
		);

		$statement->execute();

		return $statement->fetchAll(\PDO::FETCH_ASSOC);
	}
}