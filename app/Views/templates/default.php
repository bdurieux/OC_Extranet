<!doctype html>
<html lang="en">
  <head>
    <title><?= $title; ?></title>

    <!-- Custom styles for this template 
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">  
    -->
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" media="screen and (max-width: 600px)" href="css/styles_mobile.css" />
  </head>
  <body>
    <!-- HEADER   -->
    <header>
      <div id="header1">
        <img src="images/gbaf.png" alt="logo GBAF">
      </div>
      <div id="header2">
        <div id="header21">
          <div id="header211">
            <button class="btn btn-primary <?= $connected; ?>"><i class="fa fa-user"></i></button>
          </div>
          <div id="header212"><?= $headerText; ?></div>	
          <div id="header213">
            <button class="btn btn-danger <?= $connected; ?>"><i class="fa fa-sign-out"></i></button>
          </div>
        </div>        		
      </div>
    </header>
    <!-- MAIN   -->
    <main role="main" class="container">

      <div class="" style="padding-top: 100px">
        <?= $content; ?>
      </div>

    </main><!-- /.container -->
    <!-- FOOTER   -->
    <footer>
      <p>|<a href="">Mentions légales</a>|<a href="">Contact</a>|</p>      
    </footer>
</body>
</html>
