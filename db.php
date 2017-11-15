<?php 

$server = 'localhost';
$username = 'root';
$password = 'password';
$database = 'login';

try{
	$conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch(PDOException $e) {
	die("Connecion failed: " . $e->getMessage());
}

?>