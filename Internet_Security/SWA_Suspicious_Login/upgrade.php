<?php

session_start();

$servername = "localhost";
$username = "rob";
$password = "AbAcAb190";
$dbname = "rob";

$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {

  $newAdminEmail = strtolower($_POST['newAdminEmail']);
  $adminPwd = $_POST['adminPwd'];
  $adminEmail = $_SESSION['email'];

  $stmt = $conn->prepare("SELECT * FROM rob.members WHERE (email = '$adminEmail')");
  $stmt->execute();

  $rowCount = $stmt->rowCount();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  // check if admin password is correct just in case somebody sneaks in and decides to upgrade their or someone else's account to reap the rewards of such a premium service as this.
  if ($rowCount == 1 && password_verify($adminPwd, $row['password'])) {
    try {
      // I don't check if they're already an admin because who cares.
      $stmt = $conn->prepare("UPDATE rob.members SET acl = 1 WHERE (email = '$newAdminEmail')");
      $stmt->execute();

      header('Location: success.php');
    }
    // if an exception is thrown it's because the account entered was not found.
    catch(PDOException $e) {
      header('Location: nologin.php');
    }
  }
  // if the wrong password is entered give them an unknown error. Rather have them think its a shitty site than have a clue as to what went wrong with a delicate process.
  else {
    header('Location: nologin.php');
  }
}
catch(PDOException $e) {
  header('Location: error.php');
}

 ?>
