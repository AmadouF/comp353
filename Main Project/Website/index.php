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

        echo "<a href=\"logout.php\">Logout</a>";

        switch($user_type) {
            case "Sales Associate": {
                include("views/salesassociate.html");
            } break;
            case "Manager": {
                include("views/manager.html");
            } break;
            case "Regular": {
                include("views/regular.html");
            } break;
            case "Admin": {
                include("views/admin.html");
            }
            case "Client": {
                include("views/client.html");
            } break;
        }
    } else {
        pushError("Invalid user, no type specified: ".implode(" ", $user));
        header("location: /logout.php");
    }
} else {
    $_SESSION["msg"] = "You must log in first";
    include("views/login.php");
}
?>
