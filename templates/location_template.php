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
     
     
     <table class="contenttable">
     <tr>
         <td valign="top"><p class="myEvent"> <?php locationslist($mysqli); ?></p></td>
         <td>&nbsp;&nbsp;&nbsp;</td>
         <td>
         
         <table>
             <form name="newEvent_form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>?page=locations" method="POST">
             <tr valign="baseline">
             <td>Locationname</td>
             <td> <input type="text" name="locationname"></td>
             </tr>
             
             <tr valign="baseline">
             <td>Adresse</td>
             <td> <input type="text" name="place"></td>
             </tr>
             
             <tr valign="baseline">
             <td>Postleitzahl</td>
             <td><input type="number" name="plz"></td>
             </tr>
             
             <tr valign="baseline">
             <td>Max. Gästeanzahl</td>
             <td> <input type="number" name="max_participants"></td>
             </tr>
                 
                  <tr>
             <td><input type="submit" value="Location erstellen">&nbsp;&nbsp;&nbsp;</td>
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