<?php
if($login)
{
if (!empty($error_msg)) {
  echo $error_msg;
}
?>
 <div id="content">
            <p class="content-head">Locations</p>
            <p class="calendar-eventtext"></p>
			<p class="myEvent"> <?php locationslist($mysqli); ?></p>
			<form name="newEvent_form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>?page=locations" method="POST">
			Locationname <input type="text" name="locationname"><br>
			Adresse <input type="text" name="place"></input><br>
			Postleitzahl <input type="number" name="plz"></input><br>
			Max. Gästeanzahl <input type="number" name="max_participants"></input><br>
			
			<input type="submit" value="Location erstellen"><br><br>
		</form>
</div>
<?php
}
?>