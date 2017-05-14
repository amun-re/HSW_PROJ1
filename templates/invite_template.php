<?php
if($login)
{
if (!empty($error_msg)) {
  echo $error_msg;
  print_r($dataArray);
}
?>
 <div id="content">
            <p class="content-head"><?php echo htmlentities($_SESSION['username']); ?>s Einladungen</p>

			<table width="100%">
			<tr>
			<th>Event</th>
			<th>Ersteller</th>
			<th>Begin</th>
			<th>Ende</th>
			<th>Status</th>
			</tr>
			
			<?php foreach($dataArray as $row) { ?>
			
			<tr>
			<td>
			<?php  
			echo "<a href=\"".esc_url($_SERVER['PHP_SELF'])."?page=showEvent&event=".$row[0]."\">".$row[1]."</a><br>";
			?>
			</td>
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