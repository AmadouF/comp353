<?php
include("includes.php");

if(!empty($_GET["contractId"] && !empty($_GET["deliverable"]))) {
	$db->setDeliverableDeliveredByContractIdAndDeliverableIndex($_GET["contractId"], $_GET["deliverable"]);
} else { 
	pushError("Invalid deliverable");
}

header("location: client_contract.php?id=".$_GET["contractId"]);
?>