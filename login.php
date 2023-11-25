<?php
    $user = $pswd = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user = $_POST["user"];
        $pswd = $_POST["pswd"];
    }

    if (isset($_POST["submit"])) {
        if (validate($user, $pswd)) {
            header("Location: ./drumkit.html");
        } else {
            header("Location: ./index.html");
        }
    }
    function validate($user, $pswd){
        $username = "root"; // Replace with your MySQL username
        $password = "ch1d0N83"; // Replace with your MySQL password
        $dbname = "drumkit";
        $servername = "mysql_db_php_2";  // Use the hostname set in the docker-compose.yml
        $port = 3306;  // MySQL port number

        // Create a connection to the MySQL server without specifying a database
        $conn = new mysqli($servername, $username, $password, '', $port);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Select the "jobseekers" database
        $conn->select_db($dbname);

        // Query to retrieve data from the "personal_info" table
        $query = "SELECT * FROM users WHERE user='$user'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if($pswd == $row["pswd"]){
                    return true;
                }
            }
        } else {
            echo "No records found";
        }
        $conn->close();
        return false;
    }
?>