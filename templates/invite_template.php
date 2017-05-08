<?php
if($login)
{
if (!empty($error_msg)) {
  echo $error_msg;
}
?>
 <div id="content">
            <p class="content-head"><?php echo htmlentities($_SESSION['username']); ?>s Einladungen</p>
            <p class="calendar-eventtext"></p>
			<p class="myInvites"> <?php myInvites($mysqli); ?></p>
			
</div>
<?php
}
?>