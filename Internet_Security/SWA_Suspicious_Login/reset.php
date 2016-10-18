<?php
$servername = "localhost";
$username = "rob";
$password = "AbAcAb190";
$dbname = "rob";

$conn = new PDO("mysql:host=$servername;dbanem=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$email = $_POST['email'];
$password = password_hash($_POST['passwordNew'], PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO rob.members (password) VALUES (:password) WHERE (email = $email)")
$stmt->bindParam(":password",$password);
$stmt->execute();

header('Location: success.php');
