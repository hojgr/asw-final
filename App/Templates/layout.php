<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link href="/css/layout.css" rel="stylesheet" type="text/css">
	<link href="/css/wall.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div class="header">
		<div class="center">
			<div class="logo"></div>
			<div class="user_panel">
				<div class="user_panel_center">
					<a href="/login">Prihlasit se</a>
					|
					<a href="/signup">Zaregistrovat se</a>
				</div>
			</div>
		</div>
	</div>
	<?php if(isset($flashes)): ?>
		<?php foreach($flashes->getFlashMessages() as $f): ?>
			<div class="flash flash-[@f->getType()]">
				[@f->getText()]
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
	[@contents]
</body>