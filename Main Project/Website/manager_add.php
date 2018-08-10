<?php
  include("includes.php");

  if(isset($_POST["assign_regular"])&&isset($_POST["to_task"]))
  {
    $candidate_name = $_POST["assign_regular"];
    $task_type = $_POST["to_task"];
    $user = $db->getManagerEmployeeById($_SESSION["user"]["employeeId"]);
    $candidate_id = $db->getIdFromName($candidate_name);
    $candidate = $db->getRegularEmployeeById($candidate_id["employeeId"]);
    $candidate_task = $db->getTaskByEmployeeId($candidate_id["employeeId"]);
    if($candidate["contractId"]==$user["contractId"])
    {
      pushError("
      <div class=\"alert alert-danger alert-dismissible fade show my-1\">
          Your target is already on this <strong>contract</strong>.
           <button type=\"button\" class=\"close\" data-dismiss=\"alert\">
              <span>&times;</span>
          </button>
      </div>
      ");
      header("location: manager.php");
    }
    if($candidate_task["taskType"]==$task_type)
    {
      pushError("
      <div class=\"alert alert-danger alert-dismissible fade show my-1\">
          Your target is already on this <strong>task</strong>.
           <button type=\"button\" class=\"close\" data-dismiss=\"alert\">
              <span>&times;</span>
          </button>
      </div>
      ");
      header("location: manager.php");
    }

    $db->updateRegularContractId($candidate_id["employeeId"],$user["contractId"],$user["employeeId"]);
    $db->updateRegularTaskType($candidate_id["employeeId"],$task_type);
    header("location: regular.php");
  }
  else{
    pushError("SELECTION ERROR");
  }
?>
