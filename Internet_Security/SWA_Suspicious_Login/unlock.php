<?php
$servername = "localhost";
$username = "rob";
$password = "AbAcAb190";
$dbname = "rob";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $email = $_POST['email'];
  $pin = $_POST['pin'];

  $stmt = $conn->prepare("SELECT * FROM rob.members WHERE email = '$email'");
  $stmt->execute();

  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  if (password_verify($pin, $row['PIN'])) {
    $update = $conn->prepare("UPDATE rob.members SET locked = 0; WHERE email = '$email'");
    $update->execute();

    header('Location: success.php');
  }else {
    header('Location: error.php');
  }

 ?>
