<?php 
include("includes.php");

displayErrors();

if(isLoggedIn()) {
    $user = $_SESSION["user"];

    // Redirect user to proper page
    
    if(isset($_SESSION["user_type"])) {
        $user_type = $_SESSION["user_type"];
        
        print_r($user);
        echo "<br />".$user_type."<br />";

        switch($user_type) {
            case "Sales Associate": {
                include("salesassociate.php");
            } break;
            case "Manager": {
                include("manager.php");
            } break;
            case "Regular": {
                include("regular.php");
            } break;
            case "Admin": {
                include("admin.php");
            }
            case "Client": {
                include("client.php");
            } break;
        }
    } else {
        pushError("Invalid user, no type specified: ".implode(" ", $user));
        header("location: /logout.php");
    }
} else {
    $_SESSION["msg"] = "You must log in first";
    include("login.php");
}
?>
