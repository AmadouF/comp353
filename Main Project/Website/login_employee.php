<?php 
include("includes.php");

// If the user is already logged in, just redirect him to the index
if(isset($_SESSION["user"])) {
    header("location: index.php");
}

$userSet = !empty($_POST["employeeId"]); 
$passSet = !empty($_POST["employeePassword"]);

// If employee post variables are set, attempt log in
if($userSet && $passSet) {
    $employeeId = $_POST["employeeId"];
    $employeePassword = $_POST["employeePassword"];
    $db->loginEmployee($employeeId, $employeePassword);
} else {
    pushError("<div class=\"container\"><div class=\"row-fluid\">");
    if(!$userSet) {
        pushError("
        <div class=\"alert alert-danger alert-dismissible fade show m-1\">
            Employee <strong>username</strong> is required 🤦.
             <button type=\"button\" class=\"close\" data-dismiss=\"alert\">
                <span>&times;</span>
            </button>
        </div>
        ");
    }
    if(!$passSet) {
        pushError("
        <div class=\"alert alert-danger alert-dismissible fade show m-1\">
            Employee <strong>password</strong> is required 🙈.
             <button type=\"button\" class=\"close\" data-dismiss=\"alert\">
                <span>&times;</span>
            </button>
        </div>
        ");
    }
    pushError("</div></div>");
    header("location: index.php");
}

?>