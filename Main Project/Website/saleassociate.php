<?php

	function checkArrayForEmpty($arr) {
		foreach($arr as $val) {
			if(empty($val)) {
				return false;
			}
		}
		return true;
	}

  include("includes.php");
  if(!isLoggedIn() || !getUserType() == "Sales Associate") {
    header("location: index.php");
  }

  if(isset($_POST["client_password"]))
  {
    if(strlen($_POST["middle_name"])<5){
      if(strlen($_POST["client_password"])<20){
	  if(checkArrayForEmpty([$_POST["client_name"],$_POST["first_name"],$_POST["middle_name"],$_POST["last_name"],$_POST["client_email"],$_POST["client_city"],$_POST["client_province"],$_POST["client_postalcode"],$_POST["client_password"]]))
      {
      echo "<div class=\"alert alert-success alert-dismissible fade show my-1\">
          Client file <strong>SUCCESS</strong> builded.
           <button type=\"button\" class=\"close\" data-dismiss=\"alert\">
              <span>&times;</span>
          </button>
	  </div>";
		  $db->addClient($_POST["client_name"],$_POST["first_name"],$_POST["middle_name"],$_POST["last_name"],$_POST["client_email"],$_POST["client_city"],$_POST["client_province"],$_POST["client_postalcode"],$_POST["client_password"]);
	  } else {
      pushError("<div class=\"alert alert-danger alert-dismissible fade show my-1\">
          Could not create client, a field was left empty.
           <button type=\"button\" class=\"close\" data-dismiss=\"alert\">
              <span>&times;</span>
          </button>
	  </div>"
	  );
				header("location: index.php");
	  }	
	}
    else{
      }
    }
    else{
      echo "<div class=\"alert alert-danger alert-dismissible fade show my-1\">
          Sorry, <strong>middle name</strong> length exceeded.
           <button type=\"button\" class=\"close\" data-dismiss=\"alert\">
              <span>&times;</span>
          </button>
      </div>";
      }
  }

  if((isset($_POST["client_id"]))&&(isset($_POST["supervisor_id"])))
  {
    if((strlen($_POST["contact_number"]))<15)
    {
      echo "<div class=\"alert alert-success alert-dismissible fade show my-1\">
           New contract <strong>SUCCESS</strong> builded.
           <button type=\"button\" class=\"close\" data-dismiss=\"alert\">
              <span>&times;</span>
          </button>
      </div>";

      $db->addContract($_POST["client_id"],$_POST["supervisor_id"],$_POST["contact_number"],$_POST["a_c_v"],$_POST["initial_amount"],$_POST["service_start_date"],$_POST["service_type"],$_POST["contract_type"],$_POST["line_of_business"]);
    }
    else{
      echo "<div class=\"alert alert-danger alert-dismissible fade show my-1\">
          This phone number is not <strong>human</strong> phone number.
           <button type=\"button\" class=\"close\" data-dismiss=\"alert\">
              <span>&times;</span>
          </button>
      </div>";
    }
  }

  if (isset($_POST["manager_on"]))
  {
    $manager_on_id = $db->getEmployeeIdByName($_POST["manager_on"]);
    $db->updateManagerContractIdbyId($manager_on_id["employeeId"]);
  }

  $user = $db->getSalesAssociateEmployeeById($_SESSION["user"]["employeeId"]);
  $user_line_of_business = $db->getLinesOfBusinessBySalesAssociateId($user["employeeId"]);
  $user_client = $db->getClientsBySalesAssociateId($user["employeeId"]);


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

          <h3 class="py-3">My Clients</h3>
          <?php
            if($user_client != 0) {
            foreach ($user_client as $val) {
              echo "<ul class=\"list-group pb-3\">";
                echo "<li class=\"list-group-item active\">Client $val[0]</li>";
                echo "<li class=\"list-group-item\">Client Name: $val[1]</li>";
                echo "<li class=\"list-group-item\">Representive Name: $val[2] $val[3] $val[4]</li>";
                echo "<li class=\"list-group-item\">Email: $val[5]</li>";
                echo "<li class=\"list-group-item\">City: $val[6]</li>";
                echo "<li class=\"list-group-item\">Province: $val[7]</li>";
                echo "<li class=\"list-group-item\">Postal Code: $val[8]</li>";
              echo "</ul>";
            }
          }
          ?>
        <form action="addclient.php">
          <input value="New Client" type="submit" class="my-2 btn btn-outline-primary btn-md">
        </form>

        <h3 class="py-3">Contracts in Line of Business</h3>
        <?php
          if($user_line_of_business != 0) {
          foreach ($user_line_of_business as $line_of_business) {
            echo "<ul class=\"list-group pb-3\">";
            echo "<li class=\"list-group-item active\">$line_of_business[0]</li>";
            $contracts_in_line_of_business = $db->getContractIdFromSalesAssociateIdAndLinesOfBusiness($user["employeeId"],$line_of_business[0]);
            foreach ($contracts_in_line_of_business as $contract)
            {
				$contract_client = $db->getClientByClientId($contract[0]);

			  echo "<li class=\"list-group-item\">
			 Contract: <a class=\"btn btn-outline-primary\" href=\"saleassociate_contract.php?contract_ID=$contract[0]\"> $contract[0]</a> 
			<br /></li>";
            }
            echo "</ul>";
              }
            }
        ?>
        <form action="addcontract.php">
          <input value="New Contract" type="submit" class="my-2 btn btn-outline-primary btn-md">
        </form>

          </div>
        </div>
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
