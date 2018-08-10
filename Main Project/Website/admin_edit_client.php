<?php
  include("includes.php");
  if(!isLoggedIn() || !getUserType() == "Admin") {
    header("location: index.php");
  }
  // print_r($_SESSION); // DEBUGGER
  $clientId =  $_GET['clientId']; // get the client Id from the url
  $client = $db->getClientByClientId($clientId);
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

    <title>Contract</title>
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
      <div class="row py-3">
        <!-- col -->
        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 py-3 text-center">
          <h1 class="text-center"><?= $client['clientName']?></h1>
        </div>
        <!-- ./ col -->

        <!-- form -->
        <form 
          class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 py-3" 
          action="edit_client.php?clientId=<?=$client['clientId']?>" 
          method="POST">

          <!-- form row -->
          <div class="form-group row">
            <label >Client name</label>
            <input name="clientName" type="text" class="form-control" value="<?= $client['clientName']?>">
          </div>
          <!-- ./ form row -->
          <!-- form row -->
          <div class="form-group row">
            <label >Representative First Name</label>
            <input name="repFirstName" type="text" class="form-control" value="<?= $client['repFirstName']?>">
          </div>
          <!-- ./ form row -->
          
          <!-- form row -->
          <div class="form-group row">
            <label >Representative Middle Initial</label>
            <input name="repMiddleInital" type="text" class="form-control" value="<?= $client['repMiddleInital']?>">
          </div>
          <!-- ./ form row -->

          <!-- form row -->
          <div class="form-group row">
            <label >Representative Last Name</label>
            <input name="repLastName" type="text" class="form-control" value="<?= $client['repLastName']?>">
          </div>
          <!-- ./ form row -->

          <!-- form row -->
          <div class="form-group row">
            <label>Email</label>
            <input name="emailId" type="text" class="form-control" value="<?= $client['emailId']?>">
          </div>
          <!-- ./ form row -->

          <!-- form row -->
          <div class="form-group row">
            <label>City</label>
            <input name="city" type="text" class="form-control" value="<?= $client['city']?>">
          </div>
          <!-- ./ form row -->      

          <!-- form row -->
          <div class="form-group row">
            <label>Province</label>
            <input name="province" type="text" class="form-control" value="<?= $client['province']?>">
          </div>
          <!-- ./ form row -->    

          <!-- form row -->
          <div class="form-group row">
            <label>Postal Code</label>
            <input name="postalCode" type="text" class="form-control" value="<?= $client['postalCode']?>">
          </div>
          <!-- ./ form row -->    

          <!-- form row -->
          <div class="form-group row">
            <label>Password</label>
            <input name="password" type="text" class="form-control" value="<?= $client['password']?>">
          </div>
          <!-- ./ form row -->             

          <div class="form-group text-center">
            <input value="Save" name="save" type="submit" class="btn btn-outline-primary">
            <a href="<?= "admin_client.php?clientId=".$client['clientId'] ?>" class="btn btn-outline-danger">Cancel</a>
          </div>
        </form>
        <!-- ./ form -->

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