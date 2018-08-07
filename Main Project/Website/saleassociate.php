<?php
  include("includes.php");
  if(!isLoggedIn() || !getUserType() == "Sales Associate") {
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

      <?php
        include("employee_general_info.php");
      ?>

      <!-- row -->
      <div class="row py-3">
        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2">
          <h3>Clients List</h3>
        </div>
      </div>
      <!-- ./ row -->

      <!-- row -->
      <div class="table-responsive">
        <table class="table table-hover table-striped col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2">
          <thead>
            <tr>
              <th scope="col">Name</th>
              <th scope="col">Representative Name</th>
              <th scope="col">City</th>
              <th scope="col">Province</th>
              <th scope="col">Postal Code</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">Pirate</th>
              <td>Jack Sparrow</td>
              <td>Tortuga</td>
              <td>Qc</td>
              <td>H8N 9C9</td>
            </tr>
            <tr>
              <th scope="row">Another Pirate</th>
              <td>Edward Teach</td>
              <td>Nassau</td>
              <td>ON</td>
              <td>H0N 3C3</td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- ./ row -->

      <!-- row -->
      <div class="row pb-3">
        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2">
          <a class="btn btn-outline-primary px-4" href="addclient.php">Create A New <strong>Client Account</strong></a>
        </div>
      </div>
      <!-- ./ row -->

      <!-- row -->
      <div class="row pb-3">
        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2">
          <h3 class="py-3">Line of Business</h3>
          <div class="list-group pb-3">
            <a href="#" class="list-group-item active">Development</a>
            <a href="#" class="list-group-item list-group-item-action">contractA</a>
            <a href="#" class="list-group-item list-group-item-action">contractB</a>
            <a href="#" class="list-group-item list-group-item-action">contractC</a>
            <a href="#" class="list-group-item list-group-item-action">contractD</a>
          </div>
          <div class="list-group pb-3">
            <a href="#" class="list-group-item list-group-item-action active">Research</a>
            <a href="#" class="list-group-item list-group-item-action">contractE</a>
            <a href="#" class="list-group-item list-group-item-action">contractF</a>
            <a href="#" class="list-group-item list-group-item-action">contractG</a>
            <a href="#" class="list-group-item list-group-item-action">contractH</a>
          </div>
          <div class="list-group pb-3">
            <a href="#" class="list-group-item list-group-item-action active">Cloud Service</a>
            <a href="#" class="list-group-item list-group-item-action">contractI</a>
            <a href="#" class="list-group-item list-group-item-action">contractJ</a>
            <a href="#" class="list-group-item list-group-item-action">contractK</a>
            <a href="#" class="list-group-item list-group-item-action">contractL</a>
          </div>
          <a class="btn btn-outline-primary px-4 my-2" href="addcontract.php">Start A New <strong>Contract</strong></a>
        </div>
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
