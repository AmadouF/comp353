<?php
    include("includes.php");

    if(isset($_POST["contractId"])) {
        
        if(isset($_POST["amount"])) {
            $db->addNewPayment($_POST["contractId"], $_POST["amount"]);
        } else {
            pushError("Not contract id");
        }
        header("location: client_contract.php?id=".$_POST["contractId"]);    
    } else {
        pushError("Not contract id");
        header("location: index.php");
    }
?>