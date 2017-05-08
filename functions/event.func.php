<?php
include_once 'mysql.php';
include_once 'functions.php';
print_r ($_POST);
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$todaydate = date("d.m.Y",time());
$error_msg = "";
function myEvents($mysqli) {
	if ($stmt = $mysqli->prepare("SELECT * FROM events WHERE creator = ?"))
	{
		 $stmt->bind_param('s', $user_id);  // Bind "$user_id" to parameter.
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
		}
		else
		{
			echo $mysqli->error;
		}
}
	
function myInvites($mysqli) {
	if ($stmt = $mysqli->prepare("SELECT * FROM participants where user = ?"))
	{
		 $stmt->bind_param('s', $user_id);  // Bind "$user_id" to parameter.
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
if(isset($_POST['eventname'], $_POST['description'], $_POST['publicity'], $_POST['eventdate'], $_POST['location'], $_POST['price'], $_POST['bdate'], $_POST['edate'], $_POST['min_age'])){
	echo "hallo";
	if ($stmt = $mysqli->prepare("INSERT INTO events (name) VALUES ( ?)"))
	{
		 echo "Hallo2";
		 $stmt->bind_param('s', $name);  // Bind inputs to parameter.
		 $stmt->execute();
		 //if (! $stmt->execute()) {
              //  $error_msg .= '<p class="error">Es ist ein Fehler beim Erstellen des Events aufgetreten.</p>';
            //} else {
			//	echo 'Event erfolgreich erstellt.';
			//} 
	}
	
}
?>

, description, public, date, creator, location, price, bdate, edate, min_age)

, ?, ?, ?, ?, ?, ?, ?, ?, ?

ssssddssd

, $description, $public, $eventdate, $username, $location, $price, $bdate, $edate, $min_age