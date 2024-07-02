<?php
require 'connection.php';
require 'C:\xampp\htdocs\ids\IDS web\function.php';
$program=$about=$start_date=$end_date=$end_registration=$requirement=$start_registration="";
$today = date("Y-m-d");
$secretKey = "YourSecretKey"; 
$encodedIV = $_GET['iv'];
$encodedData = $_GET['id'];
$iv = base64_decode(urldecode($encodedIV));
$encryptedData = base64_decode(urldecode($encodedData));
$decryptedData = openssl_decrypt($encryptedData, 'aes-128-cbc', $secretKey, 0, $iv);
$id=$decryptedData;
$row=get_progrom_details($con,$id);
$program=$row["title"];
$start_date=$row["startdate"];
$end_date=$row["enddate"];
$about=$row["description"];
$capacity=$row["maxcapacity"];
$current_registered=$row["currentcapacity"];
$end_registration=$row["endregistration"];
$requirement=$row["requirement"];
$start_registration=$row["startregistration"];
   


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

  <title>Program's Details</title>

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
      <div class="img-box">
        <img src="images/hero-bg.jpg" alt="">
      </div>
    </div>

    <header class="header_section">
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
                <li class="nav-item active">
                  <a class="nav-link" href=""> Program Details </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="login.php"> Login</a>
                </li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </header>
    <!-- end header section -->
  </div>

  <!-- service section -->

  <section class="service_section layout_padding ">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Program's Details
        </h2>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="box ">
            <div class="detail-box">
              <h6>
                Requirements
              </h6>
                
                <?php  $delimiter = ",";
                    $req=explode($delimiter,$requirement);
                    for($i=0;$i<count($req);$i++){
                        echo '<p>'.$req[$i].'</p>';  }?>
                    
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="box ">
           
            <div class="detail-box">
              <h6>
                More Details
              </h6>
              <p>Program Title : <span><?php echo $program?></span></p>
              <p>Start of registration:<span><?php echo $start_registration;?></span></p>
              <p>End of registration:<span><?php echo $end_registration;?></span></p>
              <p>Start Date: <?php echo $start_date;?> </p>
              <p>End Date:  <?php echo $end_date ;?></p>
              <p>Current Registered:<?php echo $current_registered;?></p>
              <p>Capacity:  <?php echo $capacity;?></p>
              <?php if($capacity!=$current_registered && ($start_registration<=$today && $end_registration >=$today))
                        echo'<a href="apply.php?id='.$id.'">
                         Join now
                        </a>' ;
                    else if($capacity==$current_registered)
                            echo '<u style="color:red;">Our program has reached full capacity at this time</u>'?>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="box ">
            
            <div class="detail-box">
              <h6>
                Description
              </h6>
              <?php
              echo
              '<p>
               '.$about.'
              </p>';?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end service section -->

  <!-- info section -->
  
  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/custom.js"></script>
</body>

</html>




