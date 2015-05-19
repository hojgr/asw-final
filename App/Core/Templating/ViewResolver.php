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
		$action = $this->resolveView($this->templateBasePath . $view->getPath() . ".php");
		$template = $this->resolveView($this->templateBasePath . $this->layout);
		$variables = "";

		$view->setVariable("contents", $action);

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

	public function resolveView($path) {
		$out = file_get_contents($path);

		$out = preg_replace('/\[@([^\]]+)\]/', '<?php echo \$$1; ?>', $out);

		return $out;
	}
}