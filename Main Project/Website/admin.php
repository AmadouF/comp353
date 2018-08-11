<?php
  include("includes.php");
  if(!isLoggedIn() || !getUserType() == "Admin") {
    header("location: index.php");
  }
  // print_r($_SESSION); // DEBUGGER
  $clients = $db->getAllClients(); 
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

    <title>SaleAssociate</title>
  </head>
  <body>
    <!-- container -->
    <div class="container pb-5">

      <!-- nav -->
      <?php
        include("nav_bar.php");
      ?>
      <!-- ./nav -->

      <?php 
        include("employee_general_info.php");
      ?>
      <!-- row -->
      <div class="row py-5">
        <!-- col -->
        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2">
          <ul class="list-grpup px-0 pb-3">
          <li class="list-group-item"><h3>List of Clients</h3></li>
          <!-- for each  -->
          <?php foreach ($clients as $key => $client){ ?>
            <li class="d-flex w-100 justify-content-between list-group-item">
              <h5 class="mb-1"><?= $client['clientName'] ?></h5>
              <div>
                <a href="<?= "admin_client.php?clientId=".$client['clientId'] ?>" class="btn btn-outline-success btn-sm">View Client</a>
                <span>&nbsp;</span>
                <a href="<?= "admin_contracts.php?clientId=".$client['clientId'] ?>" class="btn btn-outline-primary btn-sm">View Contracts</a>
              </div>
            </li>
          <?php } ?> 
          <!-- ./ for each  -->
          </ul>
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