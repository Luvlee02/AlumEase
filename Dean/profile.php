<?php
  include "../conn.php";
  session_start();

  if(!isset($_SESSION['sess_id'])){
    header("refresh: 2; url=login.php");
  }else{
    $browserId = $_SESSION['sess_id'];
    $accountStatement = "SELECT * FROM `users` t1 INNER JOIN `user_profile` t2 ON t1.`id`=t2.`id` WHERE t1.`id`=$browserId LIMIT 1";
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
            <img src="../img/profile.jpg" class="profile_image" alt="">
            <h4><?php echo $fname; ?></h4>
        </center>
        <a href="admin_page.php"><i class="fa-solid fa-desktop"></i><span>Dashboard</span></a>
        <a href="update.php"><i class="fa-regular fa-user"></i><span>My Profile</span></a>
        <a href="job_search.php"><i class="bi bi-briefcase-fill"></i><span>Manage Jobs</span></a>
        <a href="alumni_accounts.php"><i class="fa-solid fa-users"></i><span>Alumni Accounts</span></a>
        <a href="company_accounts.php"><i class="fa-solid fa-users"></i><span>Company Accounts</span></a>
        <a href="#"><i class="fa-regular fa-chart-bar"></i><span>Statistics</span></a>
        <a href="view_events.php"><i class="fa-regular fa-chart-bar"></i><span>News and Events</span></a>
        <a href="#"><i class="fa-solid fa-rectangle-ad"></i><span>Advertisements</span></a>
        <a href="#"><i class="fa-solid fa-circle-info"></i></i><span>About</span></a>
        <a href="#"><i class="fa-solid fa-gear"></i><span>Settings</span></a>
    </div>
    <!---sidebar area end -->

</head>
<body>


<div class="container">


        <h1> Profile </h1>
        <form action="../process.php?id=<?php echo $browserId;?>" method="POST">
        
        <LABEL> First Name: </label> </br>
        <input type= "text" name="update_fname" value="<?php echo $row['fname']?>" required> </p>

        <LABEL> Last Name: </label> </br>
        <input type= "text" name="update_lname" value="<?php echo $row['lname']?>" required> </p>

        <LABEL> Email: </label> </br>
        <input type= "email" name="update_email" value="<?php echo $row['email']?>" required> </p>

        <LABEL> Password: </label> </br>
        <input type= "password" name="update_password" value="<?php echo $row['password']?>" required> </p>

        <LABEL> Date of Birth: </label> </br>
        <input type= "text" name="update_bday"  value="<?php echo $row['bday']?>" required> </p>

        <LABEL> Gender: </label> </br>
        <input type= "text" name="update_gender" value="<?php echo $row['gender']?>" required> </p>

        <LABEL> Contact Number: </label> </br>
        <input type= "text" name="update_cnum" value="<?php echo $row['cnum']?>" required> </p>

        <LABEL> Position: </label> </br>
        <input type= "text" name="update_course" value="<?php echo $row['course']?>" required>  </p>

        <LABEL> Address: </label> </br>
        <input type= "text" name="update_address" value="<?php echo $row['address']?>" required> </p>

        <LABEL> Department: </label> </br>
        <input type= "text" name="update_yr_graduated" value="<?php echo $row['yr_graduated']?>" required> </p>

        <input type="hidden" name="id" value="<?php echo $browserId; ?>">

        <input type= "submit" name="update_admin" value="UPDATE">

    </form>
      </div>  
</body>
</html>

<?php } ?>