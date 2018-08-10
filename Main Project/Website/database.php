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

    function getContractByContractId(int $id) {
        $result = $this->conn->query("SELECT * FROM Contracts WHERE Contracts.contractId=$id");

        print($this->conn->error);

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


    function getRegularOnSameContract(int $contractId)
    {
      $result = $this->conn->query("SELECT Employees.firstName,Employees.lastName FROM Employees, Regular WHERE Employees.employeeId = Regular.employeeId AND Regular.contractId=$contractId");

      print($this->conn->error);

      if($result->num_rows > 0)
      {
        return $result->fetch_all();
      }
      else
      {
          return 0;
      }
    }

    function getDesiredContractTypeFromRegular() {
      $result = $this->conn->query("SELECT DISTINCT desiredContractType FROM Regular");

      print($this->conn->error);

      if($result->num_rows > 0){
        return $result->fetch_all();
      } else {
          return 0;
        }
    }

    function getDesiredContractTypeAndIdFromRegular() {
      $result = $this->conn->query("SELECT desiredContractType,employeeId FROM Regular");

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

    // Returns array containing all contracts in DB
    function getAllContracts() {
        $result = $this->conn->query("SELECT * FROM Contracts;");
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
    // Attempt to login as a client
    function loginClient(string $username, string $password) {
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
        // $query = "SELECT * FROM Employees WHERE CONCAT(firstName,lastName) ='$username' AND password='$password' LIMIT 1";
        $query = "SELECT * FROM Employees WHERE employeeId ='$username' AND password='$password' LIMIT 1";
        $employees = $this->conn->query($query);

		echo $query."   ";
		echo $username."--".$password;
		echo "  ".$employees->num_rows;

        if($employees->num_rows >= 1) {
            $employee = $employees->fetch_assoc();
            $employee_type = $this->getEmployeeTypeById($employee["employeeId"]);

            $_SESSION["user"] = $employee;
			$_SESSION["user_type"] = $employee_type;
			echo "GOOD";
        } else {
			echo "ERROR";
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
        return $this->conn->real_escape_string(trim($str));
    }
}

$db = new DatabaseConn();
?>
