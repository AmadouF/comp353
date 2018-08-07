<?php
include("includes.php");

// If the user is already logged in, just redirect him to the index
if(isset($_SESSION["user"])) {
    header("location: index.php");
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
    <div class="container pt-3 pb-5">
      <!-- row -->
      <h1 class="text-center display-4">Contract Management System</h1>
      <p class="text-center lead">COMP 353 Summer 2018 Final Project</p>
      <div class="row py-2">

        <form class="col-12 col-sm-10 offset-sm-1 col-md-6 offset-md-3" action="login_client.php" method="POST">
          <h2 class="text-center">Client Login</h2>
          <!-- form row -->
          <div class="form-group row">
            <label for="clientId">ID</label>
            <input name="clientId" type="text" class="form-control" id="clienid" placeholder="12345678">
          </div>
          <!-- ./ form row -->

          <!-- ./ row -->
          <div class="form-group row">
            <label for="inputPassword">Password</label>
            <input name="clientPassword" type="password" class="form-control" id="inputPassword" placeholder="Password">
          </div>
          <!-- ./ form row -->

          <div class="form-group text-center">
            <input value="Login" name="login" type="submit" class="btn btn-outline-primary">
            <a class="btn btn-outline-danger" href="./">Cancel</a>
          </div>
        </form>
      </div>
      <!-- ./ row -->

      <!-- row -->
      <div class="row py-2">
        <form class="col-12 col-sm-10 offset-sm-1 col-md-6 offset-md-3" action="login_employee.php" method="POST">
          <h2 class="text-center">Employee Login</h2>
          <!-- form row -->
          <div class="form-group row">
            <label for="employeeId">Employee ID</label>
            <input name="employeeId" type="text" class="form-control" id="employeeid" placeholder="12345678">
          </div>
          <!-- ./ form row -->

          <!-- ./ row -->
          <div class="form-group row">
            <label for="inputPassword">Password</label>
            <input name="employeePassword" type="password" class="form-control" id="inputPassword" placeholder="Password">
          </div>
          <!-- ./ form row -->

          <div class="form-group text-center">
            <input value="Login" name="login" type="submit" class="btn btn-outline-primary" />
            <a class="btn btn-outline-danger" href="./">Cancel</a>
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