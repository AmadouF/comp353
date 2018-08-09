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
  $user_tasks = $db->getTaskTypeByContractId($user["contractId"]);
  $empl_and_tasktype_on_contract = $db->getTaskTypeAndEmployeeNameByContractId($user["contractId"]);
  $desired_contract_type = $db->getDesiredContractTypeFromRegular();
  $desired_contract_type_id = $db->getDesiredContractTypeAndIdFromRegular();
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
        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2">
          <h3 class="py-3">My Contract</h3>
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

          <h3 class="py-3">Employees on Contract</h3>
          <ul class="list-group pb-3">
          <?php
            foreach ($user_regularUnder as $key => $val) {
              echo "<li class=\"list-group-item\">$val[0] $val[1]</li>";
            }
          ?>
          </ul>

          <h3 class="py-3">Tasks on Contract</h3>
          <?php
            foreach ($user_tasks as $key => $task) {
              echo "<ul class=\"list-group pb-3\">";
                echo "<li class=\"list-group-item active\">$task[0]</li>";
                foreach ($empl_and_tasktype_on_contract as $key => $val) {
                  if($val[0] == $task[0]){
                    echo "<li class=\"list-group-item\">$val[1] $val[2]</li>";
                  }
                }
              echo "</ul>";
            }
          ?>

        <h3 class="py-3">Candidates List</h3>
        <?php
          foreach ($desired_contract_type as $key=> $desireType)
          {
            echo "<ul class=\"list-group pb-3\">";
            echo "<li class=\"list-group-item active\">$desireType[0]</li>";
            foreach ($desired_contract_type_id as $key=> $val)
            {
              if($val[0]==$desireType[0])
              {
                $temp = $db->getEmployeeById($val[1]);
                echo "<li class=\"list-group-item\">".$temp["firstName"]." ".$temp["lastName"]."</li>";
              }
            }
            echo "</ul>";
          }
        ?>

          <!-- form row -->
          <div class="form-group">
            <label for="dropdown" class="col-form-label"><strong>Assign New Employee:</strong></label>
            <select class="form-control col-6" id="dropdown">
              <option>Oscar</option>
              <option>Dwight</option>
              <option>Big Tuna</option>
            </select>
            <label for="dropdown" class="col-form-label"><strong>To Task:</strong></label>
            <select class="form-control col-6" id="dropdown">
              <option>A</option>
              <option>B</option>
              <option>C</option>
            </select>
            <button class="my-2 btn btn-primary btn-md">Add</button>
          </div>
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
