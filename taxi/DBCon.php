<?php
       
$host = 'localhost';
$database = 'smarttaxidb';
$user = 'dimuthu';
$password = '0773432552ijse4E';


$con = mysqli_connect($host, $user, $password, $database);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

?>