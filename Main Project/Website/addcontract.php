<?php
  include("includes.php");
  $user = $db->getSalesAssociateEmployeeById($_SESSION["user"]["employeeId"]);
  $user_client = $db->getClientsBySalesAssociateId($user["employeeId"]);
  $all_client = $db->getClientsAll();
  $managers = $db->getAllManagers();
  displayErrors();
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

    <title>New Contract</title>
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
      <div class="row pb-4 text-center">
        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2">
          <h1>New Contract</h1>
        </div>
      </div>
      <!-- ./ row -->


      <!-- row -->
      <div class="row pb-3">
        <form class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2" action="saleassociate.php" method="POST">

          <!-- form row -->
          <div class="form-group row">
            <label for="dropdown" class="col-sm-4 col-form-label">Client ID</label>
            <div class="col-sm-8">
              <select class="form-control" id="dropdown" name="client_id">
                <?php
                  foreach ($all_client as $val)
                  {

                    echo "<option>$val[0]</option>";
                  }
                ?>
              </select>
            </div>
          </div>
          <!-- ./ form row -->

          <!-- form row -->
          <div class="form-group row">
            <label for="dropdown" class="col-sm-4 col-form-label">Supervisor ID</label>
            <div class="col-sm-8">
              <select class="form-control" id="dropdown" name="supervisor_id">
                <?php
                  echo "<option>".$user["employeeId"]."</option>";
                ?>
              </select>
            </div>
          </div>
          <!-- ./ form row -->

          <!-- form row -->
          <div class="form-group row">
            <label for="dropdown" class="col-sm-4 col-form-label">Assign Manager On</label>
            <div class="col-sm-8">
              <select class="form-control" id="dropdown" name="manager_on">
                <?php
                  foreach($managers as $manager)
                  {
                    echo "<option>".$manager["firstName"]." ".$manager["lastName"]."</option>";
                  }
                ?>
              </select>
            </div>
          </div>
          <!-- ./ form row -->

          <!-- form row -->
          <div class="form-group row">
            <label for="dropdown" class="col-sm-4 col-form-label">Contract Type</label>
            <div class="col-sm-8">
              <select class="form-control" id="dropdown" name="contract_type">
                <option>Premium</option>
                <option>Diamond</option>
                <option>Gold</option>
                <option>Silver</option>
              </select>
            </div>
          </div>
          <!-- ./ form row -->

          <!-- form row -->
          <div class="form-group row">
            <label for="dropdown" class="col-sm-4 col-form-label">Service Type</label>
            <div class="col-sm-8">
              <select class="form-control" id="dropdown" name="service_type">
                <option>Cloud</option>
                <option>On-Premises</option>
              </select>
            </div>
          </div>
          <!-- ./ form row -->

          <!-- form row -->
          <div class="form-group row">
            <label for="dropdown" class="col-sm-4 col-form-label">Line of Business</label>
            <div class="col-sm-8">
              <select class="form-control" id="dropdown" name="line_of_business">
                <option>CloudServices</option>
                <option>Development</option>
                <option>Research</option>
              </select>
            </div>
          </div>
          <!-- ./ form row -->

          <!-- form row -->
          <div class="form-group row">
            <label for="dropdown" class="col-sm-4 col-form-label">Service Start Date</label>
            <div class="col-sm-8">
              <select class="form-control" id="dropdown" name="service_start_date">
                <?php
                  $datee = date("Y-m-d");
                  echo "<option>$datee</option>";
                ?>
              </select>
            </div>
          </div>
          <!-- ./ form row -->

          <!-- form row -->
          <div class="form-group row">
            <label for="lname" class="col-sm-4 col-form-label">Contact Number</label>
            <div class="col-sm-8">
              <input class="form-control" id="fname" placeholder="Phone Number" name="contact_number">
            </div>
          </div>
          <!-- ./ form row -->

          <!-- form row -->
          <div class="form-group row">
            <label for="lname" class="col-sm-4 col-form-label">Initial Amount</label>
            <div class="col-sm-8">
              <input class="form-control" id="fname" placeholder="lnitial Amount" name="initial_amount">
            </div>
          </div>
          <!-- ./ form row -->

          <!-- form row -->
          <div class="form-group row">
            <label for="lname" class="col-sm-4 col-form-label">ACV</label>
            <div class="col-sm-8">
              <input class="form-control" id="fname" placeholder="Annual Contract Value" name="a_c_v">
            </div>
          </div>
          <!-- ./ form row -->

          <div class="form-group">
            <input value="Submit" type="submit" class="my-2 btn btn-outline-primary btn-md">
            <a href="./" class="btn btn-outline-danger">Cancel</a>
          </div>
        </form>

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
