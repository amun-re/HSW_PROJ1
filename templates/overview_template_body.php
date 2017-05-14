 <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Willkommen <?php echo htmlentities($_SESSION['username']); ?>!</a>
          </div>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="?page=overview">home</a></li>
              <li><a href="?page=profile">profil</a></li>
              <li><a href="?page=locations">locations</a></li>
              <li><a href="?page=events">veranstaltung erstellen</a></li>
              <li><a href="?page=invites">einladungen</a></li>
                <li><a href="logout.php">logout</a></li>
            </ul>
          </div>
        </div>
      </nav>




<!--<div id="navi">
            <p>Willkommen <?php /* echo htmlentities($_SESSION['username']); */?>!</p>
            <p>
                This is an example protected page.  To access this page, users
                must be logged in.  At some stage, we'll also check the role of
                the user, so pages will be able to determine the type of user
                authorised to access the page. 
            </p>
  <ul id="navigation">
  <li><a href="?" id="usedSide">Veranstaltungen</a></li>
  <li><a href="?page=profile">Profil</a></li>
  <li><a href="?page=locations">Locations</a></li>
  <li><a href="?page=events">Eigene Veranstaltungen</a></li>
  <li><a href="?page=invites">Meine Einladungen</a></li>
  <li><a href="logout.php">Logout</a></li>
  </ul>
  <p>
  <b>Nächste Veranstaltungen:</b>
  <p class="nextEvents"> <?php /*nextEvents($mysqli);*/ ?></p>
  </p>
            
</div>-->