<?php
// Class to manage database connection
class DatabaseConn {
    function __construct() {
        $this->config = parse_ini_file("config.ini", true);
        $this->connect();
    }

    // Connect to the database using config
    private function connect() {
        $databaseConfig = $this->config["database"];
        $username = $databaseConfig["username"];
        $password = $databaseConfig["password"];
        $server = $databaseConfig["server"];
        $db = $databaseConfig["db"];

        $connection = new mysqli($server, $username, $password, $db);

        if($connection->connect_error) {
            die("Connection failed: ". $connection->connect_error);
        }

        $this->conn = $connection;
    }

    // Returns array containing all contracts
    function getAllContracts() {
        $result = $this->conn->query("SELECT * FROM Contracts;");
        return $result;
    }

    function getDeliverablesByContractId($contractId) {
        $result = $this->conn->query("SELECT * from Deliverables WHERE contractId=$contractId");

        return $result;
    }


    function saveContractSatisfactionByContractId(int $contractId, int $satisfaction) {
        $result = $this->conn->query("UPDATE Contracts SET satisfactionLevel=$satisfaction WHERE contractId=$contractId");

        if(!$result) {
            die($this->conn->error);
        }
    }

    function getContractsByClientId(int $id) {
        $results = $this->conn->query("SELECT * FROM Contracts WHERE clientId=$id");
        return $results;
    }

    function addNewPayment(int $contractId, float $amount) {
        $result = $this->conn->query("INSERT INTO Payments (contractId, amount) VALUES($contractId, $amount)");
        if(!$result) {
            die($this->conn->error);
        }
    }

    function getPaymentsByContractId(int $contractId) {
        return $this->conn->query("SELECT * from Payments WHERE contractId=$contractId");
    }

