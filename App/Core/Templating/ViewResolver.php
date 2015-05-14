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
		$template = $this->resolveView($this->templateBasePath . $this->layout, ['contents' => $action]);
		ob_start();
		eval("?>" . $template);
		return ob_get_clean();
	}

	public function resolveView($path, $variables) {
		$out = file_get_contents($path);

		foreach($variables as $k => $v) {
			$out = str_replace("[@" . $k . "]", $v, $out);
		}

		return $out;
	}
}