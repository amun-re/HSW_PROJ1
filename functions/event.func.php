<?php
include_once 'mysql.php';
include_once 'functions.php';
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$todaydate = date("d.m.Y",time());
$error_msg = "";
function myEvents($mysqli, $user_id2) {
	if ($stmt = $mysqli->prepare("SELECT e.id, e.name, description, public, date, m.username, l.name, price, bdate, edate, min_age FROM events as e join members as m on m.id  inner join locations as l on e.location = l.id WHERE m.id = ?"))
	{
		 $stmt->bind_param('s', $user_id2);  // Bind "$username" to parameter.
		 $stmt->execute();    // Führe die vorbereitete Anfrage aus.
		 $stmt->store_result();
		 		 
		 // hole Variablen von result.
		 $stmt->bind_result($id, $name, $description, $public, $date, $creator, 
							$location, $price, $bdate, $edate, $min_age);
		echo "<table border=1 name=\"events\" id=\"events\">
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
				if($public == 0)
				{
					echo "<td>Nein</td>";
				} else {
					echo "<td>Ja</td>";
				}
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

function myLocations($mysqli)
{
	 $locationList = array();
	 if ($stmt = $mysqli->prepare("SELECT name from locations where 1")) {
            $stmt->execute();   // Execute the prepared query.
            $stmt->store_result();
 
				$stmt->bind_result($locationname);
                for ($i =0;$row = $stmt->fetch();$i++)
				{
					$locationList[$i] = $locationname;
				}

				return $locationList;
		}
}

if(isset($_POST['eventname'], $_POST['description'], $_POST['eventdate'], $_POST['location'], $_POST['price'], $_POST['bdate'], $_POST['edate'], $_POST['min_age'])){
    $locationid = '';
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
		 if ($locationstmt = $mysqli->prepare("SELECT id, name from locations where 1"))
		 {
			$locationstmt->execute();   // Execute the prepared query.
            $locationstmt->store_result();
			$locationstmt->bind_result($id, $locationname);
			while($row = $locationstmt->fetch())
				{	
					if($_POST['location']==$locationname)
					{
						$locationid = $id;
					}
				}
		 }
		 $location = $locationid;
		 $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING);
		 $bdate = filter_input(INPUT_POST, 'bdate', FILTER_SANITIZE_STRING);
		 $edate = filter_input(INPUT_POST, 'edate', FILTER_SANITIZE_STRING);
		 $min_age = filter_input(INPUT_POST, 'min_age', FILTER_SANITIZE_STRING);
		 $stmt->bind_param('ssisiiissi', $eventname, $description, $publicity, $eventdate, $user_id, $location, $price, $bdate, $edate, $min_age);  // Bind inputs to parameter.
		 if (! $stmt->execute()) {
                echo("Statement failed: ". $stmt->error . "<br>");
            } else {
				echo 'Event erfolgreich erstellt.';
				if($publicity == 0) {
					if ($stmtMembers = $mysqli->prepare("SELECT id FROM members where age >= ?"))
					{
						 $stmtMembers->bind_param('i', $min_age);  // Bind input to parameter.
						 $stmtMembers->execute();    // Führe die vorbereitete Anfrage aus.
						 $stmtMembers->store_result();
						 
						 // hole Variablen von result.
						 $stmtMembers->bind_result($members);
						 while ($row = $stmtMembers->fetch())
						 {
							 if($stmtEvent = $mysqli->prepare("SELECT MAX(id) FROM events where 1"))
							 {
								 $stmtEvent->execute();    // Führe die vorbereitete Anfrage aus.
								 $stmtEvent->store_result();
								 
								 // hole Variablen von result.
								 $stmtEvent->bind_result($events);
								 if($stmtParticipants = $mysqli->prepare("INSERT INTO participants VALUES (?, ?, 1)"))
								 {
									 $stmtEvent->fetch();
									 $stmtParticipants->bind_param('ii', $events, $members);  // Bind input to parameter.
									 $stmtParticipants->execute();    // Führe die vorbereitete Anfrage aus.
								 }
							 }
						 }
					} 
				} else {
					if ($stmtMembers = $mysqli->prepare("SELECT id FROM members where 1"))
					{
						 $stmtMembers->execute();    // Führe die vorbereitete Anfrage aus.
						 $stmtMembers->store_result();
						 
						 // hole Variablen von result.
						 $stmtMembers->bind_result($members);
						 while ($row = $stmtMembers->fetch())
						 {
							 if($stmtEvent = $mysqli->prepare("SELECT MAX(id) FROM events where 1"))
							 {
								 $stmtEvent->execute();    // Führe die vorbereitete Anfrage aus.
								 $stmtEvent->store_result();
								 
								 // hole Variablen von result.
								 $stmtEvent->bind_result($events);
								 if($stmtParticipants = $mysqli->prepare("INSERT INTO participants VALUES (?, ?, 1)"))
								 {
									 $stmtEvent->fetch();
									 $stmtParticipants->bind_param('ii', $events, $members);  // Bind input to parameter.
									 $stmtParticipants->execute();    // Führe die vorbereitete Anfrage aus.
								 }
							 }
						 }
					}
				}
			}
	} else {
		echo("Statement failed: ". $stmt->error . "<br>");
	}
	
}
?>