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

    <title>New Client</title>
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
        <div class="col-12">
          <h1>New Client</h1>
        </div>
      </div>
      <!-- ./ row -->

      <!-- row -->
      <div class="row pb-3">
        <form class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2" action="saleassociate.php" method="POST">

          <!-- form row -->
          <div class="form-group row">
            <label for="cname" class="col-sm-4 col-form-label">Client Name</label>
            <div class="col-sm-8">
              <input name="client_name" class="form-control" id="cname" placeholder="Inc. Name">
            </div>
          </div>
          <!-- ./ form row -->

          <!-- form row -->
          <div class="form-group row">
            <label for="fname" class="col-sm-4 col-form-label">First Name</label>
            <div class="col-sm-8">
              <input name="first_name"class="form-control" id="fname" placeholder="Representative First Name">
            </div>
          </div>
          <!-- ./ form row -->

          <!-- form row -->
          <div class="form-group row">
            <label for="lname" class="col-sm-4 col-form-label">Last Name</label>
            <div class="col-sm-8">
              <input name="last_name" class="form-control" id="lname" placeholder="Representative Last Name">
            </div>
          </div>
          <!-- ./ form row -->

          <!-- form row -->
          <div class="form-group row">
            <label for="mname" class="col-sm-4 col-form-label">Middle Name</label>
            <div class="col-sm-8">
              <input name="middle_name" class="form-control" id="mname" placeholder="Representative Middle Name">
            </div>
          </div>
          <!-- ./ form row -->

          <!-- form row -->
          <div class="form-group row">
            <label for="staticEmail" class="col-sm-4 col-form-label">Email</label>
            <div class="col-sm-8">
              <input name= "client_email" type="text" class="form-control" id="staticEmail" placeholder="Company Name">
            </div>
          </div>
          <!-- ./ form row -->

          <!-- form row -->
          <div class="form-group row">
            <label for="city" class="col-sm-4 col-form-label">City</label>
            <div class="col-sm-8">
              <input name="client_city" class="form-control" id="city" placeholder="City">
            </div>
          </div>
          <!-- ./ form row -->

          <!-- form row -->
          <div class="form-group row">
            <label for="dropdown" class="col-sm-4 col-form-label">Province</label>
            <div class="col-sm-8">
              <select class="form-control" id="dropdown" name="client_province">
                <option>British Columbia</option>
                <option>Alberta</option>
                <option>Saskatchewan</option>
                <option>Manitoba</option>
                <option>Ontario</option>
                <option>Quebec</option>
                <option>New Brunswick</option>
                <option>Newfoundland</option>
                <option>PEI</option>
              </select>
            </div>
          </div>
          <!-- ./ form row -->

          <!-- form row -->
          <div class="form-group row">
            <label for="city" class="col-sm-4 col-form-label">Postal Code</label>
            <div class="col-sm-8">
              <input name="client_postalcode" class="form-control" id="city" placeholder="Postal Code">
            </div>
          </div>
          <!-- ./ form row -->

          <!-- ./ row -->
          <div class="form-group row">
            <label for="inputPassword" class="col-sm-4 col-form-label">Password</label>
            <div class="col-sm-8">
              <input name="client_password" type="password" class="form-control" id="inputPassword" placeholder="Password">
            </div>
          </div>
          <!-- ./ form row -->

          <div class="form-group">
            <input value="Submit" type="submit" class="my-2 btn btn-outline-primary btn-md">
            <a href="./" class="btn btn-outline-danger">Cancel</a>
          </div>
        </form>
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
