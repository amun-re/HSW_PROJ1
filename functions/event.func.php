<?php
include_once 'mysql.php';
include_once 'functions.php';
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$todaydate = date("d.m.Y",time());
$error_msg = "";
function myEvents($mysqli, $username2) {
	if ($stmt = $mysqli->prepare("SELECT * FROM events WHERE creator = ?"))
	{
		 $stmt->bind_param('s', $username2);  // Bind "$username" to parameter.
		 $stmt->execute();    // Führe die vorbereitete Anfrage aus.
		 $stmt->store_result();
		 		 
		 // hole Variablen von result.
		 $stmt->bind_result($id, $name, $description, $public, $date, $creator, 
							$location, $price, $bdate, $edate, $min_age);
		echo "<table name=\"events\" id=\"events\">
		<tr>
		<th>Name</th>
		<th>Beschreibung</th>
		<th>Öffentlich</th>
		<th>Datum</th>
		<th>Ersteller</th>
		<th>Location</th>		
		<th>Preis in €</th>
		<th>Beginn</th>
		<th>Ende</th>
		<th>Mindestalter</th>
		</tr>";
			while ($row = $stmt->fetch()) 
			{
				echo "<tr>";
				echo "<td>" . $name . "</td>";
				echo "<td>" . $description	 . "</td>";
				echo "<td>" . $public . "</td>";
				echo "<td>" . $date. "</td>";
				echo "<td>" . $creator. "</td>";
				echo "<td>" . $location. "</td>";
				echo "<td>" . $price. "</td>";
				echo "<td>" . $bdate. "</td>";
				echo "<td>" . $edate. "</td>";
				echo "<td>" . $min_age. "</td>";
				echo "</tr>";
			}
			echo "</table>";
		} else {
			echo $mysqli->error;
		}
}
	
function myInvites($mysqli, $username2) {
	if ($stmt = $mysqli->prepare("SELECT * FROM participants where user = ?"))
	{
		 $stmt->bind_param('s', $username2);  // Bind "$user_id" to parameter.
		 $stmt->execute();    // Führe die vorbereitete Anfrage aus.
		 $stmt->store_result();
		 
		 // hole Variablen von result.
		 $stmt->bind_result($event, $user, $status);
		echo "<table name=\"participants\" id=\"participants\">
		<tr>
		<th>Event</th>
		<th>Status</th>
		</tr>";
			while ($row = $stmt->fetch()) 
			{
			echo "<tr>";
			echo "<td>" . $event . "</td>";
			echo "<td>" . $status	 . "</td>";
			echo "</tr>";
			}
		echo "</table>";
		}
		else
		{
			echo $mysqli->error;
		}
}
if(isset($_POST['eventname'], $_POST['description'], $_POST['eventdate'], $_POST['location'], $_POST['price'], $_POST['bdate'], $_POST['edate'], $_POST['min_age'])){
	if ($stmt = $mysqli->prepare("INSERT INTO events (name, description, public, date, creator, location, price, bdate, edate, min_age) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"))
	{
		 $eventname = filter_input(INPUT_POST, 'eventname', FILTER_SANITIZE_STRING);
		 $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
		 if(!isset($_POST['publicity'])) {
			 $publicity = 0;
		 } else {
			 $publicity = 1;
		 }
		 $eventdate = filter_input(INPUT_POST, 'eventdate', FILTER_SANITIZE_STRING);
		 $location = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_STRING);
		 $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING);
		 $bdate = filter_input(INPUT_POST, 'bdate', FILTER_SANITIZE_STRING);
		 $edate = filter_input(INPUT_POST, 'edate', FILTER_SANITIZE_STRING);
		 $min_age = filter_input(INPUT_POST, 'min_age', FILTER_SANITIZE_STRING);
		 $stmt->bind_param('ssdssddssd', $eventname, $description, $publicity, $eventdate, $username, $location, $price, $bdate, $edate, $min_age);  // Bind inputs to parameter.
		 $stmt->execute();
		 if (! $stmt->execute()) {
                $error_msg .= '<p class="error">Es ist ein Fehler beim Erstellen des Events aufgetreten.</p>';
            } else {
				echo 'Event erfolgreich erstellt.';
			} 
	} else {
		echo("Statement failed: ". $stmt->error . "<br>");
	}
	
}
?>