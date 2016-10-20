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
  $pin = rand(1000,9999);

  $stmt = $conn->prepare("SELECT * FROM rob.members WHERE (email = '$email')");
  $stmt->execute();

  $login_attempts = $conn->prepare("SELECT failed_attempts FROM rob.login_attempts WHERE email = '$email'");
  $login_attempts->execute();

  $rowCount = $stmt->rowCount();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);


  if ($rowCount == 1 && password_verify($password, $row['password']) && $login_attempts < 5) {
    $_SESSION['email'] = $email;

    $update = $conn->prepare("UPDATE rob.members SET last_login='$datetime' WHERE (email = '$email')");
    $update->execute();

    header('Location: home.php');
  }
  else if ($loggin_attempts == 5) {

    header('Location: lockout.php');
  }
  else {

    $stmt =  $conn->prepare("UPDATE rob.login_attempts SET failed_attempts = failed_attempts + 1, time='$datetime' WHERE email = '$email'");
    $stmt->execute();

    header('Location: nologin.php');
  }
}
catch(PDOException $e) {
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
              <a href=\"https://notturing.ddns.net/rob/IS_ASS2/lockout.php\">Unlock your account here!</a>
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
