<?php
	include("includes.php");

	if(isset($_SESSION["user"]) && isset($_POST["amount"])) {
		$db->logHoursForEmployee($_SESSION["user"]["employeeId"], $_POST["amount"]);
	} else {
		pushError("Could not log time");
	}

	header("location: index.php");
?>