<?php 
include("includes.php");

// If the user is already logged in, just redirect him to the index
if(isset($_SESSION["user"])) {
    header("location: index.php");
}

$userSet = !empty($_POST["clientId"]); 
$passSet = !empty($_POST["clientPassword"]);

// If client login post variables are set, attempt log in
if($userSet && $passSet) {
    $clientId = $_POST["clientId"];
    $clientPassword = $_POST["clientPassword"];
    $db->loginClient($clientId, $clientPassword);
} else {
    pushError("<div class=\"container\">");
    if(!$userSet) {
        pushError("
        <div class=\"alert alert-danger alert-dismissible fade show my-1\">
            Client <strong>username</strong> is required 🤦‍.
             <button type=\"button\" class=\"close\" data-dismiss=\"alert\">
                <span>&times;</span>
            </button>
        </div>
        ");
    }
    if(!$passSet) {
        pushError("
        <div class=\"alert alert-danger alert-dismissible fade show my-1\">
           Client <strong>password</strong>  is required 🙈.
             <button type=\"button\" class=\"close\" data-dismiss=\"alert\">
                <span>&times;</span>
            </button>
        </div>
        ");
    }
    pushError("</div>");
    header("location: index.php");
}
?>