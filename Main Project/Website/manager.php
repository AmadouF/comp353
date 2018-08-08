<?php
  include("includes.php");
  if(!isLoggedIn() || !getUserType() == "Manager") {
    header("location: index.php");
  }
  $user = $db->getManagerEmployeeById($_SESSION["user"]["employeeId"]);
  $user_contract = $db->getContractByContractId($user["contractId"]);
  $user_client = $db->getClientByContractId($user["contractId"]);
  $user_supervisor = $db->getEmployeeById($user["superviseBy"]);
  $user_regularUnder = $db->getRegularOnSameContract($user["contractId"]);
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
        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 py-3">
          <h3>My Contract</h3>
        </div>
        <!-- ./ col -->

        <!-- col -->
        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2">
          <ul class="list-group pb-3">
            <li class="list-group-item active">Client Name: <?=$user_client["clientName"]?></li>
            <li class="list-group-item">Contract ID: <?=$user_contract["contractId"]?></li>
            <li class="list-group-item">Contract Start Date: <?=$user_contract["serviceStartDate"]?></li>
            <li class="list-group-item">Contact number: <?=$user_contract["contactNumber"]?></li>
            <li class="list-group-item">Supervised By: <?=$user_supervisor["firstName"].' '.$user_supervisor["lastName"]?></li>
            <li class="list-group-item">Initial Amount: <?=$user_contract["initalAmount"]?></li>
            <li class="list-group-item">ACV: <?=$user_contract["annualContractValue"]?></li>
            <li class="list-group-item">Type: <?=$user_contract["contractType"]?></li>
            <li class="list-group-item">Service Type: <?=$user_contract["serviceType"]?></li>
            <li class="list-group-item">Line of Bisiness: <?=$user_contract["lineOfBusiness"]?></li>
            <li class="list-group-item">Satisfaction Score: <?=$user_contract["satisfactionLevel"]?></li>
          </ul>

          <h5>Employees on Contract:</h5>
          <p>Task asfwef:</p>


          <!-- form row -->
          <div class="form-group">
            <label for="dropdown" class="col-form-label"><strong>Assign New Employee:</strong></label>
            <select class="form-control col-4" id="dropdown">
              <option>Oscar</option>
              <option>Dwight</option>
              <option>Big Tuna</option>
            </select>
            <label for="dropdown" class="col-form-label"><strong>To Task:</strong></label>
            <select class="form-control col-4" id="dropdown">
              <option>A</option>
              <option>B</option>
              <option>C</option>
            </select>
            <button class="my-2 btn btn-primary btn-md">Add</button>
          </div>
        </div>
        <!-- ./col -->

        <!-- col -->
        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2">
          <h3>Candidates List</h3>
          <div class="list-group pb-3">
            <a href="#" class="list-group-item list-group-item-action active">Premium</a>
            <a href="#" class="list-group-item list-group-item-action">Jack</a>
            <a href="#" class="list-group-item list-group-item-action">David</a>
            <a href="#" class="list-group-item list-group-item-action">Bob</a>
            <a href="#" class="list-group-item list-group-item-action">Robin</a>
          </div>
          <div class="list-group pb-3">
            <a href="#" class="list-group-item list-group-item-action active">Diamond</a>
            <a href="#" class="list-group-item list-group-item-action">Dapibus ac facilisis in</a>
            <a href="#" class="list-group-item list-group-item-action">Morbi leo risus</a>
            <a href="#" class="list-group-item list-group-item-action">Porta ac consectetur ac</a>
            <a href="#" class="list-group-item list-group-item-action">Vestibulum at eros</a>
          </div>
          <div class="list-group pb-3">
            <a href="#" class="list-group-item list-group-item-action active">Gold</a>
            <a href="#" class="list-group-item list-group-item-action">Dapibus ac facilisis in</a>
            <a href="#" class="list-group-item list-group-item-action">Morbi leo risus</a>
            <a href="#" class="list-group-item list-group-item-action">Porta ac consectetur ac</a>
            <a href="#" class="list-group-item list-group-item-action">Vestibulum at eros</a>
          </div>
          <div class="list-group pb-3">
            <a href="#" class="list-group-item list-group-item-action active">Silver</a>
            <a href="#" class="list-group-item list-group-item-action">Dapibus ac facilisis in</a>
            <a href="#" class="list-group-item list-group-item-action">Morbi leo risus</a>
            <a href="#" class="list-group-item list-group-item-action">Porta ac consectetur ac</a>
            <a href="#" class="list-group-item list-group-item-action">Vestibulum at eros</a>
          </div>
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
