<?php 
// This file models the data getting passed in from admin_edit_client.php and manipulates the database.
include("includes.php");
// redirect user to index if not logged in
if(!isLoggedIn() || !getUserType() == "Admin") {
    header("location: index.php");
}
// get all the values passed in by the post request
$clientName = "'".$_POST['clientName']."'";
$repFirstName = "'".$_POST['repFirstName']."'";
$repMiddleInital = "'".$_POST['repMiddleInital']."'";
$repLastName = "'".$_POST['repLastName']."'";
$emailId = "'".$_POST['emailId']."'";
$city = "'".$_POST['city']."'";
$province = "'".$_POST['province']."'";
$postalCode = "'".$_POST['postalCode']."'";
$password = "'".$_POST['password']."'";
$clientId = $_GET['clientId'];

// debug some shiznit
echo "clientName: ".$clientName."<br/>";
echo "repFirstName: ".$repFirstName."<br/>";
echo "repMiddleInital: ".$repMiddleInital."<br/>";
echo "repLastName: ".$repLastName."<br/>";
echo "emailId: ".$emailId."<br/>";
echo "city: ".$city."<br/>";
echo "province: ".$province."<br/>";
echo "postalCode: ".$postalCode."<br/>";
echo "password: ".$password."<br/>";
echo "clientId: ".$clientId."<br/>";

//update the DB... hopefully..
$db->updateClient($clientName, $repFirstName, $repMiddleInital, $repLastName, $emailId, $city, $province, $postalCode, $password, $clientId);
header("location: admin_client.php?clientId=$clientId");
?>
