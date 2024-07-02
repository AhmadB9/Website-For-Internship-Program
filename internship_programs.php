<?php
require 'connection.php';
$email=$phone=$body="";
$requirement="";
$data=array();
$secretKey = "YourSecretKey"; 
$iv = openssl_random_pseudo_bytes(16);
$sql = "SELECT * FROM indexpage";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $location=$row["location"];
        $email=$row["email"];
        $phone=$row["phonenumber"];
        $body=$row["body"];
    }
  }
function get_upcomingprograms($con){
    $data=array();
    $today = date("Y-m-d");
    $sql = "SELECT * FROM program WHERE startregistration >='$today'";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $data[]=$row;
  }
  return $data;}
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

  <title>IDS Academy</title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,600,700&display=swap" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    <div class="hero_bg_box">
      <div class="img-box">
      </div>
    </div>

    <header class="header_section">
      <div class="header_top">
        <div class="container-fluid">
          <div class="contact_link-container">
            <a href="https://www.google.com/maps/search/integrate+digital+software+location/@33.8483072,35.4424761,12z/data=!3m1!4b1?entry=ttu" class="contact_link1">
              <i class="fa fa-map-marker" aria-hidden="true"></i>
              <span>
                <?php echo $location;?>
              </span>
            </a>
            <a href="" class="contact_link2">
              <i class="fa fa-phone" aria-hidden="true"></i>
              <span>
              <?php echo $phone;?>
               </span>
            </a>
            <a href="" class="contact_link3">
              <i class="fa fa-envelope" aria-hidden="true"></i>
              <span>
              <?php echo $email;?>
              </span>
            </a>
          </div>
        </div>
      </div>
      <div class="header_bottom">
        <div class="container-fluid">
          <nav class="navbar navbar-expand-lg custom_nav-container">
            <img src="images/idslogo.png" style="width: 100px;height=75px">
        
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class=""></span>
            </button>

            <div class="collapse navbar-collapse ml-auto" id="navbarSupportedContent">
              <ul class="navbar-nav  ">
                <li class="nav-item ">
                  <a class="nav-link" href="index.php">Home </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="about.php"> About</a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="internship_programs.php"> Upcoming Programs<span class="sr-only">(current)</span> </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="login.php">Login</a>
                </li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </header> 
    <!-- end header section --> 
    <!-- slider section -->  
    <section class=" slider_section ">
        <?php 
        $data=get_upcomingprograms($con);
        $program_array=array();
        if(!empty($data)){
            $encryptedid=$data[0]["id"];
            $encryptedData = openssl_encrypt($encryptedid, 'aes-128-cbc', $secretKey, 0, $iv);
            $encodedIV = urlencode(base64_encode($iv));
            $encodedData = urlencode(base64_encode($encryptedData));
            echo' <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <div class="container">
                  <div class="row">
                    <div class="col-md-7">
                      <div class="detail-box">
                        <h1>
                        New Online Intership  <br>
                          <span>
                            '.$data[0]["title"].' Program
                          </span>
                        </h1>
                        <p>
                       '.$body.'
                        </p>
                        <div class="btn-box">
                          <a href="program.php?iv='.$encodedIV.'&id='.$encodedData.'" class="btn-1"> More Details </a>
                          </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
            ';
            for($i=1;$i<count($data);$i++){
              $encryptedid=$data[$i]["id"];
              $encryptedData = openssl_encrypt($encryptedid, 'aes-128-cbc', $secretKey, 0, $iv);
              $encodedIV = urlencode(base64_encode($iv));
              $encodedData = urlencode(base64_encode($encryptedData));
              echo '
            <div class="carousel-item ">
              <div class="container">
                <div class="row">
                  <div class="col-md-7">
                    <div class="detail-box">
                    <h1>
                    New Online Intership <br>
                      <span>
                      '.$data[$i]["title"].' Program
                      </span>
                    </h1>
                    <p>
                    '.$body.'
                    </p>
                    <div class="btn-box">
                      <a href="program.php?iv='.$encodedIV.'&id='.$encodedData.'" class="btn-1"> More Details </a>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>';
            }

        }else echo'
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container">
              <div class="row">
                <div class="col-md-7">
                  <div class="detail-box">
                    <h1>
                     No available Program<br>
                      <span>
                        Thank for your visit 
                      </span>
                    </h1>
                    <p>
                    
                    </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>';
        ?>
      
        <div class="container idicator_container">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
        </div>
      </div>
    </section>
   
  </div>

  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/custom.js"></script>
</body>

</html>