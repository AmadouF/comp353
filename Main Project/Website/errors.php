<?php
if(!isset($_SESSION["errors"])) {
    $_SESSION["errors"] = array();
}

function pushError($err) {
    array_push($_SESSION["errors"], $err);
}

// This will display and clear errors in the session
function displayErrors() {
    if(isset($_SESSION["errors"])) {
        foreach($_SESSION["errors"] as $error) {
            echo "$error <br />";
        }

        $_SESSION["errors"] = array();
    }
}

?>