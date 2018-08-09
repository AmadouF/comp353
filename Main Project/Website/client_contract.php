<?php
  include("includes.php");
  $user = $_SESSION["user"];

  if(!isset($_GET["id"])) {
    pushError("No contract id provided");
    header("location: index.php");
  }

  $contract = $db->GetContractByContractId($_GET["id"]);
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Custom Script -->
    <script type="text/javascript" src="script.js"></script>

    <title>Client</title>
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
      <div class="row py-3 text-center">
        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2">
          <h1>Contract A</h1>
        </div>
      </div>
      <!-- ./ row -->
      
      <!-- row -->
      <div class="row">
        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2">
          <h4>ID: <?=$contract["contractId"]?></h4>
          <span>Contract Date: <?=$contract["serviceStartDate"]?></span>
          <br/>
          <span>Contact number: <?=$contract["contactNumber"]?></span>
          <br/>
          <?php
            $supervisor = $db->getEmployeeById($contract["superviseBy"]);
          ?>
          <span>Supervised By: <?=$supervisor["firstName"]." ".$supervisor["lastName"]?></span>
          <br/>
          <span>Initial Amount: <?=$contract["initalAmount"]?></span>
          <br/>
          <span>ACV: <?=$contract["annualContractValue"]?></span>
          <br/>
          <span>Type: <?=$contract["contractType"]?></span>
          <br/>
          <span>Service Type: <?=$contract["serviceType"]?></span>
          <br/>
          <span>Line of Business:<?=$contract["lineOfBusiness"]?></span>
          <br/>
          <span>Satisfaction Level: <?=$contract["satisfactionLevel"]?></span>
          <br/><br/>

          <h5>Manager on Contract:</h5>
          <?php
            $managers = $db->getManagersByContractId($contract["contractId"]);

            while($manager = $managers->fetch_assoc()) {
                ?>
                <span><?=$manager["firstName"]." ".$manager["lastName"]?> </span>
                <br />
                <?php
            }
          ?>
          <br/>
          <br/>
          <h5>Deliverables:</h5>
          <span>XYZ</a>
          <br/>
          <br/>          

          <!-- form row -->
          <div class="form-group">
            <label for="dropdown" class="col-form-label"><strong>Satisfaction Score:</strong></label>
            <select onchange="setSatisfactionLevel(this, <?=$contract["contractId"]?>)" class="form-control col-4" id="satisfactionLevel">
            <?php
              for($i=0; $i <= 10; $i++) {
                if($contract["satisfactionLevel"] == $i) {
                  echo "<option selected>$i</option>";
                } else {
                  echo "<option>$i</option>";
                }
              }
              ?>
            </select>
            <button class="my-2 btn btn-primary btn-md">Add</button>
          </div>
          <!-- ./ form row -->
        </div>
      </div>
      <!-- ./ row -->
    </div>
    <!-- ./ container -->
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
 
    
     </body>
</html>