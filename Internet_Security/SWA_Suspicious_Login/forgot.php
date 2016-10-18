<?php
session_start();
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
          <h2>Reset Password</h2>
        </div>

        <div class="row">
          <div class="col-md-4">
            <form action="reset.php" method="post">
              <div class="container">
                <label>Email</label>
                <input class="form-control" placeholder="Enter your current email" type="text" name="email" required>
              </div>
              <div class="container">
                <label>New Password</label>
                <input class="form-control" type="password" placeholder="Enter your new password" name="passwordNew" id="password" required>
              </div>
              <div class="container">
                <input type="button" value="Login" class="btn btn-primary" onclick="formhash(this.form, this.form.password);"></input>
              </div>
            </form>
          </div>
        </div>
