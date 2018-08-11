<?php 
	include("includes.php");

	if(!isLoggedIn() || !getUserType() == "Manager") {
		header("location: index.php");
	}
	displayErrors();

	$user = $db->getManagerEmployeeById($_SESSION["user"]["employeeId"]);
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

    <title>Manager</title>
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
      <div class="row py-3">

        <!-- col -->
	  
		  <a href="manager_chronological_contracts.php"> </a>

        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2">
          <h3 class="py-3">Contracts Ordered By Date</h3>
          <ul class="list-group pb-3">
		  <?php 
			  $contracts = $db->getAllContractsOrderedByDate();
			  
			  foreach($contracts as $contract) {
				  ?>
					<li class="list-group-item">
						<ul>
							<li class="list-group-item active">Contract ID: <?=$contract["contractId"]?></li>
							<li class="list-group-item">Contract Start Date: <?=$contract["serviceStartDate"]?></li>
							<li class="list-group-item">Contact number: <?=$contract["contactNumber"]?></li>
							<li class="list-group-item">Initial Amount: <?=$contract["initalAmount"]?></li>
							<li class="list-group-item">ACV: <?=$contract["annualContractValue"]?></li>
							<li class="list-group-item">Type: <?=$contract["contractType"]?></li>
							<li class="list-group-item">Service Type: <?=$contract["serviceType"]?></li>
							<li class="list-group-item">Line of Bisiness: <?=$contract["lineOfBusiness"]?></li>
							<li class="list-group-item">Satisfaction Score: <?=$contract["satisfactionLevel"]?></li>
						</ul>
					</li> 
				  <?php
			  }
		  ?>
		  </ul>

          </ul>

          <!-- ./ form to add employee -->
        </div>
        <!-- ./ form row -->
      </div>
      <!-- ./row -->

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
