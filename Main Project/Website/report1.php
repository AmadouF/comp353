<?php
	include("database.php");

	$result = $db->conn->query("Select clientName FROM Contracts, Clients Where Contracts.contractId=(Select Distinct Max(Contracts.contractId)&(Contracts.clientId=Clients.clientId))");

	if(empty($result)) {
		die($db->conn->error);
	}
?>
<html>
<body>
<ul>
	<h1>Report 1</h1>
	<?php
		foreach($result as $val) {
			?>
				<li><?=$val["clientName"]?></li>
			<?php
		}
	?>

	<h2>Report 2</h2>
<ul>
</body>
</html>
