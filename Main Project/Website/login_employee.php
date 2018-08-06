<?php 
include("includes.php");

// If the user is already logged in, just redirect him to the index
if(isset($_SESSION["user"])) {
    header("location: /");
}

$userSet = !empty($_POST["employeeId"]); 
$passSet = !empty($_POST["employeePassword"]);

// If employee post variables are set, attempt log in
if($userSet && $passSet) {
    $employeeId = $_POST["employeeId"];
    $employeePassword = $_POST["employeePassword"];
    $db->loginEmployee($employeeId, $employeePassword);
} else {
    if(!$userSet) {
        pushError("Could not login, employee username not set");
    }
    if(!$passSet) {
        pushError("Could not login, employee password not set");
    }

    header("location: /");
}

?>