 <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="?page=overview">Willkommen <?php echo htmlentities($_SESSION['username']); ?>!</a>
          </div>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="?page=overview">home</a></li>
              <li><a href="?page=profile">profil</a></li>
              <li><a href="?page=locations">locations</a></li>
              <li><a href="?page=events">veranstaltung erstellen</a></li>
              <li><a href="?page=invites">einladungen</a></li>
                <li><a href="logout.php">logout</a></li>
            </ul>
          </div>
        </div>
      </nav>



