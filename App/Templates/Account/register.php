<div class="center white_body content_body narrow_body">
	<h1>Registrace</h1>
	<form action="/signupPost" method="POST">
		<table class="table">
			<tr>
				<td><label for="username">Uzivatelske jmeno: </label></td>
				<td><input type="text" id="username" name="username" /></td>
			</tr>
			<tr>
				<td><label for="password">Heslo: </label></td>
				<td><input id="password" type="password" name="password" /></td>
			</tr>
			<tr>
				<td><label for="password_again">Heslo znovu: </label></td>
				<td><input id="password_again" type="password" name="password_again" /></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" class="chamoiseeBtn generalBtn" /></td>
			</tr>
		</table>
	</form>
</div>