<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link href="/css/layout.css" rel="stylesheet" type="text/css">
	<link href="/css/wall.css" rel="stylesheet" type="text/css">

	<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
	<script>
		var loggedIn = <?php echo ($user ? "true" : "false"); ?>;
	</script>
</head>

<body>
	<div class="header">
		<div class="center">
			<a href="/"><div class="logo"></div></a>
			<div class="user_panel">
				<div class="user_panel_center">
					<?php if(!$user): ?>
						<a href="/login">Přihlášení</a>
						|
						<a href="/signup">Registrace</a>
					<?php else: ?>
						<span class="user_panel_username">{@user->username}</span><br />
						<a href="/logout">Logout</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<?php if(isset($flashes)): ?>
		<?php foreach($flashes->getFlashMessages() as $f): ?>
			<div class="flash flash-{@f->getType()}">
				{@f->getText()}
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
	{>@contents}
</body>