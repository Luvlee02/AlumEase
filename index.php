<?php
include "conn.php";
session_start();

function filterTable($query)
{
    $conn = mysqli_connect("localhost", "root", "", "jobportal");
    $filter_Result = mysqli_query($conn, $query);
    return $filter_Result;
}

if (isset($_POST['search'])) {
    $search = mysqli_real_escape_string($conn, $_POST['search']);
    $sql = "SELECT * FROM add_jobs WHERE id LIKE '%$search%' OR job_title LIKE '%$search%'
        OR job_type LIKE '%$search%' OR location LIKE '%$search%'";
    $search_result = mysqli_query($conn, $sql);
} else {
    $query = "SELECT * FROM `add_jobs`";
    $search_result = filterTable($query);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>ALUMEASE</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

      <h2 class="logo me-auto"><a href="index.php">AlumEase</a></h2>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo2.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero"><b>Home</b></a></li>
          <li><a class="nav-link scrollto" href="#about"><b>About</b></a></li>
          <li><a class="nav-link scrollto" href="#jobs"><b>Jobs</b></a></li>
          <li><a class="nav-link scrollto" href="#services"><b>Services</b></a></li>
          <li><a class="nav-link scrollto" href="#contact"><b>Contact</b></a></li>
          <li><a class="register" data-bs-toggle="modal" data-bs-target="#exampleModal1"><b>Login</b></a></li>
          <li><a class="register" data-bs-toggle="modal" data-bs-target="#exampleModal2"><b>Register</b></a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

<!-- Modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">LOGIN</h5>
      </div>

      <div class="modal-body">
            <form action="process.php" method ="POST">

            <label><b>Email</b></label>
            <div class="input-group mb-3">
            <div class="input-group-text">
            <i class="bi bi-envelope-at"></i>
            </div>
             <input type="text" placeholder="Enter Email" name="email" class="form-control" required></p>
            </div>

            <label><b>Password</b></label>
            <div class="input-group mb-3">
            <div class="input-group-text">
            <i class="bi bi-key"></i>
            </div>

            <input type="password" placeholder="Enter Password" name="password" class="form-control" 
             placeholder="Enter Password" id="Password1" required></p>
            </div>

            <div class="mx-auto" style="padding: 10px;">
              <input type="checkbox" onclick="myFunction()">Show Password
            </div>
        
                <div class="modal-footer">
                  <input type="reset" class="btn btn-dark" value ="CLEAR">
                  <input type="submit" class="btn btn-success" name = "loginform" value ="LOGIN"></p>   
                </div>
            </form>
      </div>
      
    </div>
  </div>
</div>

<script>
function myFunction() {
  var x = document.getElementById("Password1");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>


<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">REGISTER</h5>
      </div>
      <div class="modal-body">
      
        <form action="process.php" method ="POST">
        <div class="row">
           <div class="col">
              <label><b>User Type</b></label>
                <select class= "form-select" name="user_type">
                    <option selected> </option>
                    <option value="4">Company</option>
                    <option value="5">Alumni</option>
                </select>
           </div>
          
           <div class="col ">
              <input type="hidden" name="user_status" value="Pending">        
                </div>
              </div>

            
                    <label><b>Email</b></label>
                      <div class="input-group mb-3">
                      <div class="input-group-text">
                      <i class="bi bi-envelope-at"></i>
                      </div>
                      <input type="text" placeholder="Enter Email" name="email" class="form-control" required></p>
                      </div>
                     
                      <label><b>Password</b></label>
                      <div class="input-group">
                      <div class="input-group-text">
                        <i class="bi bi-key"></i>
                      </div>
                      
                      <input type="password" name="password" placeholder="Enter Password" 
                      class="form-control" id="Password2" 
                      pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                      title="Must contain at least one number and one uppercase and lowercase letter, 
                      and at least 8 or more characters" required></p>
                    </div>

                    <div class="mx-auto" style="padding: 10px;">
                      <input type="checkbox" onclick="myFunctions()">Show Password
                    </div>
         
              <div class="modal-footer">
                <input type="reset" class="btn btn-dark" value="CLEAR"  >
              <input type="submit" name="users_reg" class="btn btn-success" value="REGISTER"  >
              </div>
            </form>
          </div>
        </div>
      </div>
      </div>

<script>
function myFunctions() {
  var x = document.getElementById("Password2");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

  <!-- ======= Section ======= -->

  <section id="hero" class="hero">
    <div class="container position-relative">
      <div class="row gy-5" data-aos="fade-in">
        <div class="col-lg-7 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-start">
          <h1>Your Gateway to Career<span> Opportunities with PHINMA UI</span></h1>
          <p><b>Join us today and take the next step 
            <br>towards your dream job.</b></p>
          <div class="d-flex justify-content-center justify-content-lg-start">
            <a href="reg.php" class="btn-find-job" data-bs-toggle="modal" data-bs-target="#exampleModal1"><b>Find a Job</b></a>
            <a href="reg.php" class="btn-post-job"data-bs-toggle="modal" data-bs-target="#exampleModal1"><b>Post a Job</b></a>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>
<!-- End Hero Section -->

    <main id="main">
<!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>About Us</h2>
        </div>

        <div class="row content">
          <div class="col-lg-6">
            <p>
              "AlumEase: Your Gateway to Career Opportunities with PHINMA-UI" is designed to offer a range of resources and tools to help alumni find jobs.
            </p>
            <ul>
              <li><i class="ri-check-double-line"></i>Connects alumni with job opportunities.</li>
              <li><i class="ri-check-double-line"></i>Provides access to career development resources.</li>
              <li><i class="ri-check-double-line"></i>Let alumni browse job listings and connects them with each other and potential employers.</li>
            </ul>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0">
            <p>
              The AlumEase: Your Gateway to Career Opportunities with PHINMA-UI allows alumni to register for the portal by giving their details, view jobs posted by the admin and alumni, and apply for job openings. 
              This portal is designed to be an easy-to-use platform that allows alumni to explore job opportunities in leading organizations. 
            </p>
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->



      <!-- ======= Jobs Section ======= -->
      <main>

      <section id="jobs" class="job">
          <div class="section-title">
            <h2>Featured Jobs</h2>
          </div>
          
          <div class = "job-content">
              <?php
                    $get_data = "SELECT t1.id, t2.fname, t3.job_title, t3.location, t3.job_type, t3.date_posted
                    FROM users t1
                    LEFT OUTER JOIN user_profile t2
                    ON t1.id = t2.id 
                    LEFT OUTER JOIN add_jobs t3
                    ON t1.id = t3.id
                    WHERE t1.user_type = '4' ORDER BY `date_posted` DESC";
                    $data = mysqli_query($conn, $get_data);
                    while($row = mysqli_fetch_array($data)){
              ?>
              
                      <div class ="container">
                        <div class="card mb-2" style="width: 18rem;">
                          <div class="row g-0">
                            <div class="col">
                              <img src="assets/img/th2.jpeg" class="rounded mx-auto d-block" alt="...">
                              <div class="card-body text-center">
                              <h5 class="card-title"><?php echo $row ['job_title'];?></h5>
                              <h5 class="mb-3"></h5>
                              <p><?php echo $row ['fname'];?></p>
                                <p><?php echo $row ['job_type'];?></p>
                                <p><?php echo $row ['location'];?></p>
                                <p<small class="text-muted"><?php echo date("F j, Y", $row['date_posted'])?></small></p>
                                <a href="reg.php" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal1">View Details</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                        <?php } ?>
                    </div>
                </div>
              </main>
  <!-- Jobs End -->


    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Career Services</h2>
        </div>

        <div class="row">
          <div class="col-xl-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-file"></i></i></div>
              <h4><a href="">Upcoming Events</a></h4>
              <p>Get special access to upcoming career, networking, and learning events.</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-stack"></i></div>
              <h4><a href="">Career Reflections</a></h4>
              <p>Considering changing careers? Explore the career reflections video series, which features graduates discussing their successful career journeys and illuminating ideas.</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-calendar2-event"></i></div>
              <h4><a href="">Career Webinars & Events</a></h4>
              <p>Gain access to career guidance and assistance for life. Sign up for the employment portal, receive individualized coaching, attend professional webinars, and more.</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="400">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-search"></i></div>
              <h4><a href="">Job Portal</a></h4>
              <p>Looking to change careers? or bringing in outstanding talent? Log in to the AlumEase Job Portal, a website exclusive for alumni with job openings from companies all over the world.</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Services Section -->


    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Contact</h2>
        </div>

        <div class="row">

          <div class="col-lg-5 d-flex align-items-stretch">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Location:</h4>
                <p>Iloilo City</p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>alum@ease.com</p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Call:</h4>
                <p>+(339)4487029</p>
              </div>

              <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
            </div>

          </div>

          <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="name">Name</label>
                  <input type="text" name="name" class="form-control" id="name" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="name">Email</label>
                  <input type="email" class="form-control" name="email" id="email" required>
                </div>
              </div>
              <div class="form-group">
                <label for="name">Subject</label>
                <input type="text" class="form-control" name="subject" id="subject" required>
              </div>
              <div class="form-group">
                <label for="name">Message</label>
                <textarea class="form-control" name="message" rows="10" required></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">


    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>IT SESSIONISTAS</h3>
            <p>Iloilo City <br>
              <strong>Phone:</strong> +(339)4487029<br>
              <strong>Email:</strong> alum@ease.com<br>
            </p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#hero">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#about">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#services">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#services">Upcoming Events</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#services">Career Reflections</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#services">Career Webinars & Events</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#jobs">Career Opportunities</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Social Networks</h4>
            <div class="social-links mt-3">
              <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
              <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
              <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="container footer-bottom clearfix">
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>




  
  <!-- Login Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login as Admin</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="process.php" method="POST">
          <div class="input-group mb-3">
            <div class="input-group-text">
              <i class="bi bi-envelope-at-fill"></i>
            </div>
            <input type="email" name="email" required placeholder="Enter Email" class="form-control">
          </div>
          
          <div class="input-group">
            <div class="input-group-text">
              <i class="bi bi-key-fill"></i>
            </div>
            <input type="password" class="form-control" name="pass" required placeholder="Enter Password" id="myPassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
          </div>
          <input type="checkbox" onclick="myFunction1()">Show Password
        
      </div>
      <div class="modal-footer">
        <input type="reset" value="Clear"class="btn btn-secondary" >
        <input type="submit" name="login" value="LOGIN" class="btn btn-primary">
      </div>
    </form>
    </div>
  </div>
</div>

<script>
function myFunction1() {
  var x = document.getElementById("myPassword");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login as Alumni</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="process.php" method="POST">
          <div class="input-group mb-3">
            <div class="input-group-text">
              <i class="bi bi-envelope-at-fill"></i>
            </div>
            <input type="email" name="email" required placeholder="Enter Email" class="form-control">
          </div>
          
          <div class="input-group">
            <div class="input-group-text">
              <i class="bi bi-key-fill"></i>
            </div>
            <input type="password" class="form-control" name="pass" required placeholder="Enter Password" id="myPassword2" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
          </div>
          <input type="checkbox" onclick="myFunction2()">Show Password
        

      </div>
      <div class="modal-footer">
        <input type="reset" value="Clear"class="btn btn-secondary" >
        <input type="submit" name="alumni_login" value="LOGIN" class="btn btn-primary">
        
      </div>
    </form>


    </div>
  </div>
</div>

<script>
function myFunction2() {
  var x = document.getElementById("myPassword2");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>


<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login as Company</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="process.php" method="POST">
          <div class="input-group mb-3">
            <div class="input-group-text">
              <i class="bi bi-envelope-at-fill"></i>
            </div>
            <input type="email" name="email" required placeholder="Enter Email" class="form-control">
          </div>
          
          <div class="input-group">
            <div class="input-group-text">
              <i class="bi bi-key-fill"></i>
            </div>
            <input type="password" class="form-control" name="pass" required placeholder="Enter Password" id="myPassword3" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
          </div>
          <input type="checkbox" onclick="myFunction3()">Show Password
        

      </div>
      <div class="modal-footer">
        <input type="reset" value="Clear"class="btn btn-secondary" >
        <input type="submit" name="company_login" value="LOGIN" class="btn btn-primary">
        
      </div>
    </form>


    </div>
  </div>
</div>

<script>
function myFunction3() {
  var x = document.getElementById("myPassword3");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>


<div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Register as Alumni</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="process.php" method="POST">
          <div class="input-group mb-3">

          <div class="input-group mb-3">
            <div class="input-group-text">
              <i class="bi bi-person-fill"></i>
            </div>
            <input type="text" name="name" required placeholder="Enter Full Name" class="form-control">
          </div>

          <div class="input-group mb-3">
            <div class="input-group-text">
              <i class="bi bi-person-fill"></i>
            </div>
            <input type="text" name="course" required placeholder="Enter Course" class="form-control">
          </div>

            <div class="input-group-text">
              <i class="bi bi-envelope-at-fill"></i>
            </div>
            <input type="email" name="email" required placeholder="Enter Email" class="form-control">
          </div>

    
          <div class="input-group">
            <div class="input-group-text">
              <i class="bi bi-key-fill"></i>
            </div>
            <input type="password" class="form-control" name="pass" required placeholder="Enter Password" id="myPassword4" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
          </div>
          <input type="checkbox" onclick="myFunction4()">Show Password

        
      </div>
      <div class="modal-footer">
        <input type="reset" value="Clear"class="btn btn-secondary" >
        <input type="submit" name="alumni_reg" value="Register" class="btn btn-primary">
      </div>
    </form>

    </div>
  </div>
</div>

<script>
function myFunction4() {
  var x = document.getElementById("myPassword4");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>


<div class="modal fade" id="exampleModal5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Register as Company</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="process.php" method="POST">
          <div class="input-group mb-3">

          <div class="input-group mb-3">
            <div class="input-group-text">
              <i class="bi bi-person-fill"></i>
            </div>
            <input type="text" name="name" required placeholder="Enter Full Name" class="form-control">
          </div>

          <div class="input-group mb-3">
            <div class="input-group-text">
              <i class="bi bi-person-fill"></i>
            </div>
            <input type="text" name="company" required placeholder="Enter Company Name" class="form-control">
          </div>

            <div class="input-group-text">
              <i class="bi bi-envelope-at-fill"></i>
            </div>
            <input type="email" name="email" required placeholder="Enter Email" class="form-control">
          </div>

    
          <div class="input-group">
            <div class="input-group-text">
              <i class="bi bi-key-fill"></i>
            </div>
            <input type="password" class="form-control" name="pass" required placeholder="Enter Password" id="myPassword5" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
          </div>
          <input type="checkbox" onclick="myFunction5()">Show Password

        
      </div>
      <div class="modal-footer">
        <input type="reset" value="Clear"class="btn btn-secondary" >
        <input type="submit" name="company_reg" value="Register" class="btn btn-primary">
      </div>
    </form>

    </div>
  </div>
</div>

<script>
function myFunction5() {
  var x = document.getElementById("myPassword5");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
 


</body>

</html>


