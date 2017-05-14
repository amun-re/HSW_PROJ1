<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Registration Form</title>
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script>
        <link rel="stylesheet" href="../css/register_information_style.css"/>
    </head>
    <body>
			
				<div id="side_container">
					<!-- Anmeldeformular für die Ausgabe, wenn die POST-Variablen nicht gesetzt sind
					oder wenn das Anmelde-Skript einen Fehler verursacht hat. -->
                    <div id=partyplaner>Register with us!</div>
					<?php
					if (!empty($error_msg)) {
						echo $error_msg;
					}
					?>
                    <table><tr>
                        <td>
                        
					<div >
						<form action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="post" name="registration_form">
							
								<table>
								<tr><td>Username:</td><td><input type='text' name='username' id='username' /> </td> </tr>
								
								
									<tr><td>Email:</td><td><input type="text" name="email" id="email" /></td></tr>
								
								
									<tr><td>Password:</td><td><input type="password" name="password" id="password"/></td></tr>
								
								
								<tr>	<td>Confirm password:</td><td><input type="password" name="confirmpwd" id="confirmpwd" /></td></tr>
								</table>
								
									<input type="button" value="Register" onclick="return regformhash(this.form,
														   this.form.username, this.form.email, this.form.password, this.form.confirmpwd);"/>
                                    
								
						</form>
						<p>Return to the <a href="index.php">login page</a>.</p>
					</div>
                        </td>
                        <td>
                        
					<div>
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
                            
                            </td>
                        </tr></table>
                            
				</div>
    </body>
</html>