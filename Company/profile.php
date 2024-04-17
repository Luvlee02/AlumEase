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
    $email = $row['email'];
    $password = $row['password'];
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
    <link rel="stylesheet" href="update_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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

    <div class="sidebar">
        <center>
            <img src="../img/profile.jpg" class="profile_image" alt="">
            <h4><?php echo $fname; ?></h4>
        </center>
        <a href="company_page.php"><i class="fa-solid fa-desktop"></i><span>Dashboard</span></a>
        <a href="update.php"><i class="fa-regular fa-user"></i><span>Company Profile</span></a>
        <a href="post_a_job.php"><i class="fa-solid fa-briefcase"></i><span>Post a Job</span></a>
        <a href="alumni_accounts.php"><i class="fa-solid fa-users"></i><span>Candidates</span></a>
    </div>
    <!---sidebar area end -->


        <div class="container">

            <h1>Profile </h1>
            <form action="../process.php" method="POST">
        
                
                <LABEL> Company Name: </label> 
                <input type= "text" name="update_fname"  value="<?php echo $fname; ?>" required> </p>

                <LABEL> Name: </label> 
                <input type= "text" name="update_lname"  value="<?php echo $lname; ?>" required> </p>

                <LABEL> Email: </label> </br>
                <input type= "email" name="update_email" value="<?php echo $email; ?>" required> </p>

                <LABEL> Password: </label> </br>
                <input type= "password" name="update_password" value="<?php echo $password; ?>" required> </p>

                <LABEL> Year Established: </label> 
                <input type= "text" name="update_bday"  value="<?php echo $bday; ?>" required> </p>

                <LABEL> Position: </label> 
                <input type= "text" name="update_gender" value="<?php echo $gender; ?>" required> </p>

                <LABEL> Telephone Number: </label> 
                <input type= "text" name="update_cnum" value="<?php echo $cnum; ?>" required> </p>

                <LABEL> Website Link: </label> 
                <input type= "text" name="update_course" value="<?php echo $course; ?>" required>  </p>

                <LABEL> Address: </label> 
                <input type= "text" name="update_address" value="<?php echo $address; ?>"required> </p>

                <LABEL> Industry : </label> 
                <input type= "text" name="update_yr_graduated" value="<?php echo $yr_graduated; ?>" required> </p>

                <input type ="hidden" name="id" value="<?php echo $browserId;?>">

                <input type= "submit" name="update_company" value="UPDATE">

            </form>
</div>
            
    </body>
    </html>

    <?php } ?>
  



