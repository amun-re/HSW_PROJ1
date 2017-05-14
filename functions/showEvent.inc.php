<?php
include_once 'mysql.php';
$error_msg = "";
$event_id;
if (isset($_GET['event'])) 
{
	//var_dump($_GET);

	$user_id = $_SESSION['user_id'];
	$event_id = filter_input(INPUT_GET, 'event', FILTER_SANITIZE_STRING);
	
	$prep_stmt = "SELECT e.id, e.name, description, public, date, m.username, m.id as creator_id, l.name, price, bdate, edate, min_age FROM events as e left join members as m on m.id = e.creator inner join locations as l on e.location = l.id WHERE e.id = ?";
    $stmt = $mysqli->prepare($prep_stmt);
 
    if ($stmt) {
        $stmt->bind_param('s', $event_id);
		 $stmt->execute();    // Führe die vorbereitete Anfrage aus.
		 $stmt->store_result();
		 
		if ($stmt->num_rows == 1)
		{	 
		 // hole Variablen von result.
		 $stmt->bind_result($id, $name, $description, $public, $date, $creator, $creator_id,
							$location, $price, $bdate, $edate, $min_age);
		
			$stmt->fetch();
	   
			if($public == 1)
			$public = "Ja";
			else
			$public = "Nein";
		}
		else
		{
			$error_msg = "Event nicht gefunden";
		}
	}
	else
		{
			$error_msg = $mysqli->error;
		}
}
if(isset($_POST['inviteUser']))
{
  $user_id = filter_input(INPUT_POST, 'inviteUser', FILTER_SANITIZE_STRING);	
  if($event_id != null && $user_id != null)
  {
	  $prep_selstmt = "SELECT event FROM participants WHERE event = ? AND user = ?";
	  $selstmt = $mysqli->prepare($prep_selstmt);
	  $selstmt->bind_param('ii', $event_id, $user_id);
	  $selstmt->execute();
	  $selstmt->store_result();
	   
	  if ($selstmt->num_rows == 0) {
	  
	  $prep_stmt = "INSERT INTO participants (event, user, status) VALUES(?,?,0)";
	  $stmt = $mysqli->prepare($prep_stmt);
	  if($stmt)
	  {
		  $stmt->bind_param('ii', $event_id, $user_id);
		  
		 if(!$stmt->execute())    // Führe die vorbereitete Anfrage aus.
		 {
			 $error_msg = $mysqli->error. " " . $event_id . " ". $user_id ;
		 }
	  }
	  	else
		{
			$error_msg = $mysqli->error;
		}
	}
  }
}


function invite($mysqli,$event)
{
	if ($stmt = $mysqli->prepare("SELECT id, username FROM members WHERE id not in (
								  select m.id
								 from members as m
							    join participants as p
								on p.user = m.id
								where p.event = ?)"))
	{
		 $stmt->bind_param('i', $event);  // Bind "$user_id" to parameter.
		 $stmt->execute();    // Führt die vorbereitete Anfrage aus.
		 $stmt->store_result();
		 $stmt->bind_result($id,$username);
		 
		 $userList = array();
		 for ($i =0;$row = $stmt->fetch();$i++)
				{
					$userList[$i][0] = $id;
					$userList[$i][1] = $username;
				}
		return $userList;
	}
}

function getParticpants($mysqli,$event) {
	
	if ($stmt = $mysqli->prepare("SELECT m.username, p.status FROM participants as p join members as m on m.id = p.user where event = ?"))
	{
		 $stmt->bind_param('i', $event);  // Bind "$user_id" to parameter.
		 $stmt->execute();    // F�hre die vorbereitete Anfrage aus.
		 $stmt->store_result();
		 
		 // hole Variablen von result.
		 $stmt->bind_result($name, $status);
		 if ($stmt->num_rows > 0) {
			 ?>
			 <tr>
		 <td align="center" colspan="2">
		  <b>Teilnehmer<b>
		 </td>
		</tr>
		
		<tr>
		<th>
			Name
	    </th>
		<th>
		  Status
		<th>
		</tr>
		<?php
			 
			while ($row = $stmt->fetch()) 
			{
			echo "<tr>";
			echo "<td>" . $name . "</td>";
			switch($status)
			{
				case 0:
				echo "<td>Eingeladen</td>";
				break;
				case 1:
				echo "<td>Interessiert</td>";
				break;
				case 2:
				echo "<td>Zugesagt</td>";
				break;
				case 3:
				echo "<td>Abgesagt</td>";
				break;
			}
			echo "</tr>";
			}
		 }
		}
		else
		{
			echo $mysqli->error;
		}
}
?>