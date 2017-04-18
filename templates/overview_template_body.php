<div id="navi">
            <p>Willkommen <?php echo htmlentities($_SESSION['username']); ?>!</p>
            <p>
                This is an example protected page.  To access this page, users
                must be logged in.  At some stage, we'll also check the role of
                the user, so pages will be able to determine the type of user
                authorised to access the page.
            </p>
  <ul>
  <li><a href="profile.php">Profil</a></li>
  <li><a href="events.php">Veranstaltungen</a></li>
  <li><a href="events.php?eventplan=own">Eigene Veranstaltungen</a></li>
  <li><a href="invites.php">Meine Einladungen</a></li>
  <li><a href="logout.php">Logout</a></li>
  </ul>
  <p>
  <b>Nächste Veranstaltungen:</b>
  </p>
            
</div>