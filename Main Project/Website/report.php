<?php
	include("database.php");

	function displayResults($db, string $query) {
		$result = $db->conn->query($query);
		
		if(empty($result)) {
			die($db->conn->error);
		}
		echo "<ol>";
		while($val = $result->fetch_assoc()) {
			echo "<li>";
			foreach($val as $key=>$v) {
				echo "<b>".$key."</b>: ".$v."<br />";
			}
			echo "</li> <br />";
		}
		echo "</ol>";
	}

?>
<html>
<body>
	<h1>Report 1</h1>
	<?php
	displayResults($db, "Select clientName FROM Contracts, Clients Where Contracts.contractId=(Select Distinct Max(Contracts.contractId)&(Contracts.clientId=Clients.clientId))");
	?>

	<h1>Report 2</h1>
	<?php
	displayResults($db, "SELECT * FROM Contracts, SalesAssociate WHERE SalesAssociate.employeeId=Contracts.superviseBy and day(Contracts.serviceStartDate) between day(NOW())-10 and day(NOW()) and year(Contracts.serviceStartDate)=year(NOW())");
	?>

	<h1>Report 3</h1>
	<?php 
	displayResults($db, "SELECT Employees.* from Employees, Contracts, Clients, Tasks WHERE Employees.employeeId = Tasks.employeeId AND Tasks.contractId = Contracts.contractId AND Contracts.clientId  = Clients.clientId AND Clients.province = 'Quebec'")
	?>

	<h1>Report 4</h1>
	<?php
	displayResults($db, "Select * FROM Contracts WHERE contractType='Gold'");
	?>

	<h2>Report 5</h5>
	<ul>
	<li>
	<h4>Premium</h4>
	<?php
	displayResults($db, "select clientName, max(satisfactionLevel), contractType, city FROM Contracts, Clients where contractType='Premium' GROUP BY Clients.city;")
	?>
	</li>
	<li>
	<h4>Diamond</h4>
	<?php
	displayResults($db, "select clientName, max(satisfactionLevel), contractType, city FROM Contracts, Clients where contractType='Diamond' GROUP BY Clients.city;")
	?>
	</li>
	<li>
	<h4>Silver</h4>
	<?php
	displayResults($db, "select clientName, max(satisfactionLevel), contractType, city FROM Contracts, Clients where contractType='Silver' GROUP BY Clients.city;")
	?>
	</li>
	<li>
	<h4>Gold</h4>
	<?php
	displayResults($db, "select clientName, max(satisfactionLevel), contractType, city FROM Contracts, Clients where contractType='Gold' GROUP BY Clients.city;")
	?>
	</li>
	</ul>
</body>
</html>
