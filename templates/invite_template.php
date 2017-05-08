<?php
if($login)
{
if (!empty($error_msg)) {
  echo $error_msg;
}
?>
 <div id="content">
            <p class="content-head"><?php echo htmlentities($_SESSION['username']); ?>s Einladungen</p>
<<<<<<< HEAD
			<table border=1>
			<tr>
			<th>Event</th>
			<th>Ersteller</th>
			<th>Begin</th>
			<th>Ende</th>
			<th>Status</th>
			</tr>
=======
            <p class="calendar-eventtext"></p>
			<p class="myInvites"> <?php myInvites($mysqli, $_SESSION['username']); ?></p>
>>>>>>> origin/master
			
			<?php foreach($dataArray as $row) { ?>
			
			<tr>
			<td><?php echo $row[1] ?></td>
			<td><?php echo $row[2] ?></td>
			<td><?php echo $row[3] ?></td>
			<td><?php echo $row[4] ?></td>
			<td>
			<?php
			switch($row[5])
			{
				case 0:
				echo "<a href=\"".esc_url($_SERVER['PHP_SELF'])."?page=invites&event=".$row[0]."&stat=2\">Zusagen </a><br>";
				echo "<a href=\"".esc_url($_SERVER['PHP_SELF'])."?page=invites&event=".$row[0]."&stat=1\">Interessiert </a><br>";
				echo "<a href=\"".esc_url($_SERVER['PHP_SELF'])."?page=invites&event=".$row[0]."&stat=3\">Absagen</a>";
				break;
				case 1:
				echo "<a href=\"".esc_url($_SERVER['PHP_SELF'])."?page=invites&event=".$row[0]."&stat=2\">Zusagen </a><br>";
				echo "<a href=\"".esc_url($_SERVER['PHP_SELF'])."?page=invites&event=".$row[0]."&stat=3\">Absagen</a>";
				break;
				case 2:
				echo "<a href=\"".esc_url($_SERVER['PHP_SELF'])."?page=invites&event=".$row[0]."&stat=1\">Interessiert </a><br>";
				echo "<a href=\"".esc_url($_SERVER['PHP_SELF'])."?page=invites&event=".$row[0]."&stat=3\">Absagen</a>";
				break;
				case 3:
				echo "<a href=\"".esc_url($_SERVER['PHP_SELF'])."?page=invites&event=".$row[0]."&stat=2\">Zusagen </a><br>";
				echo "<a href=\"".esc_url($_SERVER['PHP_SELF'])."?page=invites&event=".$row[0]."&stat=1\">Interessiert </a><br>";
				break;
			}
			?>
			</td>
			</tr>
			<?php } ?>
			</table>
</div>
<?php
}
?>