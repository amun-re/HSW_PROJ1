<?php
include_once 'mysql.php';
$error_msg = "";
 
if (isset($_GET['event'], $_GET['stat'])) {
	var_dump($_GET);

	$user_id = $_SESSION['user_id'];
	$user_browser = $_SERVER['HTTP_USER_AGENT'];
	
	$event = filter_input(INPUT_GET, 'event', FILTER_SANITIZE_STRING);
	$stat = filter_input(INPUT_GET, 'stat', FILTER_SANITIZE_STRING);
	
	
	$prep_stmt = "SELECT id FROM events WHERE id = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
    if ($stmt) {
        $stmt->bind_param('s', $event);
        $stmt->execute();
        $stmt->store_result();
 
        if ($stmt->num_rows == 1) 
		{
			$prep_stmt = "UPDATE participants SET status = ? WHERE event = ? AND user = ?";
			$stmt = $mysqli->prepare($prep_stmt);
			 if ($stmt) {
				$stmt->bind_param('iii', $stat, $event, $user_id);
				$stmt->execute();
			 }
			 else 
				$error_msg .= '<p class="error">Database error </p>';
        }
    } else {
        $error_msg .= '<p class="error">Database error</p>';
    }
	
	if (empty($error_msg)) {
        // Erstelle ein zufälliges Salt
       //$random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
 
        // Erstelle saltet Passwort 
        //$password = hash('sha512', $password . $random_salt);
 
        // Trage den neuen Benutzer in die Datenbank ein 
        // if ($stmt = $mysqli->prepare("UPDATE members SET password = ? , salt = ? WHERE ID = ?")) {
            // $stmt->bind_param('ssi', $password, $random_salt, $id);
            // // Führe die vorbereitete Anfrage aus.
            // if (!$stmt->execute()) {
                header("Location:".esc_url($_SERVER['PHP_SELF'])."?page=invites");
            // }
        // }
	}
}
?>