    // Returns a user by his id
    function getUserById(int $id) {
        $result = $this->conn->query("SELECT * FROM Users WHERE id=$id");

        if($result.num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    function getRegularEmployeeById(int $id) {
        $result = $this->conn->query("SELECT * FROM Regular INNER JOIN Employees ON Employees.employeeId = Regular.employeeId WHERE Regular.employeeId=$id");


        if($result->num_rows > 0){
            return $result->fetch_assoc();
        } else {
            print($this->conn->error);
            return 0;
        }
    }

    function getIdFromName(string $name) {
        $result = $this->conn->query("SELECT employeeId FROM Employees WHERE CONCAT(firstName,' ', lastName)='$name'");
        print($this->conn->error);

        if($result->num_rows > 0){
            return $result->fetch_assoc();
        } else {
            return 0;
        }
    }

    function getManagersByContractId(int $id) {
        $result = $this->conn->query("SELECT DISTINCT Employees.* FROM Manager, Employees, Contracts WHERE Manager.contractId=$id AND Manager.employeeId = Employees.employeeId");
        return $result;
    }

    function getManagerEmployeeById(int $id) {
        $result = $this->conn->query("SELECT * FROM Manager INNER JOIN Employees ON Employees.employeeId = Manager.employeeId WHERE Manager.employeeId=$id");

        print($this->conn->error);

        if($result->num_rows > 0){
            return $result->fetch_assoc();
        } else {
            return 0;
        }
    }

    function getAllManagers() {
        $result = $this->conn->query("SELECT * FROM Manager INNER JOIN Employees ON Employees.employeeId = Manager.employeeId");

        return $result;
    }

    function getSalesAssociateEmployeeById(int $id) {
        $result = $this->conn->query("SELECT * FROM SalesAssociate INNER JOIN Employees ON Employees.employeeId = SalesAssociate.employeeId WHERE SalesAssociate.employeeId=$id");

        print($this->conn->error);

        if($result->num_rows > 0){
            return $result->fetch_assoc();
        } else {
            return 0;
        }
    }

    function getContractsSupervisedBySalesAssociateById(int $salesAssociateId) {
        return $this->conn->query("SELECT * from Contracts WHERE superviseBy=$salesAssociateId");
    }

    function getContractByContractId(int $id) {
        $result = $this->conn->query("SELECT * FROM Contracts WHERE Contracts.contractId=$id");

        if($result->num_rows > 0){
            return $result->fetch_assoc();
        } else {
            return 0;
        }
    }

    // Returns the client matching the contract id
    function getClientByContractId(int $id) {
        $result = $this->conn->query("SELECT * FROM Clients WHERE clientId IN (SELECT clientId FROM Contracts WHERE Contracts.contractId=$id)");

        print($this->conn->error);

        if($result->num_rows > 0){
        return $result->fetch_assoc();
        } else {
            return 0;
        }
    }

    function getTaskByEmployeeId(int $id) {
        $result = $this->conn->query("SELECT * FROM Tasks WHERE Tasks.employeeId=$id");

        print($this->conn->error);

        if($result->num_rows > 0){
        return $result->fetch_assoc();
        } else {
            return 0;
        }
    }

    function getEmployeeById(int $id) {
      $result = $this->conn->query("SELECT * FROM Employees WHERE Employees.employeeId=$id");

      print($this->conn->error);

      if($result->num_rows > 0){
      return $result->fetch_assoc();
      } else {
          return 0;
        }
    }

    function getTaskTypeByContractId(int $id) {
      $result = $this->conn->query("SELECT DISTINCT Tasks.taskType FROM Tasks WHERE Tasks.contractId=$id");

      print($this->conn->error);

      if($result->num_rows > 0){
        return $result->fetch_all();
      } else {
          return 0;
        }
    }
    function getTaskTypeAndEmployeeNameByContractId(int $id) {
      $result = $this->conn->query("SELECT Tasks.taskType, Employees.firstName,Employees.lastName FROM Tasks,Employees WHERE Tasks.contractId=$id AND Employees.employeeId = Tasks.employeeId");

      print($this->conn->error);

      if($result->num_rows > 0){
        return $result->fetch_all();
      } else {
          return 0;
        }
    }

    function getEmployeesNotOnContractByContractId(int $id){
      $result = $this->conn->query("SELECT Regular.desiredContractType, Regular.employeeId FROM Regular WHERE Regular.contractId!=$id ");

      print($this->conn->error);

      if($result->num_rows > 0){
        return $result->fetch_all();
      } else {
          return 0;
        }
    }

    function getRegularOnSameContract(int $contractId)
    {
      return $this->conn->query("SELECT * FROM Employees, Regular WHERE Employees.employeeId = Regular.employeeId AND Regular.contractId=$contractId");
    }

	function setDeliverableDeliveredByContractIdAndDeliverableIndex(int $contractId, int $index) {
		$result = $this->conn->query("UPDATE Deliverables SET deliveredDate=NOW() WHERE contractId=$contractId AND deliverableIndex=$index");

		if(!$result) {
			die($this->conn->error);
		}
	}

    function getDesiredContractTypeFromRegular() {
      $result = $this->conn->query("SELECT DISTINCT desiredContractType FROM Regular");

      if($result->num_rows > 0){
        return $result->fetch_all();
      } else {
          return 0;
        }
    }

    function getDesiredContractTypeAndIdFromRegular() {
      $result = $this->conn->query("SELECT desiredContractType,employeeId FROM Regular");

      if($result->num_rows > 0){
        return $result->fetch_all();
      } else {
          return 0;
        }
    }

	function deleteContractByContractId($id) {
        $this->conn->query("UPDATE Manager set contractId = NULL where contractId = $id");
        $this->conn->query("UPDATE Regular set contractId = NULL where contractId = $id");
        $this->conn->query("DELETE FROM Deliverables WHERE contractId=$id");
        $this->conn->query("DELETE FROM Tasks WHERE contractId=$id");
		$this->conn->query("DELETE FROM Contracts where contractId=$id");
	}

    function getLinesOfBusiness() {
      $result = $this->conn->query("SELECT DISTINCT lineOfBusiness FROM Contracts");

      print($this->conn->error);

      if($result->num_rows > 0){
        return $result->fetch_all();
      } else {
          return 0;
        }
    }

	function getContractsFromLinesOfBusiness(string $lines) {
		return $this->conn->query("SELECT * FROM Contracts WHERE Contracts.lineOfBusiness='$lines'");
	}

    function getLinesOfBusinessBySalesAssociateId(int $id) {
      $result = $this->conn->query("SELECT DISTINCT lineOfBusiness FROM Contracts WHERE Contracts.superviseBy=$id");

      print($this->conn->error);

      if($result->num_rows > 0){
        return $result->fetch_all();
      } else {
          return 0;
        }
    }

    function getContractIdFromSalesAssociateIdAndLinesOfBusiness(int $id,string $lines) {
      $result = $this->conn->query("SELECT contractId FROM Contracts WHERE Contracts.superviseBy=$id AND Contracts.lineOfBusiness='$lines'");

      print($this->conn->error);

      if($result->num_rows > 0){
        return $result->fetch_all();
      } else {
          return 0;
        }
	}

	function getAllContractsOrderedByDate() {
		return $this->conn->query("SELECT * from Contracts ORDER BY serviceStartDate");
	}

    function getClientsBySalesAssociateId(int $id) {
      $result = $this->conn->query("SELECT DISTINCT Clients.* FROM Clients,Contracts WHERE Contracts.superviseBy=$id AND Contracts.clientId=Clients.clientId");

      print($this->conn->error);

      if($result->num_rows > 0){
        return $result->fetch_all();
      } else {
          return 0;
        }
    }

    function getClientsAll() {
      $result = $this->conn->query("SELECT DISTINCT * FROM Clients");

      print($this->conn->error);

      if($result->num_rows > 0){
        return $result->fetch_all();
      } else {
          return 0;
        }
    }

    /*== Admin Page Logic ===*/
    // Returns array containing all clients in DB
    function getAllClients(){
        $result = $this->conn->query("SELECT * FROM Clients;");
        return $result;
    }

    function getEmployeeNameById(int $id){
        $result = $this->conn->query("SELECT Employees.firstName FROM Employees WHERE Employees.employeeId = $id;");
        return $result;
    }

    // Retunrs array containing all contracts belonging to a clients
    function getContractByClientId(int $id){
        $result = $this->conn->query("SELECT * FROM Contracts WHERE Contracts.clientId=$id;");
        return $result;
    }

    // returns an array of all the employees working on a specific contract
    function getEmployeeByContractId(int $id){
        $result = $this->conn->query("SELECT * FROM Contracts WHERE Contracts.clientId=$id;");
        return $result;
    }

    // Returns the client matching the client id
    function getClientByClientId(int $id) {
        $result = $this->conn->query("SELECT * FROM Clients WHERE Clients.clientId=$id");
        print($this->conn->error);

        if($result->num_rows > 0){
            return $result->fetch_assoc();
        } else {
            return 0;
        }
    }

    // Update the values of a row of Table Contracts
    function updateContract(string $contactNumber, string $annualContractValue, string $initalAmount, string $serviceStartDate, string $serviceType, string $contractType, string $lineOfBusiness, int $satisfactionLevel, int $id){

        $result = $this->conn->query("
            UPDATE Contracts
            SET
            contactNumber = $contactNumber,
            annualContractValue = $annualContractValue,
            initalAmount = $initalAmount,
            serviceStartDate =  $serviceStartDate,
            serviceType = $serviceType,
            contractType = $contractType,
            lineOfBusiness = $lineOfBusiness,
            satisfactionLevel = $satisfactionLevel
            WHERE Contracts.contractId=$id;");
        return $result;
    }

    // Update the values of a row of Table Clients
    function updateClient(string $clientName, string $repFirstName, string $repMiddleInital, string $repLastName, string $emailId, $city, $province, string $postalCode,string $password, int $id){
        $result = $this->conn->query("
            UPDATE Clients
            SET
            clientName = $clientName,
            repFirstName = $repFirstName,
            repMiddleInital = $repMiddleInital,
            repLastName = $repLastName,
            emailId = $emailId,
            city = $city,
            province = $province,
            postalCode = $postalCode,
            password = $password
            WHERE Clients.clientId=$id;");
        return $result;
    }
    /*== End Admin Page Logic ===*/

    /*== Login Page Logic ===*/


    function updateRegularDesiredContractType(int $id,string $enumm) {
      $result = $this->conn->query("UPDATE Regular SET desiredContractType='$enumm' WHERE employeeId=$id");

      if(!$result) {
          die($this->conn->error);
      }
	}

	function getTaskByRegularId($id) {
	  $result = $this->conn->query("SELECT * FROM Tasks");
	  return $result->fetch_assoc();
    }
    
    function deleteTasksOnContractByContractId(int $contractId) {
        $result = $this->conn->query("DELETE FROM Tasks WHERE contractId=1");
        if(!$result) {
            die($this->conn->error);
        }
    }
    


    function updateRegularInsurance(int $id,string $enumm) {
      $result = $this->conn->query("UPDATE Regular SET insurance='$enumm' WHERE employeeId=$id");

      if(!$result) {
          die($this->conn->error);
      }
    }

    function removeRegularFromContractById(int $id)
    {
      $result1 = $this->conn->query("UPDATE Regular SET contractId=0 WHERE employeeId=$id");
      $result2 = $this->conn->query("DELETE FROM Tasks WHERE employeeId=$id");
      $result3 = $this->conn->query("UPDATE Regular SET manageBy=0 WHERE employeeId=$id");

      if(!$result1) {
          die("Regular update error: ". $this->conn->error);
      }
      if(!$result2) {
          die("Task update error: ".$this->conn->error);
      }
      if(!$result3) {
          die("Regylar manager update error: ". $this->conn->error);
      }
    }

    function updateRegularContractId(int $id,int $contractid,int $mid) {
      $result1 = $this->conn->query("UPDATE Regular SET contractId=$contractid WHERE employeeId=$id");
      $result2 = $this->conn->query("UPDATE Tasks SET contractId=$contractid WHERE employeeId=$id");
      $result3 = $this->conn->query("UPDATE Regular SET manageBy=$mid WHERE employeeId=$id");
      if(!$result1) {
          die($this->conn->error);
      }
      if(!$result2) {
          die($this->conn->error);
      }
      if(!$result3) {
          die($this->conn->error);
      }
    }

    function updateRegularTaskType(int $id,string $type) {
      $result = $this->conn->query("UPDATE Tasks SET taskType='$type' WHERE employeeId=$id");
      if(!$result) {
          die($this->conn->error);
      }
    }


    function addClient(string $s1,string $s2,string $s3,string $s4,string $s5,string $s6,string $s7,string $s8,string $s9)
    {
      $result = $this->conn->query("INSERT INTO Clients VALUES (0,'$s1','$s2','$s3','$s4','$s5','$s6','$s7','$s8','$s9')");
      if(!$result) {
          die($this->conn->error);
      }
    }

    function addContract(int $i1, int $i2, string $s1, string $d1, string $d2, string $da, string $s2, string $s3, string $s4)
    {
      $real_d1 = floatval($d1);
      $real_d2 = floatval($d2);

      $result = $this->conn->query("INSERT INTO Contracts VALUES (0,$i1,$i2,'$s1',$real_d1,$real_d2,'$da','$s2','$s3','$s4',0)");
      if(!$result) {
          die($this->conn->error);
      }
    }

	function logHoursForEmployee(int $employeeId, $timeAmount) {
		$result = $this->conn->query("UPDATE Tasks SET hours = hours + $timeAmount WHERE employeeId=$employeeId");

		if(!$result) {
			die($this->conn->error);
		}
	}

    function getEmployeeIdByName(string $name)
    {
        $result = $this->conn->query("SELECT employeeId FROM Employees WHERE CONCAT(firstName,' ',lastName)='$name'");
        return $result->fetch_assoc();
    }

    function updateManagerContractIdbyId(int $id)
    {
      $contract = $this->conn->query("SELECT * FROM Contracts ORDER BY contractId DESC LIMIT 1");
      $contract_1 = $contract->fetch_assoc();
      $contract_id = $contract_1["contractId"];
      $result = $this->conn->query("UPDATE Manager SET contractId=$contract_id WHERE employeeId=$id");
    }



    // Attempt to login as a client
    function loginClient(string $username, string $password) {
		$username=  $this->escape($username);
		$password = $this->escape($password);
        // $query = "SELECT * FROM Clients WHERE emailId ='$username' AND password='$password' LIMIT 1";
        $query = "SELECT * FROM Clients WHERE clientId ='$username' AND password='$password' LIMIT 1";
        $clients = $this->conn->query($query);

        if($clients->num_rows >= 1) {
            $client = $clients->fetch_assoc();

            $_SESSION["user"] = $client;
            $_SESSION["user_type"] = "Client";
        } else {
            pushError("
            <div class=\"container\">
                <div class=\"row-fluid\">
                    <div class=\"alert alert-danger alert-dismissible fade show m-1\">
                        ✋Invalid login credentials, try again.
                         <button type=\"button\" class=\"close\" data-dismiss=\"alert\">
                            <span>&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            ");
        }

        header("location: index.php");
    }

    // Attempt to login as an employee
    function loginEmployee(string $username,string $password) {
		$username=  $this->escape($username);
		$password = $this->escape($password);
        // $query = "SELECT * FROM Employees WHERE CONCAT(firstName,lastName) ='$username' AND password='$password' LIMIT 1";
        $query = "SELECT * FROM Employees WHERE employeeId ='$username' AND password='$password' LIMIT 1";
        $employees = $this->conn->query($query);

        if($employees->num_rows >= 1) {
            $employee = $employees->fetch_assoc();
            $employee_type = $this->getEmployeeTypeById($employee["employeeId"]);

            $_SESSION["user"] = $employee;
			$_SESSION["user_type"] = $employee_type;
        } else {
            pushError("
            <div class=\"container\">
                <div class=\"row-fluid\">
                    <div class=\"alert alert-danger alert-dismissible fade show m-1\">
                        ✋Invalid login credentials, try again.
                         <button type=\"button\" class=\"close\" data-dismiss=\"alert\">
                            <span>&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            ");
        }

        header("location: index.php");
    }
    /*== End Login Page Logic ===*/

    // Returns an employee type by his id
    function getEmployeeTypeById(int $id) {
        if($this->checkTableForEmployeeId("Admins", $id)) {
            return "Admin";
        }

        if($this->checkTableForEmployeeId("SalesAssociate", $id)) {
            return "Sales Associate";
        }

        if($this->checkTableForEmployeeId("Manager", $id)) {
            return "Manager";
        }

        if($this->checkTableForEmployeeId("Regular", $id)) {
            return "Regular";
        }

        return null;
    }

    // Checks a table to see if it contains a user id
    private function checkTableForEmployeeId(string $table,int $id) {
        $sql = "SELECT * FROM $table WHERE employeeId=$id";
        $admins = $this->conn->query($sql);
        return $admins->num_rows >= 1;
    }

    // Escape string to be safe
    function escape(string $str) {
        return $this->conn->escape_string(trim($str));
    }
}

$db = new DatabaseConn();
?>
