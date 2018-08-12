<?php 
	include("includes.php");

	if(isset($_GET["contractId"])) {
		$db->deleteContractByContractId($_GET["contractId"]);
	}

	if(isset($_GET["clientId"])) {
		header("location: admin_contracts.php?clientId=".$_GET["clientId"]);
	} else {
		header("location: index.php");
	}
?>    