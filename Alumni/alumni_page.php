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
    <link rel="stylesheet" href="../mystyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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

<style>

.flex-container {
  display: flex;
  background-color: white;
  margin-left: 330px;
  width: 70%;
 
}

.flex-container > div {
  background-color: whitesmoke;
  margin: 20px;
  padding: 5px;
  font-size: 30px;
}
 .container{
  padding-left: 245px;
 }

 .flex-container h5{
  font-size: 15px;
 }

</style>

<div class="container" style="padding-top: 100px">
<h2> Dashboard </h2>
</div>

<div class="flex-container">
  <div class="card  text-white" style="width:400px; ; height: 150px; background-color: #47C1BF;">
    <div class="card-body">
    <i class="bi bi-search"></i>
      <h5>Total Job Vacancies</h5>
      <center> <h5> 
          <?php 
            $jobpost = "SELECT * FROM `add_jobs`";
            $jobpost_query = mysqli_query($conn,$jobpost);

            if($total_jobpost = mysqli_num_rows($jobpost_query)){
              echo "$total_jobpost";
            }else{
              echo "No Data";
            }
          ?>
      </h5>  </center> 
    </div>
  </div>
    
  <div class="card  text-white" style="width:400px; ; height: 150px; background-color: #5e308c;">
    <div class="card-body">
    <i class="bi bi-save"></i></i>
        <h5>Total Saved Jobs</h5>
        <center> <h5> 
          <?php 
            $saved_jobs = "SELECT * FROM `saved_jobs` WHERE id = '$browserId'";
            $saved_jobs_query = mysqli_query($conn,$saved_jobs);

            if($total_saved_jobs = mysqli_num_rows($saved_jobs_query)){
              echo "$total_saved_jobs";
            }else{
              echo "No Data";
            }
          ?>
      </h5>  </center>  
    </div>
  </div>
  <div class="card  text-white" style="width:400px; ; height: 150px; background-color:#F49342">
    <div class="card-body">
    <i class="bi bi-people"></i>
        <h5>Total Employers</h5>
        <center> <h5> 
          <?php 
            $employers = "SELECT * FROM `users` WHERE `user_type` IN ('4') AND `user_status` IN ('1')";
            $total_employer_query = mysqli_query($conn,$employers);

            if($employer_total = mysqli_num_rows($total_employer_query)){
              echo "$employer_total";
            }else{
              echo "No Data";
            }
          ?>
      </h5>  </center> 
    </div>
  </div>
  
  <div class="card  text-white" style="width:400px; ; height: 150px; background-color: #20283E;">
    <div class="card-body">
    <i class="bi bi-briefcase-fill"></i>
        <h5>Total Applied Jobs</h5>
        <center> <h5> 
          <?php 
            $applied_jobs = "SELECT * FROM `application` WHERE id = '$browserId'";
            $applied_jobs_query = mysqli_query($conn,$applied_jobs);

            if($total_applied_jobs = mysqli_num_rows($applied_jobs_query)){
              echo "$total_applied_jobs";
            }else{
              echo "No Data";
            }
          ?>
      </h5>  </center>  
    </div>
  </div>
</div>
  





</body>
</html>

<?php } ?>


