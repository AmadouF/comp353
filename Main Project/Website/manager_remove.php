<?php
  include("includes.php");

  if(isset($_POST["remove_regular"]))
  {
    $candidate_id = $_POST["remove_regular"];
    $manager = $db->getManagerEmployeeById($_SESSION["user"]["employeeId"]);
    // $candidate_id = $db->getIdFromName($candidate_name);
    $candidate = $db->getRegularEmployeeById($candidate_id);
    if($candidate["contractId"]!=$manager["contractId"])
    {
      echo "ya dun fucked up a-a-ron";
      pushError("
      <div class=\"alert alert-danger alert-dismissible fade show my-1\">
          Your target is <strong>not</strong> on this contract.
           <button type=\"button\" class=\"close\" data-dismiss=\"alert\">
              <span>&times;</span>
          </button>
      </div>
      ");
      header("location: manager.php");
    }
    else{
      echo "removing";
      $db->removeRegularFromContractById($candidate_id);
      pushError("
      <div class=\"alert alert-success alert-dismissible fade show my-1\">
          Remove Success.
           <button type=\"button\" class=\"close\" data-dismiss=\"alert\">
              <span>&times;</span>
          </button>
      </div>
      ");
      header("location: manager.php");
    }
  }
  else{
    pushError("SELECTION ERROR");
  }
?>
