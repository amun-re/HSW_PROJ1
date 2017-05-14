<?php
include_once 'functions/mysql.php';
include_once 'functions/functions.php';

sec_session_start();
 
if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>
	<body>
		<?php
		if (isset($_GET['error'])) {
				?><script>alert("Error logging in!");</script><?php
		}
		?>
	
		
		
		<div id="left_container">
            <p id="partyplaner">partyplaner</p>
			<form action="process_login.php" method="post" name="login_form">                      
				Email: <br><input type="text" name="email" />
				Password:<br> <input type="password" 
								name="password" 
								id="password"/>
			<div id="login_button">	<input type="button"
					value="Login" 
					onclick="formhash(this.form, this.form.password);"/> 
                </div>
			</form>
			<p>You are currently logged <?php echo $logged ?>.
			<?php
			if ($logged == 'out'){
				?>
				If you don't have a login, please <a href="register.php">register</a>.</p>
				<?php
			} else {
				?>
				If you are done, please <a href="logout.php">log out</a>.
				<?php
			}
			?>
            <br>
             <a href="http://www.facebook.de"><img src="../img/Facebook.png"></a>
    <a href="http://www.instagram.com"><img src="../img/Instagram.png"></a>
		</div>
        
       
        <?php
			include 'kalender_template.php';
			?>
        
        
    </body>