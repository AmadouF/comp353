<?php
  include("includes.php");
  if(!isLoggedIn() || !getUserType() == "Regular") {
    header("location: index.php");
  }
  displayErrors();

  $user = $db->getRegularEmployeeById($_SESSION["user"]["employeeId"]);
  if($user["contractId"]) {
  $user_contract = $db->getContractByContractId($user["contractId"]);
  $user_client = $db->getClientByContractId($user["contractId"]);
  $user_task = $db->getTaskByEmployeeId($user["employeeId"]);
  $user_manager = $db->getEmployeeById($user["manageBy"]);
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

    <title>Employee</title>
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
      <div class="row text-center">
      	<div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2">
      	    <strong>Department</strong>: <?= $user["department"] ?><br/>
      	    <strong>Insurance</strong>: <?= $user["insurance"] ?><br/>
            <strong>Desired Contract Type</strong>: <?= $user["desiredContractType"] ?><br/>
      	    <br/>
      	</div>
      </div>
      <!-- ./ row -->

      <!-- row -->
      <div class="row py-3">
  	<?php if(isset($user["contractId"])) { ?>
        <!-- col -->
        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2">
          <h3 class="py-3">My Contract</h3>
          <ul class="list-group pb-3">
            <li class="list-group-item active">Client Name: <?=$user_client["clientName"]?></li>
            <li class="list-group-item">Contract ID: <?=$user_contract["contractId"]?></li>
            <li class="list-group-item">Contract Start Date: <?=$user_contract["serviceStartDate"]?></li>
            <li class="list-group-item">Contact number: <?=$user_contract["contactNumber"]?></li>
            <li class="list-group-item">Managed By: <?=$user_manager["firstName"].' '.$user_manager["lastName"]?></li>
            <li class="list-group-item">Initial Amount: <?=$user_contract["initalAmount"]?></li>
            <li class="list-group-item">ACV: <?=$user_contract["annualContractValue"]?></li>
            <li class="list-group-item">Type: <?=$user_contract["contractType"]?></li>
            <li class="list-group-item">Service Type: <?=$user_contract["serviceType"]?></li>
            <li class="list-group-item">Line of Bisiness: <?=$user_contract["lineOfBusiness"]?></li>
            <li class="list-group-item">Satisfaction Score: <?=$user_contract["satisfactionLevel"]?></li>
          </ul>
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 py-3">
          <h4 class="py-2">Deliverables:</h4>
          <ul class="list-group">
          <?php
            $deliverables = $db->getDeliverablesByContractId($user_contract["contractId"]);
            
            while($deliverable = $deliverables->fetch_assoc()) {
              ?>
            <a class="list-group-item list-group-item-action flex-column align-items-start">
              <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1"><?=$deliverable["deliverableIndex"] ?></h5>
              </div>
              <p class="mb-1">Scheduled For: <?=$deliverable["scheduledDate"]?></p>
              <p class="mb-1">Delivered On: <?=$deliverable["deliveredDate"]?></p>
              <p>
              <?php 
                if(!empty($deliverable["scheduledDate"] && !empty($deliverable["deliveredDate"]))) {
                    echo "<b>".(strtotime($deliverable["deliveredDate"]) - strtotime($deliverable["scheduledDate"]))."</b>";
                    echo " days to complete"; 
                }
              ?>
               </p>
			
            </a>
			<br />
              <?php
            }
          ?>
          </ul>          
        </div>
        <h3 class="py-3">Task Working On</h3>
        <ul class="list-group pb-3">
          <li class="list-group-item active"><?=$user_task["taskType"]?></li>
          <li class="list-group-item">Logged In Hours: <?=$user_task["hours"]?></li>
		  <form class="form-group" action="regularLogHours.php" method="POST"> 
				<input type="text" class="form-control" placeholder="hours" name="amount"/>
				<input class="btn btn-primary" value="Add Hours" type="submit" />
		  </form>
        </ul>
		<?php } ?>
          <form action="regular_confirm.php" method="POST">
          <!-- form row -->
          <div class="form-group">
            <label for="dropdown" class="col-form-label"><strong>Wanted Contract Type:</strong></label>
            <select class="form-control col-6" id="dropdown" name="selectedType">
              <option <?= $user["desiredContractType"]=="Premium"?"selected":"" ?>>Premium</option>
              <option <?= $user["desiredContractType"]=="Diamond"?"selected":"" ?>>Diamond</option>
              <option> <?= $user["desiredContractType"]=="Gold"?"selected":"" ?>Gold</option>
              <option <?= $user["desiredContractType"]=="Silver"?"selected":"" ?>>Silver</option>
            </select>
            <label for="dropdown" class="col-form-label"><strong>Insurance Plan:</strong></label>
            <select class="form-control col-6" id="dropdown" name="selectedInsurance">
              <option <?= $user["insurance"]=="Premium"?"selected":"" ?>>Premium</option>
              <option <?= $user["insurance"]=="Silver"?"selected":"" ?>>Silver</option>
              <option <?= $user["insurance"]=="Normal"?"selected":"" ?>>Normal</option>
            </select>
            <input value="Confirm" type="submit" class="my-2 btn btn-outline-primary btn-md">
          </div>
        </form>

      </div>
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
