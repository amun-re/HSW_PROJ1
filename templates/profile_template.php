<?php
if($login)
{
if (!empty($error_msg)) {
  echo $error_msg;
}
?>
 <div id="content">
            <p class="content-head">Profil <?php echo htmlentities($_SESSION['username']); ?></p>
            <p class="calendar-eventtext"></p>
			
     <table class="contenttable">
     <tr>
         <td> <table class="contenttable">
                   <form name="profile_form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>?page=profile" method="POST">
                    
                    <tr valign="baseline">
                        <td>Benutzername&nbsp;&nbsp;&nbsp;</td>
                        <td><input type="text" name="username" placeholder="<?php if(isset($dataArray["username"])) echo $dataArray["username"] ?>" value="<?php if(isset($dataArray["username"])) echo $dataArray["username"] ?>"></td>
                    </tr>
                    
                    <tr valign="baseline">
                        <td>E-Mail </td>
                        <td><input type="text" name="email" placeholder="<?php if(isset($dataArray["username"])) echo $dataArray["email"] ?>" value="<?php if(isset($dataArray["username"])) echo $dataArray["email"] ?>"></td>
                    </tr>
                    
                    <tr valign="baseline">
                        <td>Alter</td>
                        <td><input type="text" name="age" placeholder="<?php if(isset($dataArray["username"])) echo $dataArray["age"] ?>" value="<?php if(isset($dataArray["username"])) echo $dataArray["age"] ?>"></td>
                    </tr>
                    
                    <tr>
                        <td><input type="button" value="Ändern" onclick="return profileForm(this.form,
																			this.form.username,
																			this.form.email,
																			this.form.age);"></td>
                        <td></td>
                    </tr>
             </form>       
</table></td>
         <td>&nbsp;&nbsp;&nbsp;</td>
         <td><table class="contenttable">
                        <form name="profile_form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>?page=profile" method="POST">
                    <tr valign="baseline">
                        <td>Passwort (aktuell)</td>
                        <td><input type="password" name="password" value=""></td>
                    </tr>
                    
                    <tr valign="baseline">
                        <td>Passwort (Neu)</td>
                        <td><input type="password" name="passwordNew" value=""></td>
                    </tr>
                    
                    <tr valign="baseline">
                        <td>Passwort Bestätigen &nbsp;&nbsp;&nbsp;</td>
                        <td> <input type="password" name="confirmpwd" value=""></td>
                    </tr>
                    <tr>
                        <td><input type="button" value="Passwort ändern" onclick="return profileFormChgPw(this.form,
																			this.form.password,
																			this.form.passwordNew,
																			this.form.confirmpwd);"></td>
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