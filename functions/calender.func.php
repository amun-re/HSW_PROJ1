<?php
include_once 'mysql.php';
include_once 'functions.php';
if(isset($_GET['date']) && strlen($_GET['date']) == 10) // && login_check($mysqli) == true)
{
$date = htmlentities($_GET['date']);
$sql = "SELECT * FROM events WHERE date = ?";
if ($stmt = $mysqli->prepare($sql))
{
	 $stmt->bind_param('s', $date);  // Bind "$email" to parameter.
     $stmt->execute();    // Führe die vorbereitete Anfrage aus.
     $stmt->store_result();
	 
	 // hole Variablen von result.
     $stmt->bind_result($id, $name, $description, $public, $date, $creator, 
					    $location, $price, $bdate, $edate, $min_age);
	echo "<table name=\"events\" id=\"events\">
	<tr>
	<th>id</th>
	<th>name</th>
	<th>description</th>
	<th>public</th>
	<th>date</th>
	<th>creator</th>
	<th>location</th>		
	<th>price</th>
	<th>bdate</th>
	<th>edate</th>
	<th>min_age</th>
	</tr>";
		while ($row = $stmt->fetch()) 
		{
		echo "<tr>";
		echo "<td>" . $id . "</td>";
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
}/*
else
{
	echo "Check:" + login_check($mysqli);
}*/

if(isset($_GET['date']) && strlen($_GET['date']) == 7) 
{
	$date = htmlentities($_GET['date']); 
	$sql = "SELECT distinct date FROM events WHERE date LIKE CONCAT(?,'%')";
	if ($stmt = $mysqli->prepare($sql))
	{
		$stmt->bind_param('s', $date);  // Bind "$email" to parameter.
		$stmt->execute();    // Führe die vorbereitete Anfrage aus.
		$stmt->store_result();
		
		$stmt->bind_result($date);
		
		echo "<table name=\"events\" id=\"events\">
	<tr>
	<th>date</th>
	</tr>";
		while ($row = $stmt->fetch()) 
		{
		echo "<tr>";
		echo "<td>" . $date. "</td>";
		echo "</tr>";
		}
	echo "</table>";
	}
}
?>