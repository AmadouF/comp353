<?php
session_start();

if(!isset($_SESSION["errors"])) {
    $_SESSION["errors"] = array();
}

function pushError($err) {
    array_push($_SESSION["errors"], $err);
}

// This will display and clear errors in the session
function displayErrors() {
    if(isset($_SESSION["errors"])) {
        foreach($_SESSION["errors"]as $error) {
            echo "$error <br />";
        }

        $_SESSION["errors"] = array();
    }
}

// Returns if a user or client is logged in
function IsLoggedIn() {
    return isset($_SESSION["user"]);
}

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

    // Returns a user by his id
    function getUserById($id) {
        $result = $this->conn->query("SELECT * FROM Users WHERE id=$id");
        
        if($user.num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    // Returns an employee type by his id
    function getEmployeeTypeById($id) {
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

        return "Unknown";
    }

    // Checks a table to see if it contains a user id
    private function checkTableForEmployeeId($table, $id) {
        $sql = "SELECT * FROM $table WHERE employeeId=$id";
        $admins = $this->conn->query($sql);
        return $admins->num_rows >= 1;
    }

    // Escape string to be safe
    function escape($str) {
        return $this->conn->real_escape_string(trim($str));
    }

    // Attempt to login as an employee
    function loginEmployee($username, $password) {
        $query = "SELECT * FROM employees WHERE CONCAT(firstname,lastname) ='$username' AND password='$password' LIMIT 1";
        $employees = $this->conn->query($query);

        if($employees->num_rows >= 1) {
            $employee = $employees->fetch_assoc();
            $employee_type = $this->getEmployeeTypeById($employee["employeeId"]);

            $_SESSION["user"] = $employee;
            $_SESSION["user_type"] = $employee_type;
        } else {
            pushError("Wrong firstname.lastname / password for employee login");
        }

        header("location: /index.php");
    }

    // Attempt to login as a client
    function loginClient($username, $password) {
        $query = "SELECT * FROM clients WHERE emailId ='$username' AND password='$password' LIMIT 1";
        $clients = $this->conn->query($query);

        if($clients->num_rows >= 1) {
            $client = $clients->fetch_assoc();

            $_SESSION["user"] = $client;
            $_SESSION["user_type"] = "Client";
        } else {
            pushError("Wrong emailId / password for client login");
        }

        header("location: /");
    }
}
?>