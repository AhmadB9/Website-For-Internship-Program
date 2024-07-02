<?php
session_start();
require 'connection.php';
$id;
$email=$password="";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $email=$_POST["email"];
    $password=$_POST["password"];
    $sql = "SELECT id FROM intern where email='$email' and password='$password' ";
    $result = mysqli_query($con, $sql);
    $sql_instructor = "SELECT id FROM instructor where email='$email' and password='$password' ";
    $result_instructor = mysqli_query($con, $sql_instructor);
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $_SESSION["id"]=$row["id"];
      header("Location:admin/intern_profile.php");
    
    } else if (mysqli_num_rows($result_instructor) > 0) {
        $row = mysqli_fetch_assoc($result_instructor);
        $_SESSION["id"]=$row["id"];
        header("Location:admin/instructor_profile.php");
      }
    
    else echo  "<script>alert('Invalid Email or Password');</script>";
}

?>


<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">

  <title>Login</title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,600,700&display=swap" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />

</head>

<body class="sub_page">
  <div class="hero_area">
    <!-- header section strats -->
    <div class="hero_bg_box">
      
    </div>
      <div class="header_bottom">
        <div class="container-fluid">
          <nav class="navbar navbar-expand-lg custom_nav-container">
            <a class="navbar-brand" href="index.html">
              <span>
                <img src="images/idslogo.png" style="width: 100px;height=75px">
              </span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class=""></span>
            </button>

            <div class="collapse navbar-collapse ml-auto" id="navbarSupportedContent">
              <ul class="navbar-nav  ">
                <li class="nav-item ">
                  <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="about.php"> About</a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="internship_programs.php"> Upcoming Programs<span class="sr-only">(current)</span> </a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="login.php">Login</a>
                </li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </header>
    <!-- end header section -->
  </div>

  <!-- contact section -->

  <section class="contact_section layout_padding">
    <div class="contact_bg_box">
      <div class="img-box">
      </div>
    </div>
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
        Login
        </h2>
      </div>
      <div class="">
        <div class="row">
          <div class="col-md-7 mx-auto">
            <form method="post">
              <div class="contact_form-container">
                <div>
                    <label>Email:</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required >
                </div>
                <div>
                    <label>Password:<span class="error"></label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required >
                </div>
                <div class="btn-box ">
                    <button type="submit">
                      Submit
                    </button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  

  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/custom.js"></script>
</body>

</html>