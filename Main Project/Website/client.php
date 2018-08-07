<?php
  include("includes.php");
  if(!isLoggedIn() || !getUserType() == "Client") {
    header("location: index.php");
  }

  $user = $_SESSION["user"];
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

    <title>Client</title>
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
        include("client_general_info.php");
      ?>


      <!-- row -->
      <div class="row py-3">
        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2">
          <h3>List of Contracts</h3>
        </div>
      </div>
      <!-- ./ row -->

      <div class="list-group col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2">

        <?php
          $contracts = $db->getContractsByClientId($user["clientId"]);
          if($contracts->num_rows > 0) {
            while($contract = $contracts->fetch_array()) {
              ?>
            <a href="client_contract.php" class="list-group-item list-group-item-action flex-column align-items-start">
              <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1"><?=$contract["contractId"] ?></h5>
                <small><?=$contract["serviceStartDate"]?></small>
              </div>
              <p class="mb-1"><b>Service Type:</b> <?=$contract["serviceType"]?></p>
              <p class="mb-1"><b>Contract Type:</b> <?=$contract["contractType"]?></p>
              <p class="mb-1"><b>Line of Business:</b> <?=$contract["lineOfBusiness"]?></p>

              <small>Satisfaction score <?=$contract["satisfactionLevel"]?></small>
            </a>
              <?php
            }
          }
        ?>
      </div>

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
