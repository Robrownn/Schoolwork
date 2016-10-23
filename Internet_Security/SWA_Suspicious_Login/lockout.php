<?php

$servername = "localhost";
$username = "rob";
$password = "AbAcAb190";
$dbname = "rob";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $email = $_POST['email'];

  $update = $conn->prepare("UPDATE rob.members SET locked = 1 WHERE email = '$email'");
  $update->execute();
}catch(PDOException $e) {
  header('Location: error.php');
}

 ?>
