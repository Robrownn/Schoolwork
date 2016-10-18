<?php
$servername = "localhost";
$username = "rob";
$password = "AbAcAb190";
$dbname = "rob";

console.log("Connecting to database...");
$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
console.log("Connected to Database.");

try {

  $email = strtolower($_POST['emailForget']);
  $password = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
  $secQ = strtolower($_POST['secQForget']);
  $secA = strtolower($_POST['secAForget']);

  $stmt = $conn->prepare("SELECT * FROM rob.members WHERE (email = '$email')");
  $stmt->execute();

  $rowCount = $stmt->rowCount();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($rowCount == 1 && $secQ == $row['secQuestion'] && password_verify($secA, $row['secAnswer'])) {
    $stmt = $conn->prepare("UPDATE rob.members SET password='$password' WHERE email = '$email'");
    $stmt->execute();
    header('Location: success.php');
  }
  else {
    header('Location: nologin.php');
  }
}
catch(PDOException $e)
{
  header('Location: error.php');
}


 ?>
