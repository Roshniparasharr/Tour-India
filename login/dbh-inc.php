<?php
$serverName = "localhost:3306";
$dbUsername = "root";
$dbPassword = "";
$dbName = "tourindia";

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}
?>
