<?php
include("includes.php");

// If the user is already logged in, just redirect him to the index
if(isset($_SESSION["user"])) {
    header("location: /");
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

    <title>Login</title>
  </head>
  <body>
    <!-- container -->
    <div class="container">
      <!-- row -->
      <div class="row py-3">

        <form class="col-12 col-sm-6" action="/login_client.php" method="POST">
          <h2>Client Login</h2>
          <!-- form row -->
          <div class="form-group row">
            <label for="clienid" class="col-sm-2 col-form-label">ID</label>
            <div class="col-sm-10">
              <input name="clientId" type="text" class="form-control" id="clienid" placeholder="12345678">
            </div>
          </div>
          <!-- ./ form row -->

          <!-- ./ row -->
          <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
              <input name="clientPassword" type="password" class="form-control" id="inputPassword" placeholder="Password">
            </div>
          </div>
          <!-- ./ form row -->

          <div class="form-group">
            <input name="login" type="submit" class="btn btn-primary">
            <button class="btn btn-danger">Cancel</button>
          </div>
        </form>

        <form class="col-12 col-sm-6" action="/login_employee.php" method="POST">
          <h2>Employee Login</h2>
          <!-- form row -->
          <div class="form-group row">
            <label for="employeeid" class="col-sm-2 col-form-label">ID</label>
            <div class="col-sm-10">
              <input name="employeeId" type="text" class="form-control" id="employeeid" placeholder="12345678">
            </div>
          </div>
          <!-- ./ form row -->

          <!-- ./ row -->
          <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
              <input name="employeePassword" type="password" class="form-control" id="inputPassword" placeholder="Password">
            </div>
          </div>
          <!-- ./ form row -->

          <div class="form-group">
            <input name="login" type="submit" class="btn btn-primary" />
            <button class="btn btn-danger">Cancel</button>
          </div>
        </form>
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