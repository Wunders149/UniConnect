<?php
$host = "localhost";  
$user = "root";       
$pass = "";           
$dbname = "my_database"; 

$conn = new mysqli($host, $user, $pass, $dbname);


if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

$conn->set_charset("utf8");

?>
