<?php
    $user = $pswd = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user = $_POST["user"];
        $pswd = $_POST["pswd"];
    }
    if (isset($_POST["submit"])) {
        $username = "root"; 
        $password = "ch1d0N83"; 
        $dbname = "drumkit";
        $servername = "mysql_db_php_2"; //docker-compose.yml database name
        $port = 3306;  
        $conn = new mysqli($servername, $username, $password, '', $port);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $query = "CREATE DATABASE IF NOT EXISTS drumkit";
        if ($conn->query($query) === FALSE) {
            echo "Error creating database: " . $conn->error . "<br>";
        }

        $conn->select_db($dbname);

        $query = "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user VARCHAR(255) NOT NULL,
            pswd VARCHAR(255) NOT NULL
        )";

        if ($conn->query($query) === FALSE) {
            echo "Error creating table: " . $conn->error . "<br>";
        }

        $query = "INSERT INTO users (user, pswd) VALUES ('$user', '$pswd')";
        if ($conn->query($query) === FALSE) echo "Error inserting data: " . $conn->error . "<br>";
        $conn->close();
    }
    header("Location: ./index.html");
?>