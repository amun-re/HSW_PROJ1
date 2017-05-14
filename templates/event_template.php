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
     
     <table class="contenttable">
     <tr>
         <td valign="top"><p class="myEvent"> <?php myEvents($mysqli, $_SESSION['user_id']); ?></p></td>
         <td>&nbsp;&nbsp;&nbsp;</td>
         <td>
         <table>
             <form name="newEvent_form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>?page=events" method="POST">
             <tr valign="baseline">
         <td>Eventname</td>
         <td><input type="text" name="eventname"></td>
         </tr>
             
             <tr valign="baseline">
         <td>Beschreibung&nbsp;&nbsp;&nbsp;</td>
         <td><input type="text" name="description"></td>
         </tr>
             
             <tr valign="baseline">
         <td>Öffentlich<br>&nbsp;&nbsp;&nbsp;</td>
         <td><input type="checkbox" name="publicity"></td>
         </tr>
             
             <tr valign="baseline">
         <td>Datum&nbsp;&nbsp;&nbsp;</td>
         <td><input type="date" name="eventdate"></td>
         </tr>
             
             <tr valign="baseline">
         <td>Location<br>&nbsp;&nbsp;&nbsp;</td>
         <td><select name="location">
				<?php $locationList = myLocations($mysqli);
				//print_r ($locationList);
					for($i = 0; $i < count ($locationList); $i++)
					{
						echo '<option>' . $locationList[$i] . '</option>';
					}
				?>
			</select></td>
         </tr>
             
             <tr valign="baseline">
         <td>Eintrittspreis</td>
         <td><input type="number" name="price"></td>
         </tr>
             
             <tr valign="baseline">
         <td>Beginn</td>
         <td><input type="datetime-local" name="bdate"></td>
         </tr>
             
             <tr valign="baseline">
         <td>Ende</td>
         <td><input type="datetime-local" name="edate"></td>
         </tr>
             
             <tr valign="baseline">
         <td>Mindestalter</td>
         <td><input type="number" name="min_age"></td>
         </tr>
             
             <tr valign="baseline">
         <td><input type="submit" value="Erstellen"></td>
         <td></td>
         </tr>
             
             </form>
             </table>
         
         
         </td>
         </tr>
     </table>
     
     
		
</div>
<?php
}
?>
