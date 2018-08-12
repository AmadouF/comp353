<?php
  include("includes.php");
  if(!isLoggedIn() || !getUserType() == "Admin") {
    header("location: index.php");
  }
  // print_r($_SESSION); // DEBUGGER
  $clientId =  $_GET['clientId']; // get the client Id from the url
  $client = $db->getClientByClientId($clientId);
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="style.css"/>
    <!-- Custom Script -->
    <script type="text/javascript" src="script.js"></script>

    <title>Contract</title>
  </head>
  <body>
    <!-- container -->
    <div class="container pb-5">

      <!-- nav -->
      <?php
        include("nav_bar.php");
      ?>
      <!-- ./nav -->

      <!-- row -->
      <div class="row py-3">
        <!-- col -->
        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 py-3 text-center">
          <h1 class="text-center"><?= $client['clientName']?></h1>
        </div>
        <!-- ./ col -->

        <!-- col -->
        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2">
          <? // print_r($client); // DEBUGGER ?>
          <ul class="list-group">
            <li class="d-flex w-100 justify-content-between list-group-item">
              <h5 class="mb-1"><?= $client['clientName'] ?></h5>
            </li>
            <li class="list-group-item">
              Representative: 
              <?= $client['repFirstName'] ?>
              <?=$client['repMiddleInital']?>
              <?= $client['repLastName'] ?>
            </li>
            <li class="list-group-item">Email: <?= $client['emailId'] ?> </li>
            <li class="list-group-item">City: <?= $client['city'] ?></li>
            <li class="list-group-item">Province: <?= $client['province']?></li>
            <li class="list-group-item">Postal Code: <?= $client['postalCode']?></li>
            <li class="list-group-item">Password: <?= $client['password']?></li>
          </a>  
        </div> 
        <!-- ./ col -->

        <!-- col -->
        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 py-3 text-center">
          <a href="./" class="btn btn-outline-primary">Back</a>
        </div>
        <!-- ./ col -->
      </div>
      <!-- ./ row -->

    </div>
    <!-- ./ container -->

    <!-- jQuery-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>