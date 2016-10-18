<?php
session_start();

if (isset($_SESSION['email'])) {
  header('Location: home.php');
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
                      <a class="page-scroll" href="../../index.html">Back</a>
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
                        <a href="#login" class="btn btn-circle page-scroll">
                            <i class="fa fa-angle-double-down animated"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>


    <section id="login" class="container content-section text-center">
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
          <h2>Secure Loginer</h2>
        </div>

        <div class="row">
          <div class="col-md-4">
            <form action="login.php" method="post">
              <div class="container">
                <label>Email</label>
                <input class="form-control" placeholder="Enter Email" type="email" name="email" required>
              </div>
              <div class="container">
                <label>Password</label>
                <input class="form-control" type="password" placeholder="Enter password" name="password" id="password" required>
              </div>
              <div class="container">
                <input type="submit" class="btn btn-primary" value="Login"></input>
              </div>
            </form>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="container">
              <a class="btn btn-default" href="register.php">Create</a>
              <span class="psw">Forgot <a data-toggle="modal" data-target="#forgetModal">password?</a></span>
            </div>
          </div>
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

    <!-- Forgot Password Modal -->
    <div id="forgetModal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">

        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Forgot Password</h4>
          </div>
          <div class="modal-body">
            <form action="forget.php" method="post">
                <div class="form-group">
                  <label>Email</label>
                  <input class="form-control" placeholder="Enter Email" type="text" name="emailForget" required></input>
                </div>
                <div class="form-group">
                  <label>Security Question</label>
                  <input class="form-control" placeholder="Enter your security question" type="text" name="secQForget" required></input>
                </div>
                <div class="form-group">
                  <label>Security Answer</label>
                  <input class="form-control" placeholder="Enter your security answer" type="text" name="secAForget" required></input>
                </div>
                <div class="form-group">
                  <label>New Password</label>
                  <input class="form-control" placeholder="Enter your new password" type="password" name="newPassword" required></input>
                </div>
                <div class="container">
                  <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>

</body>

</html>
