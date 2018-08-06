<?php
session_start();
// Returns if a user or client is logged in
function isLoggedIn() {
    return isset($_SESSION["user"]);
}
?>