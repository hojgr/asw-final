<div class="center white_body content_body narrow_body">
	<h1>Profil</h1>
	<form action="/profileUpdate" method="POST" enctype="multipart/form-data">
		<table class="table">
			<tr>
				<td><label for="title">Jmeno: </label></td>
				<td>
					<input type="text" id="title" name="title" placeholder="Titul" style="width: 50px" />
					<input type="text" id="firstname" name="firstname" placeholder="Jmeno"  style="width: 100px"/>
					<input type="text" id="lastname" name="lastname" placeholder="Prijmeni"  style="width: 100px"/>
				</td>
			</tr>
			<tr>
				<td><label for="city">Mesto: </label></td>
				<td><input type="text" id="city" name="city" /></td>
			</tr>
			<tr>
				<td><label for="psc">PSC: </label></td>
				<td><input type="text" id="psc" name="psc" /></td>
			</tr>
			<tr>
				<td><label for="street">Ulice: </label></td>
				<td><input type="text" id="street" name="street" /></td>
			</tr>
			<tr>
				<td>Avatar: </td>
				<td><input type="file" name="fileToUpload" id="fileToUpload"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" class="chamoiseeBtn generalBtn" value="Ulozit" /></td>
			</tr>
		</table>
	</form>
</div>