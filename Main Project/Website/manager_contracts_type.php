<?php
	include("includes.php");
?>
<html>
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

    <title>Manager</title>
  </head>
  <body>
    <div class="container pb-5">
  <?php include("nav_bar.php")?>
        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2">
        <h3 class="py-3">All Contracts by all clients by category</h3>
			<?php $user_line_of_business = $db->getLinesOfBusiness(); 
          foreach ($user_line_of_business as $line_of_business) {
            echo "<ul class=\"list-group pb-3\">";
			echo "<li class=\"list-group-item active\">$line_of_business[0]</li>";
			$contracts_in_line_of_business = $db->getContractsFromLinesOfBusiness($line_of_business[0]);
            foreach ($contracts_in_line_of_business as $contract)
            {
				$contract_client = $db->getClientByClientId($contract["clientId"]);

              echo "<li class=\"list-group-item\"><form action=\"saleassociate_contract.php\" method=\"GET\">
			  Contract:
              <input type=\"submit\" name=\"contract_ID\" value=\"".$contract["contractId"]."\" class=\"my-2 btn btn-outline-primary btn-md\"></input>
				<br />".$contract_client["city"].", ".$contract_client["province"]."
              </form></li>";
            }
            echo "</ul>";
			  }
	?>
        </div>
		</div>
		</div>
    <!-- jQuery-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		</body>
		</html>