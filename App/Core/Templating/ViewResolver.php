<?php


namespace App\Core\Templating;


use App\Core\DI\DependencyInjectionContainer;

class ViewResolver {
	/**
	 * @var DependencyInjectionContainer
	 */
	private $dic;

	private $templateBasePath;

	public $layout = "layout.php";

	public function __construct(DependencyInjectionContainer $dic) {
		$this->dic = $dic;
		$this->templateBasePath = $dic->getTemplateBasePath();
	}

	public function getHTML(View $view) {
		$action = $this->resolveView($this->templateBasePath . $view->getPath() . ".php", $view->getVariables());
		$template = $this->resolveView($this->templateBasePath . $this->layout, $view->getVariables() + ['contents' => $action]);
		$variables = "";

		/**
		 * Serializes and encodes serialized string into base64
		 * Serialization -> object/arrays to string
		 * encoding -> all characters (apostrophes, quotes, ...) to characters and letters, thus
		 * it can be recovered by eval on runtime
		 */
		foreach($view->getVariables() as $k => $v) {
			$variables .= "\$$k=unserialize(base64_decode('" . base64_encode(serialize($v)) . "'));";
		}

		ob_start();
		eval("$variables?>" . $template);
		return ob_get_clean();
	}

	public function resolveView($path, $variables) {
		$out = file_get_contents($path);

		foreach($variables as $k => $v) {
			if(is_array($v)) $v = json_encode($v);
			$out = str_replace("[@" . $k . "]", $v, $out);
		}

		return $out;
	}
}