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



    <div class="content">
    <h1> Dashboard </h1>
    

    <table>
        <tr>
            <th>id</th>
            <th>title</th>
            <th>decsription</th>
            <th>date posted</th>
        </tr>
    <?php 
        $a = "SELECT * FROM `add_jobs` WHERE `company_id`=$browserId";
        $b = mysqli_query($conn, $a);
        while($c = mysqli_fetch_array($b)){
    ?>
        
        <tr>
            <td><?php echo $c['id']; ?></td>
            <td><?php echo $c['job_title']; ?></td>
            <td><?php echo $c['job_des']; ?></td>
            <td><?php echo date("M d Y, H:i:s", $c['date_posted']); ?></td>
        </tr>
    <?php        
        }
    ?>
        </table>
    
    </div>

    

</body>
</html>


<?php } ?>

