<?php
  include "../conn.php";
  session_start();

  if(!isset($_SESSION['sess_id'])){
    header("refresh: 2; url=login.php");
  }else{
    $browserId = $_SESSION['sess_id'];
    $accountStatement = "SELECT * FROM `users` t1 INNER JOIN `user_profile` t2 ON t1.`id`=t2.`id` WHERE t1.`id`=$browserId";
    $accountQuery = mysqli_query($conn, $accountStatement);
    $row = mysqli_fetch_array($accountQuery);
    $fname = $row['fname'];
    $lname = $row['lname'];
    $bday = $row['bday'];
    $gender = $row['gender'];
    $cnum = $row['cnum'];
    $course = $row['course'];
    $address = $row['address'];
    $yr_graduated = $row['yr_graduated'];
    $regDate = $row['date_registered'];
    $readable_regDate = date("F j, Y", $regDate);
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
            <!-- <img src="../img/profile.jpg" class="profile_image" alt=""> -->
            <h4>Hi! <?php echo $fname; ?></h4>
        </center>
        <a href="alumni_page.php"><i class="fa-solid fa-desktop"></i><span>Dashboard</span></a>
        <a href="update.php"><i class="fa-regular fa-user"></i><span>Profile</span></a>
        <a href="job_search.php"><i class="bi bi-search"></i><span>Job Search</span></a>
        <a href="view_events.php"><i class="bi bi-newspaper"></i><span>News and Events</span></a>
        <a href="saved_jobs.php"><i class="bi bi-journal-text"></i><span>Activities</span></a>
    </div>
    <!---sidebar area end -->

          <h1>Job Search</h1>

         
          <table border = 3px solid>
            
              <tr>
                <th>Profile</th>
                <th>Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Birthday</th>
                <th>Course</th>
                <th>Year Graduated</th>
                <th>Age</th>
                <th>Contact Number</th>
              </tr>
       
            <tbody>


          <?php
            include "../conn.php";

            $get_alumni_data = mysqli_query($conn,"SELECT * FROM user_profile");
            while($row = mysqli_fetch_assoc($get_alumni_data)){
          ?>


              <tr>
            
                <td><?php echo $row['fname'];?></td>
                <td><?php echo $row['lname'];?></td>
                <td><?php echo $row['bday'];?></td>
                <td><?php echo $row['gender'];?></td>
                <td><?php echo $row['cnum'];?></td>
                <td><?php echo $row['course'];?></td>
                <td><?php echo $row['address'];?></td>
                <td><?php echo $row['yr_graduated'];?></td>
          
              </tr>
              <?php } ?>
              
            </tbody>
          </table>
      
         

</body>
</html>

<?php } ?>