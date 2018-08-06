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
    <div class="container">

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
        <div class="col-12">
          <h3>My Clients List</h3>
        </div>
      </div>
      <!-- ./ row -->
      
      <!-- row -->
      <div class="table-responsive">
        <table class="table table-bordered table-hover col-12 col-sm-12">
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
              <td>H8N9C9</td>
            </tr>
            <tr>
              <th scope="row">Another Pirate</th>
              <td>Edward Teach</td>
              <td>Nassau</td>
              <td>ON</td>
              <td>H0N3C3</td>
            </tr>
          </tbody>
        </table> 
      </div>
      <!-- ./ row -->
      <a type="button" class="btn btn-outline-primary btn-lg btn-block" href="addclient.html">Create Account For Client</a>
      <br/><br/>
      <div class="col-sm-12">
          <h3>Line of Business</h3>
          <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action active">Development</a>
            <a href="#" class="list-group-item list-group-item-action">contractA</a>
            <a href="#" class="list-group-item list-group-item-action">contractB</a>
            <a href="#" class="list-group-item list-group-item-action">contractC</a>
            <a href="#" class="list-group-item list-group-item-action">contractD</a>
          </div>
          <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action active">Research</a>
            <a href="#" class="list-group-item list-group-item-action">contractE</a>
            <a href="#" class="list-group-item list-group-item-action">contractF</a>
            <a href="#" class="list-group-item list-group-item-action">contractG</a>
            <a href="#" class="list-group-item list-group-item-action">contractH</a>
          </div>
          <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action active">Cloud Service</a>
            <a href="#" class="list-group-item list-group-item-action">contractI</a>
            <a href="#" class="list-group-item list-group-item-action">contractJ</a>
            <a href="#" class="list-group-item list-group-item-action">contractK</a>
            <a href="#" class="list-group-item list-group-item-action">contractL</a>
          </div>
        </div><br/>
        <div row>
          <a type="button" class="btn btn-outline-primary btn-lg btn-block" href="addcontract.html">Start New Contract</a>
        </div><br/><br/>
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