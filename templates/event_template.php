<?php
if($login)
{
if (!empty($error_msg)) {
  echo $error_msg;
}
?>
 <div id="content">
            <p class="content-head"><?php echo htmlentities($_SESSION['username']); ?>s Events</p>
            <p class="calendar-eventtext"></p>
			<p class="myEvent"> <?php myEvents($mysqli, $_SESSION['user_id']); ?></p>
			<form name="newEvent_form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>?page=events" method="POST">
			Eventname <input type="text" name="eventname"><br>
			Beschreibung <input type="text" name="description"></input><br>
			Öffentlich <input type="checkbox" name="publicity"></input><br>
			Veranstaltungsdatum <input type="date" name="eventdate"></input><br>
			Location <select name="location">
				<?php $locationList = myLocations($mysqli);
				print_r ($locationList);
					for($i = 0; $i < count ($locationList); $i++)
					{
						echo '<option>' . $locationList[$i] . '</option>';
					}
				?>
			</select><br>
			Eintrittspreis <input type="number" name="price"></input><br>
			Beginn <input type="datetime-local" name="bdate"></input><br>
			Ende <input type="datetime-local" name="edate"></input><br>
			Mindestalter <input type="number" name="min_age"></input><br>
			
			<input type="submit" value="Erstellen"><br><br>
		</form>
</div>
<?php
}
?>
