<?php
include_once 'mysql.php';
include_once 'functions.php';
$error_msg = "";

/**
 * Diese Methode erstellt eine Tabelle die alle bereits erstellten Locations anzeigt.
 * @param Array $mysqli
 */
function locationslist($mysqli) {
	if ($stmt = $mysqli->prepare("SELECT id, name, place, plz, max_participants FROM locations WHERE 1"))
	{
		 $stmt->execute();    // Führe die vorbereitete Anfrage aus.
		 $stmt->store_result();
		 		 
		 // hole Variablen von result.
		 $stmt->bind_result($id, $name, $place, $plz, $max_participants);
		echo "<table border=1 name=\"events\" id=\"events\">
		<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Adresse</th>
		<th>PLZ</th>
		<th>Max. Gästeanzahl</th>
		</tr>";
			while ($row = $stmt->fetch()) 
			{
				echo "<tr>";
				echo "<td>" . $id . "</td>";
				echo "<td>" . $name . "</td>";
				echo "<td>" . $place	 . "</td>";
				echo "<td>" . $plz . "</td>";
				echo "<td>" . $max_participants. "</td>";
				echo "</tr>";
			}
			echo "</table>";
		} else {
			echo $mysqli->error;
		}
}

/**
 * Diese Methode erstellt einelocation und fügt sie in die Datenbank ein.
 * @param Array $_POST
 */	
if(isset($_POST['locationname'], $_POST['place'], $_POST['plz'], $_POST['max_participants'])){
	if ($stmt = $mysqli->prepare("INSERT INTO locations (name, place, plz, max_participants) VALUES ( ?, ?, ?, ?)"))
	{
		 $locationname = filter_input(INPUT_POST, 'locationname', FILTER_SANITIZE_STRING);
		 $place = filter_input(INPUT_POST, 'place', FILTER_SANITIZE_STRING);
		 $plz = filter_input(INPUT_POST, 'plz', FILTER_SANITIZE_NUMBER_INT);
		 $max_participants = filter_input(INPUT_POST, 'max_participants', FILTER_SANITIZE_NUMBER_INT);
		 $stmt->bind_param('ssii', $locationname, $place, $plz, $max_participants);  // Bind inputs to parameter.
		 if (! $stmt->execute()) {
               // $error_msg .= '<p class="error">Es ist ein Fehler beim Erstellen der Location aufgetreten.</p>';
			   echo ( "Satement failed: " .$stmt->error . "<br>");
            } else {
				echo 'Location erfolgreich erstellt.';
			}
	} else {
		echo("Statement failed: ". $stmt->error . "<br>");
	}
	
}
?>