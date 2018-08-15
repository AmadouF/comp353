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
	
	<h1>Extra Report 1</h1>
	<?php
	displayResults($db, "Select Count(Distinct Tasks.employeeId) from Tasks, Contracts where Contracts.contractType='Premium' and Tasks.hours < 60;")
	?>
	
	<h1>Extra Report 2</h1>
	<?php
	displayResults($db, "Select Count(Distinct contractId) From Contracts where Contracts.contractType='Silver' and day(Contracts.serviceStartDate) >= day(NOW()) and  year(Contracts.serviceStartDate) >= year(NOW()) and  month(Contracts.serviceStartDate) >= month(NOW()) and dayname(serviceStartDate)!='Saturday' and dayname(serviceStartDate)!='Sunday' having Count(Contracts.contractType) >= 35;")
	?>
	<h2>Extra report 3</h5>
	<ul>
	<li>
	<h4>Premium</h4>
	<?php
	displayResults($db, "SELECT DATE_ADD( serviceStartDate, INTERVAL 3 + IF( (WEEK(serviceStartDate) <> WEEK(DATE_ADD(serviceStartDate, INTERVAL 3 DAY))) OR (WEEKDAY(DATE_ADD(serviceStartDate, INTERVAL 3 DAY)) IN (5, 6)), 2, 0) DAY ) AS Deliverable_date FROM Contracts where month(serviceStartDate) between 1 and 12 and year(serviceStartDate)=2017 and Contracts.contractType='Premium';")
	?>
	</li>
	<li>
	<h4>Diamond</h4>
	<?php
	displayResults($db, "SELECT DATE_ADD( serviceStartDate, INTERVAL 6 + IF( (WEEK(serviceStartDate) <> WEEK(DATE_ADD(serviceStartDate, INTERVAL 6 DAY))) OR (WEEKDAY(DATE_ADD(serviceStartDate, INTERVAL 6 DAY)) IN (5, 6)), 2, 0) DAY ) AS Deliverable_date FROM Contracts where month(serviceStartDate) between 1 and 12 and year(serviceStartDate)=2017 and Contracts.contractType='Diamond';")
	?>
	</li>
	<li>
	<h4>Silver</h4>
	<?php
	displayResults($db, "SELECT DATE_ADD( serviceStartDate, INTERVAL 5 + IF( (WEEK(serviceStartDate) <> WEEK(DATE_ADD(serviceStartDate, INTERVAL 5 DAY))) OR (WEEKDAY(DATE_ADD(serviceStartDate, INTERVAL 5 DAY)) IN (5, 6)), 2, 0) DAY ) AS Deliverable_date FROM Contracts where month(serviceStartDate) between 1 and 12 and year(serviceStartDate)=2017 and Contracts.contractType='Silver';")
	?>
	</li>
	<li>
	<h4>Gold</h4>
	<?php
	displayResults($db, "SELECT DATE_ADD( serviceStartDate, INTERVAL 8 + IF( (WEEK(serviceStartDate) <> WEEK(DATE_ADD(serviceStartDate, INTERVAL 8 DAY))) OR (WEEKDAY(DATE_ADD(serviceStartDate, INTERVAL 8 DAY)) IN (5, 6)), 2, 0) DAY ) AS Deliverable_date FROM Contracts where month(serviceStartDate) between 1 and 12 and year(serviceStartDate)=2017 and Contracts.contractType='Gold';")
	?>
</body>
</html>
