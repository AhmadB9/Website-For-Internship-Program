<?php
require 'connection.php';
require 'function.php';
$current_registered;
$id;
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $current_registered=$_GET["currentcapacity"];
}
$start_date="";
$fullname=$email=$graduation_Date=$pass=$university=$major=$city=$phonenumber="";
$errormessage="";
$apologize_message="";
$cv="";
function user_exist($con,$email){
    $sql="SELECT * from intern WHERE email='$email'";
    $result=mysqli_query($con,$sql);
    if(mysqli_num_rows($result)>0){
        return true;
    }else return false;
}

function get_internid($con,$email){
    $internid_sql="SELECT id FROM intern WHERE email='$email'";
    $interid_result = mysqli_query($con, $internid_sql);
    $internid_row=mysqli_fetch_assoc($interid_result);
    return $internid_row["id"];
    
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $start_date=get_startdate($con,$id);
    $fullname = (string)$_POST["name"];
    $email = (string)$_POST["email"];
    $university = (string)$_POST["university"];
    $major = (string)$_POST["major"];
    $city = (string)$_POST["city"];
    $pass = (string)$_POST["password"];
    $phonenumber = (integer)$_POST["phonenumber"];
    $graduation_Date = (string)$_POST["date"];
    $today=date("Y-m-d");
    if(user_exist($con,$email)==false){
        $uploadDirectory = "admin/CV/"; 
        $pdfFileType = strtolower(pathinfo($_FILES["pdf_file"]["name"], PATHINFO_EXTENSION));
        if ($pdfFileType == "pdf") {
            $targetFile = $uploadDirectory.$email.".pdf";
            $cv='CV/'.$email;
            if (move_uploaded_file($_FILES["pdf_file"]["tmp_name"], $targetFile)) {
                $insert_sql="insert into intern(fullname,email,password,phonenumber,city,university,graduationdate,major,joiningdate,cv) VALUES('$fullname','$email','$pass','$phonenumber','$city','$university','$graduation_Date','$major','$today','$cv')";
                if(mysqli_query($con, $insert_sql)) {
                    $internid=get_internid($con,$email);
                    $joining_sql="insert into internsinprogram(programid,internid) VALUES('$id','$internid')";
                    if(mysqli_query($con, $joining_sql)){
                        $new_current_registered=$current_registered+1;
                        $update_capacity_sql="UPDATE program SET currentcapacity=$new_current_registered where id='$id'";
                        if(mysqli_query($con, $update_capacity_sql)){
                            echo'<script>alert("Registration Successful!Thank you for joining our program.");
                            window.location.replace("http://localhost/IDS/IDS%20web/index.php");</script>'; 
                            }
                    }else echo "Error: " . mysqli_error($con);
                }else echo "Error: " . mysqli_error($con); 
           
            }else echo "Error uploading the file.";
        } else $errormessage= "Only PDF files are allowed.";
    }else{
        $internid=get_internid($con,$email);
        if(is_user_inprogram($con,$id,$internid))
            echo'<script>alert("You are already join this program")</script>';
        else{
            $conflict_check=0;
            $enddate_sql="SELECT program.enddate From program JOIN internsinprogram ON program.id=internsinprogram.programid Where internsinprogram.internid=$internid";
            $enddate_result = mysqli_query($con, $enddate_sql);
            if (mysqli_num_rows($enddate_result) > 0) {
                while ($row = mysqli_fetch_assoc($enddate_result)) {
                    if($start_date > $row["enddate"]){
                        $conflict_check++;
                    }
                }
            }if(mysqli_num_rows($enddate_result)==$conflict_check){
                $joining_sql="insert into internsinprogram(programid,internid) VALUES('$id','$internid')";
                if(mysqli_query($con, $joining_sql)){
                    $new_current_registered=$current_registered+1;
                    $update_capacity_sql="UPDATE program SET currentcapacity=$new_current_registered where id='$id'";
                    if(mysqli_query($con, $update_capacity_sql)){
                        echo'<script>alert("Registration Successful!Thank you for joining our program.");
                          window.location.replace("http://localhost/IDS/IDS%20web/index.php");</script>'; 
                    }        
                }
            }else{
              echo'<script>alert("Conflict Detected!!!!Sorry, you cannot register two programs at the same time.For more informotion visit your page.");
              window.location.replace("http://localhost/IDS/IDS%20web/login.php");</script>';

            }
        }        

    }
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

  <title>Register</title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,600,700&display=swap" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
  <style>
   .error{
      color:red;
}
  </style>
  <script>
    function validation(){
    var regexname = /^[\s A-Za-z]+$/;
    var valid=0;
    var today=new Date();
    const fullname = document.getElementById("name").value;
    const phonenumber = document.getElementById("phonenumber").value;
    const graduationdate = new Date(document.getElementById("date").value);
    if(!regexname.test(fullname)){
        document.getElementById("nameEorrr").textContent="Your name should contain only letters";
        valid++;
    }
    
    if(today >= graduationdate){
        document.getElementById("graduationError").textContent="Please enter your graduation date correctly";
        valid++;
    }
    if(valid !=0 ){
        return false;
    }
    else return true;
    
}
  </script>
</head>

<body class="sub_page">
  <div class="hero_area">
    <!-- header section strats -->
    <div class="hero_bg_box">
      <div class="img-box">
        <img src="images/hero-bg.jpg" alt="">
      </div>
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
                <li class="nav-item active">
                  <a class="nav-link" href="apply.php">Apply</a>
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
        Enter The Following Information
        </h2>
      </div>
      <div class="">
        <div class="row">
          <div class="col-md-7 mx-auto">
            <form id="form" onsubmit=" return validation()"  method="post" enctype="multipart/form-data">
              <div class="contact_form-container">
                <div>
                  <div>
                    <label>Full Name:<span id="nameEorrr" class="error"></span></label>
                    <input type="text" id="name" name="name" placeholder="Enter your full name" required >
                  </div>
                  <div>
                    <label>Email:</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required >
                  </div>
                  <div>
                    <label>Password:</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required >
                  </div>
                  <div>
                    <label>Phone Number:</label>
                    <input type="Number" id="phonenumber" name="phonenumber" placeholder="Enter your phone number" required>
                  </div>
                  <div>
                    <label>City:</label>
                    <input type="text" id="city" name="city" placeholder="Enter your major" required>
                  </div>
                  <div>
                  <div>
                    <label>University: </label>
                    <input type="text" id="university" name="university" placeholder="Enter your university" required >
                  </div>
                  <div>
                    <label>Major:</label>
                    <input type="text" id="major" name="major" placeholder="Enter your major" required>
                  </div>
                  <div>
                  <label>Graduation Date:<span id="graduationError" class="error"></span> </label> 
                  <input type="date" id="date" name="date" required>
                  <label>CV: <span class="error"></span></label>
                  <input type="file" name="pdf_file" id="pdf_file" accept=".pdf" required>
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