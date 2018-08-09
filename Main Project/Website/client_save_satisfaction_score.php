<?php
    include("includes.php");

    if(!isset($_SESSION["user"])) {
        echo "No user;";
        die("No user");
    }

    $user = $_SESSION["user"];

    if($_SESSION["user_type"] != "Client") {
        echo "User is not a client";
        die("User not a client");
    }

    if(isset($_POST["contractId"]) && isset($_POST["satisfactionScore"])) {
        $db->saveContractSatisfactionByContractId($_POST["contractId"], $_POST["satisfactionScore"]);
        echo "saved";
    }
?>