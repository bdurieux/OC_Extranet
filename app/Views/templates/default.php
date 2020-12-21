<!doctype html>
<html lang="en">
  <head>
    <title><?= $title; ?></title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="viewport-fit=cover, width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" media="screen and (max-width: 600px)" href="css/styles_mobile.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
  </head>
  <body>
    <!-- HEADER   -->
    <header>
      <div id="header1">        
        <a href="index.php">
          <img src="images/gbaf.png" alt="logo GBAF">
        </a>
      </div>
      <div id="header2">
        <div id="header21">
          <div id="header211" class="<?= $headerConnexion; ?>">
            <a href="index.php?p=users.param" class="button btn btn-primary "><i class="fa fa-user"></i></a>
          </div>
          <div id="header212">
            <?= $headerText; ?>
          </div>	
          <div id="header213" class="<?= $headerConnexion; ?>">
            <a href="index.php?p=users.logout" class="button btn btn-danger "><i class="fa fa-sign-out"></i></a>
          </div>
        </div>        		
      </div>
    </header>
    <div class="content" style="padding-top: 30px">
      <?= $content; ?>
    </div>
    <!-- FOOTER   -->
    <footer>
      <p>|<a href="index.php?p=users.chat">Chat</a>
        |<a href="index.php?p=public.legal">Mentions légales</a>|
        <a href="index.php?p=public.contact">Contact</a>|</p>      
    </footer>
</body>
</html>
