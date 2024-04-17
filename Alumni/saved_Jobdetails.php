<?php
  include "../conn.php";
  session_start();

  if(!isset($_SESSION['sess_id'])){
    header("refresh: 2; url=login.php");
  }else{
    $browserId = $_SESSION['sess_id'];
    $accountStatement = "SELECT * FROM `users` t1 INNER JOIN `user_profile` t2 ON t1.`id`=t2.`id` 
    INNER JOIN `add_jobs` t3 ON t1.`id`=t2.`id`
    WHERE t1.`id`=$browserId";
    $accountQuery = mysqli_query($conn, $accountStatement);
    $row = mysqli_fetch_array($accountQuery);
    $fname = $row['fname'];
    $lname = $row['lname'];
    $job_title = $row['job_title']; 
    $job_des = $row['job_des'];
    $job_type = $row['job_type'];
    $category = $row['category'];
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
        
<?php

            include "../conn.php";

            $job_post_id = $_GET['entry_id'];
            $fetchSavedJobs= "SELECT * FROM user_profile t1 
            INNER JOIN add_jobs t2 
            ON t1.id = t2.id 
            WHERE `entry_id`=$job_post_id";
            $query = mysqli_query($conn, $fetchSavedJobs);
            $row = mysqli_fetch_assoc($query);

              $statement = "SELECT * FROM `application` WHERE `id`= '$browserId' AND `entry_id`='$job_post_id'";
              $query2 = mysqli_query($conn, $statement);
              $count = mysqli_num_rows($query2);

              ?>
                <div class="container mt-5" style="margin-left:400px">
                <div class="card" style="width:600px; background-color: #f5f5f5; border-color: blue;">
                  <div class="card-body">
                    <h4 class="card-title" style="color: blue;">Job Details</h4>
                  <hr>
                    <p><b>Company: </b> <?php echo $row['fname'];?>
                    <p><b>Job Title: </b> <?php echo $row['job_title'];?>
                    <p><b>Job Description: </b> <?php echo $row['job_des'];?>
                    <p><b>Job Type: </b> <?php echo $row['job_type'];?>
                    <p><b>Job Category: </b> <?php echo $row['category'];?>
                    <p><b>Salary: </b> <?php echo $row['salary'];?>
                    <p><b>Skills: </b> <?php echo $row['skills'];?>
                    <p><b>Location: </b> <?php echo $row['location'];?></p>
                    <p><b>Date Posted: </b><?php echo date("M d, Y", $row['date_posted']); ?></p>
                  
                         <div class="btn" style="margin-left: 450px">
                        <a href="saved_jobs.php" class="btn btn-primary">Back</a>

                </div>
              </div>
           </div>

</body>
</html>

<?php } ?>