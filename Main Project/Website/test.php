<?php
include_once("common.php");

$conn = new Database();

$contracts = $conn->getAllContracts();

if($contracts->num_rows > 0) {
    echo "<ul>";
    while($contract = $contracts->fetch_assoc()) {
        echo "<li>".$contract["clientId"]. " - ".$contract["contractType"]."</li>";
    }
    echo "</ul>";
}

?>