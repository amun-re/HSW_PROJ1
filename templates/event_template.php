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
			<p class="myEvent"> <?php myEvents($mysqli); ?></p>
			<form name="newEvent_form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>?page=profile" method="POST">
			Eventname <input type="text" name="eventname"><br>
			Beschreibung <input type="text" name="description"></input><br>
			Öffentlich <input type="checkbox" name="publicity"></input><br>
			Veranstaltungsdatum <input type="date" name="eventdate"></input><br>
			Location <input type="number" name="location"></input><br>
			Eintrittspreis <input type="number" name="price"></input><br>
			Beginn <input type="datetime-local" name="bdate"></input><br>
			Ende <input type="datetime-local" name="edate"></input><br>
			Mindestalter <input type="number" name="min_age"></input><br>
			
			<input type="button" value="Erstellen" onclick="createEvent(this.form, this.form.eventname, this.form.description, this.form.publicity, this.form.eventdate, this.form.location, this.form.price,
																		this.form.bdate, this.form.edate, this.form.min_age)"><br><br>
		</form>
</div>
<?php
}
?>
