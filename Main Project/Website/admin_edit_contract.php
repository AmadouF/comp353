<?php
  include("includes.php");
  if(!isLoggedIn() || !getUserType() == "Admin") {
    header("location: index.php");
  }
  // print_r($_SESSION); // DEBUGGER
  $contractId =  $_GET['contractId']; // get the client Id from the url
  $contract = $db->getContractByContractId($contractId);
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
          <h1 class="text-center">Contract: <?= $contract['contractId']?></h1>
        </div>
        <!-- ./ col -->

        <!-- form -->
        <form 
          class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 py-3" 
          action="edit_contract.php?contractId=<?=$contract['contractId']?>" 
          method="POST">

          <!-- form row -->
          <div class="form-group row">
            <label >Start Date(<small>YYYY-MM-DD</small>)</label>
            <input name="serviceStartDate" type="text" class="form-control" value="<?= $contract['serviceStartDate']?>">
          </div>
          <!-- ./ form row -->
          <!-- form row -->
          <div class="form-group row">
            <label >Contact Number</label>
            <input name="contactNumber" type="text" class="form-control" value="<?= $contract['contactNumber']?>">
          </div>
          <!-- ./ form row -->
          
          <!-- form row -->
          <div class="form-group row">
            <label >ACV</label>
            <input name="annualContractValue" type="text" class="form-control" value="<?= $contract['annualContractValue']?>">
          </div>
          <!-- ./ form row -->

          <!-- form row -->
          <div class="form-group row">
            <label >Initial Amount</label>
            <input name="initalAmount" type="text" class="form-control" value="<?= $contract['initalAmount']?>">
          </div>
          <!-- ./ form row -->

          <!-- form row -->
          <div class="form-group row">
            <label>Service Type</label>
            <select name="serviceType" type="text" class="form-control" value="<?= $contract['serviceType']?>">
              <option value="Cloud">Cloud</option>
              <option value="On-premises">On-premises</option>
            </select>
          </div>
          <!-- ./ form row -->

          <!-- form row -->
          <div class="form-group row">
            <label>Contract Type</label>
            <select name="contractType" type="text" class="form-control" value="<?= $contract['contractType']?>">
              <option value="Premium">Premium</option>
              <option value="Gold">Gold</option>
              <option value="Diamond">Diamond</option>
              <option value="Silver">Silver</option>
            </select>
          </div>
          <!-- ./ form row -->      

          <!-- form row -->
          <div class="form-group row">
            <label>Line Of Business</label>
            <select name="lineOfBusiness" type="text" class="form-control" value="<?= $contract['lineOfBusiness']?>">
              <option value="CloudServices">CloudServices</option>
              <option value="Development">Development</option>
              <option value="Research">Research</option>
            </select>
          </div>
          <!-- ./ form row -->    

          <!-- form row -->
          <div class="form-group row">
            <label>Satisfaction Level</label>
            <select name="satisfactionLevel" type="text" class="form-control" value="<?= $contract['satisfactionLevel']?>">
            <?php
              for($i=0; $i <= 10; $i++) {
                if($contract["satisfactionLevel"] == $i) {
                  echo "<option selected>$i</option>";
                } else {
                  echo "<option value=\"$i\">$i</option>";
                }
              }
              ?>
            </select>
          </div>
          <!-- ./ form row -->    

          <div class="form-group text-center">
            <input value="Save" name="save" type="submit" class="btn btn-outline-primary">
            <a href="<?= "admin_contract.php?contractId=".$contract['contractId'] ?>" class="btn btn-outline-danger">Cancel</a>
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