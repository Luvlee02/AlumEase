<?php
  include "../conn.php";
  session_start();

  
  if(!isset($_SESSION['sess_id'])){
    header("refresh: 2; url=login.php");
  }else{
    $browserId = $_SESSION['sess_id'];
    $accountStatement = "SELECT * FROM users t1 INNER JOIN user_profile t2 ON t1.`id` = t2.`id` INNER JOIN add_jobs t3 ON t1.`id` = t3.`id`
    WHERE t1.`id`='$browserId'";

    $accountQuery = mysqli_query($conn, $accountStatement);
    $row = mysqli_fetch_array($accountQuery);
    $entry_id = $row['entry_id'];
    $fname = $row['fname'];
    $job_title = $row['job_title'];
    $job_des = $row['job_des'];
    $job_type = $row['job_type'];
    $job_cat = $row['job_cat'];
    $salary = $row['salary'];
    $skills = $row['skills'];
    $location = $row['location'];
    $regDate = $row['date_posted'];
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
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="../css/postjob.css">
</head>
<body>
       
    <?php 
        $jobId = $_GET['entry_id'];
        $accountStatement2 = "SELECT t1.id, t3.entry_id, t2.fname,  t3.job_title, t3.job_des, t3.job_type, t3.job_cat, t3.salary, t3.skills, t3.location, t3.date_posted
        FROM users t1
        LEFT OUTER JOIN user_profile t2
        ON t1.`id` = t2.`id` 
        LEFT OUTER JOIN add_jobs t3
        ON t1.`id` = t3.`id`
        WHERE t1.`id` = $browserId AND t3.`entry_id` = '$jobId'";

        $accountQuery2 = mysqli_query($conn, $accountStatement2);
        $row2 = mysqli_fetch_array($accountQuery2);
        $fname2 = $row2['fname'];
        $job_title2 = $row2['job_title'];
        $job_des2 = $row2['job_des'];
        $job_type2 = $row2['job_type'];
        $job_cat2 = $row2['job_cat'];
        $salary2 = $row2['salary'];
        $skills2 = $row2['skills'];
        $location2 = $row2['location'];
        $regDate2 = $row2['date_posted'];
        $readable_regDate2 = date("F j, Y", $regDate2);
    ?>


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
    <h1><b>EDIT JOB POST</b></h1>
    <p>Please fill in the details of the job you want to post.</p>
    <hr>

    <td><a href = "applicants.php?entry_id=<?php echo $row['entry_id'];?>">View Applicants</a>

    <form action="../process.php" method="POST">

        <label><b>Company Name</label></b>
        <input type="text"  name="update_fname"  value = "<?php echo $fname2 ?>"; required>
        
        <label><b>Job Title</label></b>
        <input type="text" name="update_job_title" placeholder="Enter Job Title" value = "<?php echo $job_title2 ?>";required>

        <label><b>Job Description</b></label>
        <input type="text" name="update_job_des" placeholder="Enter Job Description" value = "<?php echo $job_des2 ?>";required>

        <label><b>Job Type</b></label>
        <input type="text" name="update_job_type" placeholder="Enter Job Type" value = "<?php echo $job_type2 ?>"; required>
       
        <label><b>Job Category</label></b>
        <input type="text" class="form-control" name="update_job_cat" placeholder="Enter Job Category" value = "<?php echo $job_cat2 ?>"; required>
      
        <label><b>Salary</label></b>
        <input type="text" class="form-control" name="update_salary" placeholder="Enter Salary" value = "<?php echo $salary2 ?>"; required>
   
        <label><b>Skills</b></label>
        <input type="text" name="update_skills" placeholder="Enter Skills" value = "<?php echo $skills2 ?>"; required>

        <label><b>Location</b></label> 
        <input type="text" name="update_location"  placeholder="Location" value = "<?php echo $location2 ?>"; required></p>

        <input type="hidden" name="id" value="<?php echo $browserId; ?>">
        <input type="hidden" name="entry_id" value="<?php echo $jobId; ?>">

        <input type="submit" class="submit-btn" name = "job_post" value ="Update"> 
    </div>
  </form>

</body>

</html>

<?php } ?>