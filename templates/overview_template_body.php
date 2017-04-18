<p><font size=30px alilgn=left>VerantaltungsManager</font></p><br>
<div id="navi">
            <p>Willkommen <?php echo htmlentities($_SESSION['username']); ?>!</p>
           <!-- <p>
                This is an example protected page.  To access this page, users
                must be logged in.  At some stage, we'll also check the role of
                the user, so pages will be able to determine the type of user
                authorised to access the page.
            </p> -->
  <div ID="navigation">
    <table>
        <tr>
            <td ID="usedCol"><a href="overview.php">Startseite</a></td></tr>
        <tr>
            <td><a href="events.php">Veranstaltungen</a></td></tr>
        <tr> <td><a href="events.php?eventplan=own">Meine Veranstaltungen</a></td></tr>
        <tr> <td><a href="invites.php">Einladungen</a></td></tr>
         <tr><td><a href="profile.php">Mein Profil</a></td></tr>
         <tr><td><a href="logout.php">Logout</a></td></tr>
    </table>
    </div>
  
  <p>
  <b>Nächste Veranstaltungen:</b>
  </p>
            
</div>