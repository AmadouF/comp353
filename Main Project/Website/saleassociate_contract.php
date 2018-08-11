<?php
  include("includes.php");
  $user = $db->getSalesAssociateEmployeeById($_SESSION["user"]["employeeId"]);
  if (isset($_POST["contract_ID"]))
  {
    $user_contract_id = $_POST["contract_ID"];
	$user_contract = $db->getContractByContractId($user_contract_id);

	$contract_client = $db->getClientByClientId($user_contract["clientId"]);
  }
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

      <!-- row -->
      <div class="row text-center">
      	<div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2">
      	    <h1>Contract <?= $user_contract_id?></h1>
      	    <span><strong>Client ID</strong>: <?= $user_contract["clientId"] ?></span><br/>
      	    <span><strong>Supervisor ID</strong>: <?= $user_contract["superviseBy"] ?></span>
      	    <br/>
      	</div>
      </div>
      <!-- ./ row -->


      <!-- row -->
      <div class="row py-3">

        <!-- col -->
        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2">
          <h3 class="py-3">Contract Details</h3>
          <ul class="list-group pb-3">
            <li class="list-group-item active">Contact Number: <?=$user_contract["contactNumber"]?></li>
            <li class="list-group-item">Initial Amount: <?=$user_contract["initalAmount"]?></li>
            <li class="list-group-item">ACV: <?=$user_contract["annualContractValue"]?></li>
            <li class="list-group-item">Contract Type: <?=$user_contract["contractType"]?></li>
            <li class="list-group-item">Service Type: <?=$user_contract["serviceType"]?></li>
            <li class="list-group-item">Line of Business: <?=$user_contract["lineOfBusiness"]?></li>
            <li class="list-group-item">Service Start Date: <?=$user_contract["serviceStartDate"]?></li>
            <li class="list-group-item">Satisfaction Score: <?=$user_contract["satisfactionLevel"]?></li>
            <li class="list-group-item">Location: <?=$contract_client["city"].", ".$contract_client["province"]?></li>
          </ul>

            <a href="./" class="btn btn-outline-primary">Back</a>
        </div>
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
