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

    if(isset($_GET['entry_id'])){
      $save_job_id = $_GET['save_job_id'];
      $unsave_job = mysqli_query($conn, "DELETE FROM `saved_jobs` WHERE entry_id ='$save_job_id'");
  
      if($unsave_job == true){
          ?> 
          <script>
              alert("1 data is deleted");
              window.location.href="saved_jobs.php";
          </script>
          <?php
      }else{
          ?> 
          <script>
              alert("Error in Deleting");
              window.location.href="saved_jobs.php";
          </script>
          <?php
      }
    }
  
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../mystyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
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

                <div class="saved_jobs" style="width:75%;">
                    <div class="container pt-5" style="margin-left: 310px"><br>
                        <h2>Saved Jobs</h2><br>
                          <table id="example" class="table table-hover border-primary">
                            <thead class="table-success">
                              <tr id = "header">
                                <!-- <th>Company Name</th> -->
                                <th scope="col" >Title</th>
                                <th scope="col" >Job Description</th>
                                <th scope="col" style="width: 150px;">Location</th>
                                <th scope="col" style="width: 150px;">Date Posted</th>
                                <th scope="col" >Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                          <?php
                          include "../conn.php";

                                $fetchSavedJobs = "SELECT t1.id, t3.entry_id, t3.job_title, t3.job_des, t3.location, t3.date_posted 
                                FROM users t1 
                                INNER JOIN saved_jobs t2 
                                ON t1.id = t2.id 
                                INNER JOIN add_jobs t3 
                                ON t2.entry_id = t3.entry_id 
                                INNER JOIN user_profile t4 
                                ON t3.id = t4.id
                                WHERE t1.id = '$browserId' ORDER BY date_posted DESC";

                                  $data = mysqli_query($conn, $fetchSavedJobs);
                                  while ($row = mysqli_fetch_array($data)) {
                                      $job_post_id = $row['entry_id'];
                                  
                                      ?>
                                      <tr>
                                          <!-- <td><?php //echo $row['fname'] ?></td> -->
                                          <td><?php echo $row['job_title'] ?></td>
                                          <td><?php echo $row['job_des'] ?></td>
                                          <td><?php echo $row['location'] ?></td>
                                          <td><?php echo date("M d, Y", $row['date_posted']); ?></p></td>
                                          <td>
                                            <a href="saved_JobDetails.php?entry_id=<?php echo $row['entry_id']; ?>" title = "View Details">
                                              <i class="bi bi-card-list" style="color: blue; padding: 5px"></i></i></a>
                                              <a href="saved_jobs.php?entry_id=<?php echo $row['entry_id']; ?>" title="Delete">
                                              <i class="bi bi-trash" style="color: red; padding: 3px"></i></a>
                                          </td>
                                      </tr>
                                  <?php } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                

                    <script>
        $(document).ready(function () {
            $('#example1').DataTable();
        });
    </script>

                    <div class="application" style="width:75%;">
                    <div class="container pt-5" style="margin-left: 310px"><br>
                        <h2>Job Applications</h2><br>
                        <table id="example1" class="table table-hover border-primary text-center">
                            <thead class="table-success">
                            <tr id = "header">
                                <th>Company Name</th>
                                <th>Job Title</th>
                                <th>Job Description</th>
                                <th>Location</th>
                                <th>Date Submitted</th>
                                <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                          <?php
                          include "../conn.php";

                                $fetchAppliedJobs = "SELECT t1.id, t3.entry_id, t4.fname, t3.job_title, t3.job_des, t3.location, t2.date_submitted, t5.status 
                                FROM users t1 
                                INNER JOIN application t2 ON t1.id = t2.id 
                                INNER JOIN add_jobs t3 ON t2.entry_id = t3.entry_id 
                                INNER JOIN user_profile t4 ON t3.id = t4.id 
                                INNER JOIN status t5 ON t2.status = t5.id
                                WHERE t1.id = '$browserId' ORDER BY date_submitted DESC";
                                  $data = mysqli_query($conn, $fetchAppliedJobs);
                                  while ($row = mysqli_fetch_array($data)) {
                                      $job_post_id = $row['entry_id'];
                                  
                                      ?>
                                      <tr>
                                          <td><?php echo $row['fname'] ?></td>
                                          <td><?php echo $row['job_title'] ?></td>
                                          <td><?php echo $row['job_des'] ?></td>
                                          <td><?php echo $row['location'] ?></td>
                                          <td><?php echo date("M d, Y", $row['date_submitted']); ?></p></td>
                                          <td><?php echo $row['status'] ?></td>
                                      </tr>
                                  <?php } ?>
                          </tbody>
                        </table>
                        </div>
                    </div><br> <br> <br>
              
</body>
</html>

<?php } ?>


 
       

       