<?php 
session_start();

if(isset($_SESSION["user"])) {
    $user = $_SESSION["user"];

    // Redirect user to proper page
    
    if(isset($_SESSION["user_type"])) {
        $user_type = $_SESSION["user_type"];
        
        switch($user_type) {
            case "Sales Associate": {

            } break;
            case "Manager": {

            } break;
            case "Employee": {

            } break;
            case "Client": {

            } break;
        }
    }
} else {
    include("login.html");
}
?>