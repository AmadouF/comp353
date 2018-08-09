<?php
    include("includes.php");

    if(!isset($_SESSION["user"])) {
        exit();
    }

    $user = $_SESSION["user"];

    if($_SESSION["user_type"] != "Client") {
        exit();
    }

    if(!empty($_POST("contractId") && !empty($_POST("satisfactionScore")))) {
        $db->saveContractSatisfactionByContractId($_POST["contractId"], $_POST["satisfactionScore"]);
    }
?>