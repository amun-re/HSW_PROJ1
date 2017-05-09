<?php
if($login)
{
if (!empty($error_msg)) {
  echo $error_msg;
}
?>
 <div id="content">
            <p class="content-head">Profil <?php echo htmlentities($_SESSION['username']); ?></p>
            <p class="calendar-eventtext"></p>
			<form name="profile_form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>?page=profile" method="POST">
			Benutzername <input type="text" name="username" placeholder="<?php if(isset($dataArray["username"])) echo $dataArray["username"] ?>" value="<?php if(isset($dataArray["username"])) echo $dataArray["username"] ?>"><br>
			E-Mail <input type="text" name="email" placeholder="<?php if(isset($dataArray["username"])) echo $dataArray["email"] ?>" value="<?php if(isset($dataArray["username"])) echo $dataArray["email"] ?>"></input><br>
			Alter <input type="text" name="age" placeholder="<?php if(isset($dataArray["username"])) echo $dataArray["age"] ?>" value="<?php if(isset($dataArray["username"])) echo $dataArray["age"] ?>"></input><br>
			
			<input type="button" value="Ändern" onclick="return profileForm(this.form,
																			this.form.username,
																			this.form.email,
																			this.form.age);"><br><br>
		</form>
		<form name="profile_form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>?page=profile" method="POST">
			Passwort (aktuell)<input type="password" name="password" value=""><br>																
			Passwort (Neu) <input type="password" name="passwordNew" value=""><br>
			Passwort Bestätigen <input type="password" name="confirmpwd" value=""><br>
			<input type="button" value="Passwort ändern" onclick="return profileFormChgPw(this.form,
																			this.form.password,
																			this.form.passwordNew,
																			this.form.confirmpwd);">
		</form>
</div>
<?php
}
?>