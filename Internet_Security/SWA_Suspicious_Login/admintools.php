<?php
session_start();

if(!isset($_SESSION['email'])) {
  header('Location: index.php');
}

$servername = "localhost";
$username = "rob";
$password = "AbAcAb190";
$dbname = "rob";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {

  header('Location: error.php');
}

$stmt = $conn->prepare("SELECT acl FROM rob.members WHERE email=:email");
$stmt->bindParam(":email", $_SESSION['email']);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$aclFlag = $row['acl'];

if ($aclFlag != 1) {
  header('Location: error.php');
}
 ?>

 <!DOCTYPE html>
 <html lang="en">

 <head>

     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta name="description" content="">
     <meta name="author" content="">

     <title>Internet Security - Assignment 2</title>
     <script type="text/JavaScript" src="js/sha512.js"></script>
     <script type="text/JavaScript" src="js/forms.js"></script>

     <!-- Bootstrap Core CSS -->
     <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

     <!-- Custom Fonts -->
     <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
     <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
     <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

     <!-- Custom CSS -->
     <link href="css/custom.css" rel="stylesheet">

     <!-- Theme CSS -->
     <link href="css/grayscale.min.css" rel="stylesheet">

     <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
     <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
     <!--[if lt IE 9]>
         <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
         <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
     <![endif]-->


 </head>

 <body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
   <?php
   if (isset($_GET['error'])) {
     echo '<p class="error">Error Logging In!</p>';
   }
   ?>

     <!-- Navigation -->
     <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
         <div class="container">
             <div class="navbar-header">
                 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                     Menu <i class="fa fa-bars"></i>
                 </button>
                 <a class="navbar-brand page-scroll" href="#page-top">
                     <i class="fa fa-play-circle"></i> <span class="light">Robert</span> Brown
                 </a>
             </div>

           <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
               <ul class="nav navbar-nav">
                 <li>
                   <a href="logout.php">Logout</a>
                 </li>
                   <li>
                       <a class="page-scroll" href="home.php">Back</a>
                   </li>
                 </ul>
               </div>

             </div>
           </nav>

     <!-- Intro Header -->
     <header class="intro">
         <div class="intro-body">
             <div class="container">
                 <div class="row">
                     <div class="col-md-8 col-md-offset-2">
                         <h1 class="brand-heading">Secure Login</h1>
                         <?php
                         $adminEmail = $_SESSION['email'];
                          printf("<p>$adminEmail</p>");
                          ?>
                         <a href="#login" class="btn btn-circle page-scroll">
                             <i class="fa fa-angle-double-down animated"></i>
                         </a>
                     </div>
                 </div>
             </div>
         </div>
     </header>

     <section id="admin-tools" class="container content-section">
       <div class="row">
         <div class="col-lg-8 col-lg-offset-2">
           <h2>Upgrade a user to admin</h2>
           <form action="upgrade.php" method="post">
             <div class="form-group">
               <label>User's Email</label>
               <input class="form-control" placeholder="Enter Email" type="email" name="newAdminEmail" required>
             </div>
             <div class="form-group">
               <label>Your Password</label>
               <input class="form-control" placeholder="Enter Password" type="password" name="adminPwd" required>
             </div>
             <div class="form-group">
               <input type="submit" class="btn btn-default" value="Upgrade User"></input>
             </div>
           </form>
         </div>
       </div>
       <div class="row">
         <div class="col-lg-8 col-lg-offset-2">
           <h2>Downgrade an admin to user</h2>
           <form action="downgrade.php" method="post">
             <div class="form-group">
               <label>Admin's Email</label>
               <input class="form-control" placeholder="Enter Email" type="email" name="removeAdminEmail" required>
             </div>
             <div class="form-group">
               <label>Your Password</label>
               <input class="form-control" placeholder="Enter Password" type="password" name="adminPwd" required>
             </div>
             <div class="form-group">
               <input type="submit" class="btn btn-default" value="Downgrade Admin"></input>
             </div>
           </form>
         </div>
       </div>
       <div class="row">
         <div class="col-lg-8 col-lg-offset-2">
           <h2>Suspicious Login Attempts</h2>
            <!-- Selects all suspicious results and makes a list of them -->
             <?php
             $stmt = $conn->prepare("SELECT * FROM rob.members");
             $stmt->execute();
             $rowCount = $stmt->rowCount();
             if ($rowCount != 0) {
               for ($i = 1; $i <= $rowCount; $i++) {
                 $lastSuccessIP = $conn->prepare("SELECT ip FROM rob.members WHERE userid = $i");
                 $lastSuccessIP->execute();
                 $lastFailIP = $conn->prepare("SELECT ip FROM rob.login_attempts WHERE userid = $i");
                 $lastFailIP->execute();
                 $locked = $conn->prepare("SELECT locked FROM rob.members WHERE userid = $i");
                 $locked->execute();

                 // if the account is already locked then we don't care to show it.
                 $successIP = $lastSuccessIP->fetch(PDO::FETCH_ASSOC);
                 $failIP = $lastFailIP->fetch(PDO::FETCH_ASSOC);
                 $isLocked = $locked->fetch(PDO::FETCH_ASSOC);


                 if ($successIP['ip'] != $failIP['ip']  && $isLocked['locked'] != 1) {
                   $stmt = $conn->prepare("SELECT * FROM rob.members WHERE userid = $i");
                   $stmt->execute();
                   $stmt2 = $conn->prepare("SELECT * FROM rob.login_attempts WHERE userid = $i");
                   $stmt2->execute();

                   $row = $stmt->fetch(PDO::FETCH_ASSOC);
                   $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                   printf("<form action=\"lockout.php\" method=\"post\">\n
                              <div class=\"form-group\">\n
                                <input type=\"radio\" name = \"email\" value = \"". $row['email'] ."\">" . $row['email'] . "</input>\n
                                <label>Failed Attempts: " . $row2['failed_attempts'] . "</label>\n
                                <input type=\"submit\" class=\"btn btn-default\" value = \"Lock\"></input>\n
                              </div>\n
                            </form>\n");
                 }
               }
            }
              ?>
            </div>
          </div>
     </section>

     <!-- Download Section -->
     <section id="ThankYou" class="content-section text-center">
         <div class="download-section">
             <div class="container">
                 <div class="col-lg-8 col-lg-offset-2">
                     <h2>Thanks!</h2>
                 </div>
             </div>
         </div>
     </section>

     <!-- Footer -->
     <footer>
         <div class="container text-center">
             <p>Copyright &copy; notTuring 2016</p>
         </div>
     </footer>

     <!-- jQuery -->
     <script src="vendor/jquery/jquery.js"></script>

     <!-- Bootstrap Core JavaScript -->
     <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

     <!-- Plugin JavaScript -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

     <!-- Theme JavaScript -->
     <script src="js/grayscale.min.js"></script>



 </body>

 </html>
