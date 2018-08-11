<?php
  include("includes.php");

  if(isset($_POST["assign_regular"])&&isset($_POST["to_task"]))
  {
    $candidate_id = $_POST["assign_regular"];
    $task_type = $_POST["to_task"];
    $manager = $db->getManagerEmployeeById($_SESSION["user"]["employeeId"]);
    // $candidate_id = $db->getIdFromName($candidate_name);
    $candidate = $db->getRegularEmployeeById($candidate_id);
    $candidate_task = $db->getTaskByEmployeeId($candidate_id);
    if($candidate["contractId"]==$manager["contractId"]){
      pushError("
        <div class=\"container\">
          <div class=\"alert alert-danger alert-dismissible fade show my-1\">
              Your target is already on this <strong>contract</strong>.
               <button type=\"button\" class=\"close\" data-dismiss=\"alert\">
                  <span>&times;</span>
              </button>
          </div>
        </div>
      ");
      header("location: manager.php");
    }
    else if($candidate_task["taskType"]==$task_type){
      pushError("
        <div class=\"container\">
          <div class=\"alert alert-danger alert-dismissible fade show my-1\">
              Your target is already on this <strong>task</strong>.
               <button type=\"button\" class=\"close\" data-dismiss=\"alert\">
                  <span>&times;</span>
              </button>
          </div>
        </div>
      ");
      header("location: manager.php");
    }
    else{
      $db->updateRegularContractId($candidate_id, $manager['contractId'], $manager['employeeId']);
      $db->updateRegularTaskType($candidate_id, $task_type);
      pushError("
        <div class=\"container\">
          <div class=\"alert alert-success alert-dismissible fade show my-1\">
              Great success, very nice.<strong>task</strong>.
               <button type=\"button\" class=\"close\" data-dismiss=\"alert\">
                  <span>&times;</span>
              </button>
          </div>
        </div>
      ");
      header("location: manager.php");
    }
  }
  else{
    pushError("SELECTION ERROR");
  }
?>
