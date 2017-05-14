<?php
if($login)
{
?>
 <div id="content">
            
<p class="myEvent">
<?php
if (!empty($error_msg)) {
  echo "<p class=\"content-head\">".$error_msg."</p>";
}
else
{
?>
		<p class="content-head">Veranstaltung <?php echo $name; ?></p>
            <p class="calendar-eventtext"></p>
		<table border="1" name="event" id="event" width="100%">
		<tr>
		<th>Beschreibung</th>
		<td><?php echo $description; ?></td>
		</tr>
		<tr>
		<th>Öffentlich</th>
		<td><?php echo $public; ?></td>
		</tr>
		
		<tr>
		<th>Datum</th>
		<td><?php echo $date; ?></td>
		</tr>
		
		<tr>
		<th>Ersteller</th>
		<td><?php echo $creator; ?></td>
		</tr>
		
		<tr>
		<th>Location</th>		
		<td><?php echo $location; ?></td>
		</tr>
		
		<tr>
		<th>Preis in €</th>
		<td><?php echo $price; ?></td>
		</tr>
		
		<tr>
		<th>Beginn</th>
		<td><?php echo $bdate; ?></td>
		</tr>
		
		<tr>
		<th>Ende</th>
		<td><?php echo $edate; ?></td>
		</tr>
		
		<tr>
		<th>Mindestalter</th>
		<td><?php echo $min_age; ?></td>
		</tr>
		
		
		
<?php getParticpants($mysqli,$event_id); } ?>
</table>
<?php $participants = invite($mysqli,$event_id);
$c =  count ($participants);
//print_r($_POST);
if($c >0) 
{
?>
<form name="invite" action="<?php echo esc_url($_SERVER['PHP_SELF'])."?page=showEvent&event=".$event_id;?>" method="POST">
<select name="inviteUser">
	<?php			
					for($i = 0; $i <$c; $i++)
					{
						if($i==0) 
							echo '<option value="'. $participants[$i][0].'" selected>' . $participants[$i][1] . '</option>';
						else
						echo '<option value="'. $participants[$i][0].'">' . $participants[$i][1] . '</option>';
					}
				?>
</select> <input type="submit" value="Einladen"> <br>
<?php } ?>
</p>	
</div>
<?php
}
?>
