<?php


namespace App\Core\Templating;


class View {
	private $path;
	private $variables;

	/**
	 * @param $path
	 * @param $variables
	 */
	public function __construct($path, $variables = []) {
		$this->path = $path;
		$this->variables = $variables;
	}

	/**
	 * @return mixed
	 */
	public function getPath()
	{
		return $this->path;
	}

	/**
	 * @param mixed $path
	 */
	public function setPath($path)
	{
		$this->path = $path;
	}

	/**
	 * @return array
	 */
	public function getVariables()
	{
		return $this->variables;
	}

	/**
	 * @param array $variables
	 */
	public function setVariables($variables)
	{
		$this->variables = $variables;
	}
}