<?php
session_start();
 ?>
 <!DOCTYPE html>
 <html>
  <head>
    <meta charset="UTF-8">
    <title>Secure Login: Registration Form</title>
    <script tye="text/JavaScript" src="js/sha512.js"></script>
    <script type="text/JavaScript" src="js/forms.js"></script>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

    <!-- Theme CSS -->
    <link href="css/grayscale.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/custom.css" rel="stylesheet">
  </head>
  <body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <?php
    if (!empty($error_msg)) {
      echo $error_msg;
    }
    ?>

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
                <a class="page-scroll" href="index.php">Back</a>
              </li>
            </ul>
          </div>

        </div>
      </nav>

      <header class="intro">
        <div class="intro-body">
          <div class="container">
            <div class="row">
              <div class="col-md-8 col-md-offset-2">
                <h1 class="brand-heading">Secure Login</h1>
                  <a href="#registration" class="btn btn-circle page-scroll">
                    <i class="fa fa-angle-double-down animated"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </header>

        <section id="registration" class="container content-section text-center">
          <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
              <h2>Registration</h2>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-8" id="regsect">
              <ul>
                <li>Usernames may contain digits, upper and lowercase letters, and underscores</li>
                <li>Emails must follow a valid email format</li>
                <li>Passwords must be at least 6 characters long</li>
                <li>Passwords must contain:
                  <ul>
                    <li>At least one uppercase letter (A..Z)</li>
                    <li>At least one lowercase letter (a..z)</li>
                    <li>At least one number (0..9)</li>
                  </ul>
                </li>
                <li>Your password and confirmation must match exactly</li>
              </ul>
              <form action="registration.php"
                      method="post"
                      name="registration_form">
                <div>
                  <label>Username:</label>
                  <input class="form-control" type="text" name="username" id="username"></input>
                </div>

                <div>
                  <label>Email:</label>
                  <input class="form-control" type="text" name="email" id="email"></input>
                </div>

                <div>
                  <label>Password:</label>
                  <input class="form-control" type="password" name="password" id="password"></input>
                </div>

                <div>
                  <label>Confirm Password</label>
                  <input class="form-control" type="password" name="confirmedpwd" id="confirmedpwd"></input>
                </div>

                <div>
                  <label>Security Question:</label>
                  <input class="form-control" type="text" placeholder="Enter your security question"name="secQuestion" id="secQuestion" required></input>
                </div>

                <div>
                  <label>Security Answer:</label>
                  <input class="form-control" type="text" placeholder="Enter the answer to your security question" name="secAnswer" id="secAnswer" required></input>
                </div>

                <div>
                  <br>
                  <input type="submit" class="btn btn-primary" value="Register"></input>
                </div>
              </form>
            </div>
          </div>
        </section>

        <section id="Return" class="content-section text-center">
            <div class="download-section">
                <div class="container">
                    <div class="col-lg-8 col-lg-offset-2">
                        <h2>Return to the <a href="index.php">login page</a>.</h2>
                    </div>
                </div>
            </div>
        </section>

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
