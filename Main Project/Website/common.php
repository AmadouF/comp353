<?php
session_start();

function IsLoggedIn() {
    return isset($_SESSION["user"]);
}

class Database {
    function __construct() {
        $this->config = parse_ini_file("config.ini", true);
        $this->connect();
    }

    function connect() {
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

    function getAllContracts() {
        $result = $this->conn->query("SELECT * FROM Contracts;");
        return $result;
    }

    function getUserById($id) {
        $result = $this->conn->query("SELECT * FROM Users WHERE id=$id");
        
        if($user.num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    function getUserType($id) {
        if($this->checkTableForUser("Admins", $id)) {
            return "Admin";
        }

        if($this->checkTableForUser("SalesAssociate", $id)) {
            return "Sales Associate";
        }

        if($this->checkTableForUser("Manager", $id)) {
            return "Manager";
        }

        if($this->checkTableForUser("Regular", $id)) {
            return "Regular";
        }

        return "Unknown";
    }

    function checkTableForUser($table, $id) {
        $sql = "SELECT * FROM $table WHERE employeeId=$id";
        $admins = $this->conn->query($sql);
        return $admins->num_rows >= 1;
    }

    function escape($str) {
        return $this->conn->real_escape_string(trim($str));
    }

    function loginEmployee($username, $password) {
        echo "login $username, $password";
        $query = "SELECT * FROM employees WHERE CONCAT(firstname,lastname) ='$username' AND password='$password' LIMIT 1";
        $employees = $this->conn->query($query);

        if($employees->num_rows >= 1) {
            $employee = $employees->fetch_assoc();
            $employee_type = $this->getUserType($employee["employeeId"]);



            $_SESSION["user"] = $employee;
            $_SESSION["user_type"] = $employee_type;
         
            header("location: /index.php");
            die();
        } else {
            die("INVALID USERNAME / PASS");
            //TODO: USER NOT FOUND ERROR
        }
    }

    function loginClient($username, $password) {
        echo "login $username, $password";
        $query = "SELECT * FROM clients WHERE emailId ='$username' AND password='$password' LIMIT 1";
        $clients = $this->conn->query($query);

        if($clients->num_rows >= 1) {
            $client = $clients->fetch_assoc();

            $_SESSION["user"] = $client;
            $_SESSION["user_type"] = "Client";

            header("location: /");
            die();
        } else {
            die("INVALID USERNAME / PASS");
            //TODO: CLIENT NOT FOUND ERROR
        }
    }
}
?>