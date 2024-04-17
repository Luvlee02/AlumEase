<?php
    include "../conn.php";
    session_start();

    if(!isset($_SESSION['sess_id'])){
        header("refresh: 2; url=login.php");
      }else{
        $browserId = $_SESSION['sess_id'];
        $accountStatement = "SELECT * FROM `users` t1 INNER JOIN `user_profile` t2 ON t1.`id`=t2.`id` WHERE t1.`id`=$browserId";
        $accountQuery = mysqli_query($conn, $accountStatement);
        while($row=mysqli_fetch_object($accountQuery)){
            
        $browserId = $row -> id;
        $fname = $row -> fname;
        $lname =$row -> lname;
        $bday = $row -> bday;
        $gender =$row -> gender;
        $cnum = $row -> cnum;
        $address = $row -> address;
        $course = $row -> course;
        $yr_graduated = $row -> yr_graduated;
    }
    
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALUMEASE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="Alumni/alumiprofile.css">
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
            <a href="../index.php" class="logout_btn"></a>
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
    
    </head>
    <body>

    <div class="container">

            <h1> Profile </h1>

            <form action="../process.php" method="POST" enctype = "multipart/form-data">

            <LABEL>  Picture: </label> </br>
            <input type= "file" name="update_pic" required accept = ".jpg, .png, .jpeg, .gif, .webp"> </p>
            
            <LABEL> First Name: </label> </br>
            <input type= "text" name="update_fname" value="<?php echo $fname; ?>" required> </p>

            <LABEL> Last Name: </label> </br>
            <input type= "text" name="update_lname" value="<?php echo $lname; ?>" required> </p>

            <LABEL> Email: </label> </br>
            <input type= "text" name="update_email" value="<?php echo $email; ?>" required> </p>

            <LABEL> Last Name: </label> </br>
            <input type= "text" name="update_password" value="<?php echo $password; ?>" required> </p>

            <LABEL> Date of Birth: </label> </br>
            <input type= "text" name="update_bday" value="<?php echo $bday; ?>" required> </p>

            <LABEL> Gender: </label> </br>
            <input type= "text" name="update_gender" value="<?php echo $gender; ?>" required> </p>

            <LABEL> Contact Number: </label> </br>
            <input type= "text" name="update_cnum" value="<?php echo $cnum; ?>" required> </p>

            <LABEL> Course: </label> </br>
            <input type= "text" name="update_course" value="<?php echo $course; ?>" required>  </p>

            <LABEL> Address: </label> </br>
            <input type= "text" name="update_address" value="<?php echo $address; ?>"required> </p>

            <LABEL> Year Graduated: </label> </br>
            <input type= "text" name="update_yr_graduated" value="<?php echo $yr_graduated; ?>" required> </p>

            <input type ="hidden" name="id" value="<?php echo $browserId;?>">
            
            <input type= "submit" name="update_alumni" value="POST">

        </form>
        </div>


    </body>
    </html>

    <?php } ?>