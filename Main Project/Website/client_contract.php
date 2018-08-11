<?php
  include("includes.php");
  $user = $_SESSION["user"];

  if(!isset($_GET["id"])) {
    pushError("No contract id provided");
    header("location: index.php");
  }

  $contract = $db->GetContractByContractId($_GET["id"]);
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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

      <!-- row -->
      <div class="row py-3 text-center">
        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2">
          <h1>Contract <?=$contract["contractId"]?></h1>
        </div>
      </div>
      <!-- ./ row -->
      
      <!-- row -->
      <div class="row">
        <!-- col -->
        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2">
          <ul class="list-group">
            <li class="list-group-item">Contract Date: <?=$contract["serviceStartDate"]?></li>
            <li class="list-group-item">Contact number: <?=$contract["contactNumber"]?></li>
            <?php
              $supervisor = $db->getEmployeeById($contract["superviseBy"]);
              $supervisorOtherContracts = $db->getContractsSupervisedBySalesAssociateById($contract["superviseBy"]);
            ?>
            <li class="list-group-item">Supervisor: <?=$supervisor["firstName"]." ".$supervisor["lastName"]?></li>
            <li class="list-group-item">Also supervising:
            <ul class="list-group pt-3">
              <?php 
                while($otherContract = $supervisorOtherContracts->fetch_assoc()) {
                    echo "<li class=\"list-group-item\"><strong>Contract: ".$otherContract["contractId"]."</strong></li>";
                    echo "<li class=\"list-group-item\">Start Date: ".$otherContract["serviceStartDate"]."</li>";
                    echo "<li class=\"list-group-item\">Satisfaction Level: ".$otherContract["satisfactionLevel"]."</li>";
                }
              ?>
            </ul>
            </li>
            <li class="list-group-item">Initial Amount: <?=$contract["initalAmount"]?></li>
            <li class="list-group-item">ACV: <?=$contract["annualContractValue"]?></li>
            <li class="list-group-item">Type: <?=$contract["contractType"]?></li>
            <li class="list-group-item">Service Type: <?=$contract["serviceType"]?></li>
            <li class="list-group-item">Line of Business:<?=$contract["lineOfBusiness"]?></li>
            <li class="list-group-item">Satisfaction Level: <?=$contract["satisfactionLevel"]?></li>
          </ul>
        </div>
        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 py-3">
          <h4 class="py-2">Manager on Contract:</h4>
          <ul class="list-group">
          <?php
            $managers = $db->getManagersByContractId($contract["contractId"]);

            while($manager = $managers->fetch_assoc()) {
                ?>
                <li class="list-group-item"><?=$manager["firstName"]." ".$manager["lastName"]?> </li>
                <?php
            }
          ?>
          </ul>
        </div>
        <!-- ./ col -->

        <!-- col -->
        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 py-3">
          <h4 class="py-2">Deliverables:</h4>
          <ul class="list-group">
          <?php
            $deliverables = $db->getDeliverablesByContractId($contract["contractId"]);
            
            while($deliverable = $deliverables->fetch_assoc()) {
              ?>
            <a class="list-group-item list-group-item-action flex-column align-items-start">
              <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1"><?=$deliverable["deliverableIndex"] ?></h5>
              </div>
              <p class="mb-1">Scheduled For: <?=$deliverable["scheduledDate"]?></p>
              <p class="mb-1">Delivered On: <?=$deliverable["deliveredDate"]?></p>
            </a>
              <?php
            }
          ?>
          </ul>          
        </div>
        <!-- ./ col -->

        <!-- col -->
        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 py-3">
          <!-- form row -->
          <div class="form-group row-fluid">
            <h4 class="py-2">Satisfaction Score:</h4>
            <select onchange="setSatisfactionLevel(this, <?=$contract["contractId"]?>)" class="form-control col-6" id="satisfactionLevel">
            <?php
              for($i=0; $i <= 10; $i++) {
                if($contract["satisfactionLevel"] == $i) {
                  echo "<option selected>$i</option>";
                } else {
                  echo "<option value=\"$i\">$i</option>";
                }
              }
              ?>
            </select>
          </div>
          <!-- ./ form row -->
          <div class="col text-center">
            <a href="./" class="btn btn-primary">Back</a>
          </div>
        </div>
        <!-- ./ col -->
      </div>
      <!-- ./ row -->
    </div>
    <!-- ./ container -->
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
 
    
     </body>
</html>