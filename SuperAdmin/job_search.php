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

        //code for deleting job post
        if(isset($_GET['entry_id'])){
          $job_id = $_GET['entry_id'];
          $delete = mysqli_query($conn, "DELETE FROM add_jobs WHERE entry_id='$job_id'");
      
          if($delete == true){
              ?> 
              <script>
                  alert("1 data is deleted");
                  window.location.href="job_search.php";
              </script>
              <?php
          }else{
              ?> 
              <script>
                  alert("Error in Deleting");
                  window.location.href="job_search.php";
              </script>
              <?php
          }
      
      }
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
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


    <!-- sidebar area start  -->
    <div class="sidebar">
        <center>
            <!-- <img src="../img/profile.jpg" class="profile_image" alt=""> -->
            <h4>Hi!<?php echo " " .$fname; ?></h4>
        </center>
        <a href="superadmin.php"><i class="fa-solid fa-desktop"></i><span>Dashboard</span></a>
        <a href="profile.php"><i class="fa-regular fa-user"></i><span>Profile</span></a>
        <a href="job_search.php"><i class="bi bi-briefcase-fill"></i><span>Manage Jobs</span></a>
        <a href="alumni_accounts.php"><i class="fa-solid fa-users"></i><span>Alumni Accounts</span></a>
        <a href="company_accounts.php"><i class="fa-solid fa-users"></i><span>Company Accounts</span></a>
        <a href="view_events.php"><i class="fa-regular fa-chart-bar"></i><span>News and Events</span></a>
    </div>
    <!---sidebar area end -->

  
    <!-- <form method="GET" action="search.php">
      <input type="text" name="query" placeholder="Enter your search query">
      <button type="submit">Search</button>
    </form> -->


    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>

                 <div class="jobs" style="width:70%"><br>
                    <div class="container pt-5" style="margin-left: 320px"><br>
                    <h2>Job Posted</h2><br>
                        <table id="example" class="table table-hover border-primary text-center">
                        <thead class="table-success">
                          <tr id = "header">
                          <th scope="col">Company Name</th>
                          <th scope="col">Job Title</th>
                          <th scope="col">Job Type</th>
                          <th scope="col">Location</th>
                          <th scope="col">Date Posted</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                        <?php
                          include "../conn.php";

                          $get_data = "SELECT t1.id, t2.fname, t3.entry_id, t3.job_title, t3.job_des, t3.job_type, t3.salary, t3.skills, t3.location, t3.date_posted
                          FROM users t1
                          JOIN user_profile t2
                          ON t1.id = t2.id 
                          JOIN add_jobs t3
                          ON t1.id = t3.id
                          WHERE t1.user_type = '4'";

                          $data = mysqli_query($conn, $get_data);
                          while($row = mysqli_fetch_array($data)){


                          ?>
                            <tr>
                              <td><?php echo $row['fname'];?></td>
                              <td><?php echo $row['job_title'];?></td>
                              <td><?php echo $row['job_type'];?></td>
                              <td><?php echo $row['location'];?></td>
                              <td><?php echo date("M d, Y", $row['date_posted']); ?></td>
                              <td><a href="job_search.php?entry_id=<?php echo $row['entry_id']; ?>" title="Delete">
                              <i class="bi bi-trash" style="color: red; padding: 5px"></i></a></td>

                            </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                </div>
            </div>

</body>
</html>

<?php } ?>