<?php
set_include_path($_SERVER['DOCUMENT_ROOT'].PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT']."/views");
session_start();
// Returns if a user or client is logged in
function isLoggedIn() {
    return isset($_SESSION["user"]);
}

function getUserType() {
    if(isset($_SESSION["user_type"])) {
        return $_SESSION["user_type"];
    }

    return "";
}
?>