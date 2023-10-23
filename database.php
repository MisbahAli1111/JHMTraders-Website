<?php 

$servername = "localhost";
$username = "root";
$password = '';
$dbName="jhmtrade_eCommerce";
// Create connectlion

$con = new mysqli($servername, $username, $password,$dbName);

// Check connection
if ($con->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$con->set_charset('utf8mb4');
?>