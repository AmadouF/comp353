<?php
  include("includes.php");

  if(isset($_POST["selectedType"])&&isset($_POST["selectedInsurance"]))
  {
    $select_contract_type = $_POST["selectedType"];
    $select_insurance = $_POST["selectedInsurance"];
    $user = $db->getRegularEmployeeById($_SESSION["user"]["employeeId"]);
    if($user["desiredContractType"]===$select_contract_type)
    {
      pushError("
      <div class=\"alert alert-danger alert-dismissible fade show my-1\">
          Your contract type is already <strong>$select_contract_type</strong>.
           <button type=\"button\" class=\"close\" data-dismiss=\"alert\">
              <span>&times;</span>
          </button>
      </div>
      ");
      header("location: regular.php");
    }
    if($user["insurance"]===$select_insurance)
    {
      pushError("
      <div class=\"alert alert-danger alert-dismissible fade show my-1\">
          Your insurance type is already <strong>$select_insurance</strong>.
           <button type=\"button\" class=\"close\" data-dismiss=\"alert\">
              <span>&times;</span>
          </button>
      </div>
      ");
      header("location: regular.php");
    }

    $db->updateRegularDesiredContractType($user["employeeId"],$select_contract_type);
    $db->updateRegularInsurance($user["employeeId"],$select_insurance);
    header("location: regular.php");
  }
  else{
    pushError("SELECTION ERROR");
  }
?>
