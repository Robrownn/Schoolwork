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

  $removeAdminEmail = strtolower($_POST['removeAdminEmail']);
  $adminPwd = $_POST['adminPwd'];
  $adminEmail = strtolower($_SESSION['email']);

  // if they try to remove themselves as admin I tell them they're silly. Who in their right mind would deny themselves of such a premium service?
  if ($adminEmail == $removeAdminEmail) {
    header('Location: silly.php');
  }

  $stmt = $conn->prepare("SELECT * FROM rob.members WHERE (email = '$adminEmail')");
  $stmt->execute();

  $rowCount = $stmt->rowCount();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  // Check if admin's password is correct just in case someone catches the admin's homepage and decides to screw with the user list.
  if ($rowCount == 1 && password_verify($adminPwd, $row['password'])) {

    //try catch just in case the admin enters an email that doesn't exist.
    try {
      $stmt = $conn->prepare("SELECT * FROM rob.members WHERE (email = '$removeAdminEmail')");
      $stmt->execute();

      $rowCount = $stmt->rowCount();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // if the user actually is an admin remove dat sh
      if ($row['acl'] == 1) {
        $stmt = $conn->prepare("UPDATE rob.members SET acl = 0 WHERE (email = '$removeAdminEmail')");
        $stmt->execute();

        header('Location: success.php');
      }
      // otherwise tell them they gave an incorrect login
      else {
        header('Location: nologin.php');
      }

    }
    // if the entered email can't be found tell them there's no account
    catch(PDOException $e) {
      header('Location: nologin.php');
    }
  }
  // if the wrong password is entered give them an unknown error. Rather have them think its a shitty site than have a clue as to what went wrong with a delicate process.
  else {
    header('Location: error.php');
  }
}
catch(PDOException $e) {
  header('Location: error.php');
}

 ?>
