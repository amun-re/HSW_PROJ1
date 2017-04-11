<body>
<?php if($showFormular) {?>
<h1>Registrieren</h1>
<form action="?register=1" method="post">
E-Mail:<br>
<input type="email" size="40" maxlength="250" name="email"><br>
 
Passwort:<br>
<input type="password" size="40"  maxlength="250" name="passwort"><br>
 
Passwort wiederholen:<br>
<input type="password" size="40" maxlength="250" name="passwort2"><br><br>
<input type="hidden" name="register" value="true">
<input type="submit" value="Abschicken">
</form>
<?php } else { ?>
<h1>Login</h1>
<form action="" method="post">
E-Mail:<br>
<input type="email" size="40" maxlength="250" name="email"><br>

Passwort:<br>
<input type="password" size="40"  maxlength="250" name="passwort"><br>
<input type="submit" name="submit" value="Login">
<input type="submit" name="submit" value="Registrieren">
</form>
<?php } ?>
<h1>Kalender</h1>
</body>