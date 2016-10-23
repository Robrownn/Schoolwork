<?php

$servername = "localhost";
$username = "rob";
$password = "AbAcAb190";
$dbname = "rob";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $email = $_POST['email'];
  $pin = rand(1000,9999);

  $update = $conn->prepare("UPDATE rob.members SET locked = 1 WHERE email = '$email'");
  $update->execute();

  $hashedPIN = password_hash($pin,PASSWORD_DEFAULT);

  $update = $conn->prepare("UPDATE rob.members SET PIN = $hashedPIN WHERE email = '$email'");
  $update->execute();

  emailPIN();

  header('Location: success.php');
}catch(PDOException $e) {
  header('Location: error.php');
}

function emailPIN() {
  $to = $email;
  $subject = "Unlock PIN @ notturing.ddns.net";

  $message = "
              <html>
              <head>
              <title>Unlock Pin @ notturing.ddns.net</title>
              </head>
              <body>
              <p>Here is your PIN: <b>" . $pin . "</b></p>
              <a href=\"https://notturing.ddns.net/rob/IS_ASS2/lockedout.php\">Unlock your account here!</a>
              </body>
              </html>
              ";

  // Always set content-type when sending HTML email
  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
  // More headers
  $headers .= 'From: <rob@notTuring.ddns.net>' . "\r\n";
  mail($to,$subject,$message,$headers);
}

 ?>
