<?php 
// This file models the data getting passed in from admin_edit_contract.php and manipulates the database.
include("includes.php");
// redirect user to index if not logged in
if(!isLoggedIn() || !getUserType() == "Admin") {
    header("location: index.php");
}

// get all the values passed in by the post request
$contactNumber = $_POST['contactNumber'];
$annualContractValue = $_POST['annualContractValue'];
$initalAmount = $_POST['initalAmount'];
$serviceStartDate = "'".$_POST['serviceStartDate']."'";
$serviceType = "'".$_POST['serviceType']."'";
$contractType = "'".$_POST['contractType']."'";
$lineOfBusiness = "'".$_POST['lineOfBusiness']."'";
$satisfactionLevel = $_POST['satisfactionLevel'];
$contractId = $_GET['contractId'];

// debug some shiznit
echo "contactNumber: ".$contactNumber."<br/>";
echo "annualContractValue: ".$annualContractValue."<br/>";
echo "initalAmount: ".$initalAmount."<br/>";
echo "serviceStartDate: ".$serviceStartDate."<br/>";
echo "serviceType: ".$serviceType."<br/>";
echo "lineOfBusiness: ".$lineOfBusiness."<br/>";
echo "satisfactionLevel: ".$satisfactionLevel."<br/>";
echo "contractId: ".$contractId."<br/>";

//update the DB... hopefully..
$db->updateContract($contactNumber, $annualContractValue, $initalAmount, $serviceStartDate, $serviceType, $contractType, $lineOfBusiness, $satisfactionLevel, $contractId);
header("location: admin_contract.php?contractId=$contractId")
?>
