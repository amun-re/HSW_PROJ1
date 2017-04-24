﻿<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Registration Form</title>
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script>
        <link rel="stylesheet" href="../css/register_information_style.css"/>
    </head>
    <body style="background-image:linear-gradient(#f9f9f9,#696969 50%, #f9f9f9); min-height:150vh">
		<div style="margin-top:0px; position:absolute; top:0; left:0; height:100%">
			<div style="height:325px;">
				<marquee style="height:300px; margin-top:25px" behavior="alternate"><img src="../img/kitchen300px.jpg"> <img src="../img/congresscenter300px.jpg"> <img src="../img/messe300px.jpg"> <img src="../img/party300px.jpg"> <img src="../img/weihnachtsmarkt300px.jpg"></marquee>
			</div>
			<div style="border: 15px solid transparent; height:100%">
				<div style="background-color:white; height:50%">
					<!-- Anmeldeformular für die Ausgabe, wenn die POST-Variablen nicht gesetzt sind
					oder wenn das Anmelde-Skript einen Fehler verursacht hat. -->
					<h1 style="text-align:center"><u>Register with us!</u></h1>
					<?php
					if (!empty($error_msg)) {
						echo $error_msg;
					}
					?>
					<div style="float:left; margin-left: 10px">
						<form action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="post" name="registration_form">
							<table>
								<tr>
									<td>Username:</td> <td><input type='text' name='username' id='username' /></td>
								</tr>
								<tr>
									<td>Email:</td><td><input type="text" name="email" id="email" /></td>
								</tr>
								<tr>
									<td>Password:</td><td><input type="password" name="password" id="password"/></td>
								</tr>
								<tr>
									<td>Confirm password:</td><td><input type="password" name="confirmpwd" id="confirmpwd" /></td>
								</tr>
								<tr>
									<td></td><td><input type="button" value="Register" style="float:right" onclick="return regformhash(this.form,
														   this.form.username, this.form.email, this.form.password, this.form.confirmpwd);"/></td>
								</tr>
							</table>
						</form>
						<p>Return to the <a href="index.php">login page</a>.</p>
					</div>
					<div id="information-container" style="float:right; margin-right:10px; text-align:left">
						<ul>
							<li>Benutzernamen dürfen nur Ziffern, Groß- und Kleinbuchstaben und Unterstriche enthalten.</li>
							<li>E-Mail-Adressen müssen ein gültiges Format haben.</li>
							<li>Passwörter müssen mindestens sechs Zeichen lang sein.</li>
							<li>Passwörter müssen enthalten:
								<ul>
									<li>mindestens einen Großbuchstaben (A..Z)</li>
									<li>mindestens einen Kleinbuchstabenr (a..z)</li>
									<li>mindestens eine Ziffer (0..9)</li>
								</ul>
							</li>
							<li>Das Passwort und die Bestätigung müssen exakt übereinstimmen.</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
    </body>
</html>