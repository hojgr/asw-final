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
					<a href="#">Prihlasit se</a>
					|
					<a href="#">Zaregistrovat se</a>
				</div>
			</div>
		</div>
	</div>
	<?php if(count($flashes) > 0): ?>
		<div class="flash flash-error">
			Message! Lipsom kdkl asld klad asd asd jlasjl dasjdas wkjebh
		</div>
	<?php endif; ?>
	<?php echo $a; ?>;
	<?php echo $b; ?>;
	[@contents]
</body>