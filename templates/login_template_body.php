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
		<div style="margin-top:100px; width:680px; height:440px; margin-right:auto; margin-left:auto; background-color:transparent">
			<?php
			include 'kalender_template.php';
			?>
		</div>
		<div style="width:530px; margin-right:auto; margin-left:auto; margin-top:20px; text-align:center; padding:5px; background-image:linear-gradient(#fff,#d3d3d3);">
			<form action="process_login.php" method="post" name="login_form">                      
				Email: <input type="text" name="email" />
				Password: <input type="password" 
								name="password" 
								id="password"/>
				<input type="button" 
					value="Login" 
					onclick="formhash(this.form, this.form.password);" /> 
			</form>
			<p>You are currently logged <?php echo $logged ?>.
			<?php
			if ($logged == 'out'){
				?>
				If you don't have a login, please <a href="register.php">register</a>.</p>
				<?php
			} else {
				?>
				If you are done, please <a href="logout.php">log out</a>.</p>
				<?php
			}
			?>
		</div>
    </body>