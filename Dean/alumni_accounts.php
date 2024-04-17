<?php
  include "../conn.php";
  session_start();

  if(!isset($_SESSION['sess_id'])){
    header("refresh: 2; url=login.php");
  }else{
    $browserId = $_SESSION['sess_id'];
    $accountStatement = "SELECT * FROM `users` t1 INNER JOIN `user_profile` t2 ON t1.`id`=t2.`id` WHERE t1.`id`=$browserId";
    $accountQuery = mysqli_query($conn, $accountStatement);
    $a = mysqli_fetch_array($accountQuery);

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALUMEASE</title>
    <link rel="stylesheet" href="../astyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>


    <input type="checkbox" id="check">
    <!---header area start -->
    <header>
        <label for="check">
            <i class="fa-solid fa-bars" id="sidebar_btn"></i>
        </label>
        <div class="left_area">
            <h3>Alum<span>Ease<span></h3>
        </div>
        <div class="right_area">
        <a href="../index.php" class="logout_btn"> Logout</a>
        </div>
    </header>
    <!---header area end -->

    <!---sidebar area start -->
    <div class="sidebar">
        <center>
            <img src="../img/profile.jpg" class="profile_image" alt="">
            <h4>Dean</h4>
        </center>
        <a href="dean_page.php"><i class="fa-solid fa-desktop"></i><span>Dashboard</span></a>
        <a href="profile.php"><i class="fa-regular fa-user"></i><span>My Profile</span></a>
        <a href="job_search.php"><i class="fa-solid fa-magnifying-glass"></i><span>Job Search</span></a>
        <a href="alumni_accounts.php"><i class="fa-solid fa-users"></i><span>Alumni Accounts</span></a>
        <a href="company_accounts.php"><i class="fa-solid fa-users"></i><span>Company Accounts</span></a>
        <a href="#"><i class="fa-regular fa-chart-bar"></i><span>Statistics</span></a>
        <a href="view_events.php"><i class="fa-regular fa-chart-bar"></i><span>News and Events</span></a>
        <a href="#"><i class="fa-solid fa-rectangle-ad"></i><span>Advertisements</span></a>
        <a href="#"><i class="fa-solid fa-circle-info"></i></i><span>About</span></a>
        <a href="#"><i class="fa-solid fa-gear"></i><span>Settings</span></a>
    </div>
    <!---sidebar area end -->

    <div class="content">

  

    <h1>Alumni Database</h1>

    <a href="alumni_accounts.php">Alumni Accounts </a> 
    | 
    <a href="company_accounts.php"> Company Accounts </a>

                <table class="table " >
                <thead class="thead-dark">
                  <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Course</th>
                    <th>Year Graduated</th>
                    <th>Action</th>                 
                  </tr>
                </thead>
                <tbody>
     
     
              <?php
                include "../conn.php";
     
                $get_data = "SELECT u.id, p.fname, p.lname, u.email, p.course, p.yr_graduated
                FROM users u
                JOIN user_profile p
                ON u.id = p.id 
                WHERE u.user_type = '5'";
             
     
                $data = mysqli_query($conn, $get_data);
                while($row = mysqli_fetch_array($data)){
              ?>
     
     
                  <tr>
                    <td><?php echo $row['id'];?></td>
                    <td><?php echo $row['fname'];?></td>
                    <td><?php echo $row['lname'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><?php echo $row['course'];?></td>
                    <td><?php echo $row['yr_graduated'];?></td>
                   
                   
              
                  </tr>
                  <?php } ?>
                  
                </tbody>
              </table>
              <!-- End Alumni Table -->
    
     
     
     </body>
     </html>
     
     <?php } ?>

    