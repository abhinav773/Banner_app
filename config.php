<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "banner_app";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// else{
//     echo "connection sucessfully";
// }
?>