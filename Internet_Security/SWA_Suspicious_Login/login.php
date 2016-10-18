<?php

session_start();

$servername = "localhost";
$username = "rob";
$password = "AbAcAb190";
$dbname = "rob";

console.log("Connecting to database...");
$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
console.log("Connected to Database.");


try {

  $email = strtolower($_POST['email']);
  $password = $_POST['password'];
  $datetime = date("Y-m-d H:i:s");

  $stmt = $conn->prepare("SELECT * FROM rob.members WHERE (email = '$email')");
  $stmt->execute();

  $rowCount = $stmt->rowCount();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);


  if ($rowCount == 1 && password_verify($password, $row['password'])) {
    $_SESSION['email'] = $email;

    $update = $conn->prepare("UPDATE rob.members SET last_login='$datetime' WHERE (email = '$email')");
    $update->execute();

    header('Location: home.php');
  }
  else {
    header('Location: nologin.php');
  }
}
catch(PDOException $e) {
  header('Location: error.php');
}
?>
