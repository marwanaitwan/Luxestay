<?php
// Databasuppkoppling - ändra här om dina DB-uppgifter ändras
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kolla om anslutning funkar, annars döda scriptet
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

