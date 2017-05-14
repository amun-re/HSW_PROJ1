<?php
include_once 'mysql.php';
$error_msg = "";
 
if (isset($_POST['p'], $_POST['pOld'])) {
	//var_dump($_POST);

	$user_id = $_SESSION['user_id'];
	$user_browser = $_SERVER['HTTP_USER_AGENT'];
	
	$password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    if (strlen($password) != 128) {
        // Das gehashte Passwort sollte 128 Zeichen lang sein.
        // Wenn nicht, dann ist etwas sehr seltsames passiert
        $error_msg .= '<p class="error">Invalid password configuration.</p>';
    }
	
	$passwordOld = filter_input(INPUT_POST, 'pOld', FILTER_SANITIZE_STRING);
    if (strlen($password) != 128) {
        // Das gehashte Passwort sollte 128 Zeichen lang sein.
        // Wenn nicht, dann ist etwas sehr seltsames passiert
        $error_msg .= '<p class="error">Invalid password configuration.</p>';
    }
	
	$prep_stmt = "SELECT id, password, salt FROM members WHERE id = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
    if ($stmt) {
        $stmt->bind_param('s', $user_id);
        $stmt->execute();
        $stmt->store_result();
 
        if ($stmt->num_rows == 1) {
			$stmt->bind_result($id, $db_password, $salt);
            $stmt->fetch();
			$hashpassword = hash('sha512', $passwordOld . $salt);
			if($db_password != $hashpassword)
			{
				$error_msg .= '<p class="error">Password incorrect.</p>'.$hashpassword;
			}
        }
    } else {
        $error_msg .= '<p class="error">Database error</p>';
    }
	
	if (empty($error_msg)) {
        // Erstelle ein zufälliges Salt
        $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
 
        // Erstelle saltet Passwort 
        $password = hash('sha512', $password . $random_salt);
 
        // Trage den neuen Benutzer in die Datenbank ein 
        if ($stmt = $mysqli->prepare("UPDATE members SET password = ? , salt = ? WHERE ID = ?")) {
            $stmt->bind_param('ssi', $password, $random_salt, $id);
            // Führe die vorbereitete Anfrage aus.
            if (!$stmt->execute()) {
                //header('Location: ../error.php?err=Registration failure: INSERT');
            }
        }
	}
}

if (isset($_POST['username'], $_POST['email'], $_POST['age'])) {
	var_dump($_POST);

	$user_id = $_SESSION['user_id'];
	$user_browser = $_SERVER['HTTP_USER_AGENT'];
	
	$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // keine gültige E-Mail
        $error_msg .= '<p class="error">The email address you entered is not valid</p>';
    }
	$age = filter_input(INPUT_POST, 'age', FILTER_SANITIZE_NUMBER_INT);
	
	$prep_stmt = "SELECT id, email, age FROM members WHERE email = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
 
        if ($stmt->num_rows == 1) {
			$stmt->bind_result($db_id, $db_email, $db_age);
            $stmt->fetch();
			if($db_id != $user_id)
			{            // Ein Benutzer mit dieser E-Mail-Adresse existiert schon
            $error_msg .= '<p class="error">A user with this email address already exists.</p>';
			}
        }
    } else {
        $error_msg .= '<p class="error">Database error</p>';
    }
	
	if (empty($error_msg)) {
        // Trage den neuen Benutzer in die Datenbank ein 
        if ($stmt = $mysqli->prepare("UPDATE members SET username = ? , email = ? , age = ? WHERE ID = ?")) {
            $stmt->bind_param('ssdi', $username, $email, $age, $user_id);
            // Führe die vorbereitete Anfrage aus.
            if (!$stmt->execute()) {
                //header('Location: ../error.php?err=Registration failure: INSERT');
            }
        }
	}
}
?>