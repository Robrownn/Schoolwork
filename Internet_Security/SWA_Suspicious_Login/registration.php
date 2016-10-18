<?php

$servername = "localhost";
$username = "rob";
$password = "AbAcAb190";
$dbname = "rob";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $username = $_POST['username'];
  $email = strtolower($_POST['email']);
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $secQ = strtolower($_POST['secQuestion']);
  $secACase = strtolower($_POST['secAnswer']);
  $secA = password_hash($secACase, PASSWORD_DEFAULT);
  $datetime = date("Y-m-d H:i:s");

  $stmt = $conn->prepare("INSERT INTO rob.members (username,email,password,secQuestion,secAnswer,acl,last_login) VALUES ('$username', '$email', '$password', '$secQ', '$secA',0,'$datetime')");
  $stmt->execute();

  header('Location: success.php');
}
catch(PDOException $e) {
  header('Location: error.php');
}
 ?>
