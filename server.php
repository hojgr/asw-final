<?php

$uri = urldecode(
	parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// provides interface for PHP's built-in webserver
// if file exists, return it 'as-is'
// @see http://php.net/manual/en/features.commandline.webserver.php

if ($uri !== '/' and file_exists(__DIR__.'/public'.$uri))
{
	return false;
}

require_once __DIR__.'/public/index.php';
