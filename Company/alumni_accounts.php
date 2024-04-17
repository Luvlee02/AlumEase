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
            <a href="../index.php" class="logout_btn">Logout</a>
        </div>
    </header>
    <!---header area end -->

    <div class="sidebar">
        <center>
            <!-- <img src="../img/profile.jpg" class="profile_image" alt=""> -->
            <h4>Hi! <?php echo $lname; ?></h4>
        </center>
        <a href="company_page.php"><i class="fa-solid fa-desktop"></i><span>Dashboard</span></a>
        <a href="update.php"><i class="fa-regular fa-user"></i><span>Company Profile</span></a>
        <a href="post_a_job.php"><i class="fa-solid fa-briefcase"></i><span>Post a Job</span></a>
        <a href="alumni_accounts.php"><i class="fa-solid fa-users"></i><span>Candidates</span></a>
    </div>
    <!---sidebar area end -->

    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>

  <div class="jobs" style="width:70%;"><br>
    <div class="container pt-5" style="margin-left: 320px"><br>
        <h2>Candidates</h2><br>
          <table id="example" class="table table-hover border-primary text-center">
            <thead class="table-success">
              <tr id = "header">
                    <th>Name</th>
                    <th>Email</th>  
                    <th>Course</th>  
                    <th>Year Graduated</th>       
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
     
     
              <?php         
                 $get_data = "SELECT t1.id, t2.fname, t2.lname, t1.email, t2.course, t2.yr_graduated, t3.user_type, t4.user_status
                 FROM users t1 
                 JOIN user_profile t2 ON t1.id = t2.id 
                 JOIN user_type t3 ON t1.user_type = t3.id
                 JOIN user_status t4 ON t1.user_status = t4.id
                 AND t1.user_type IN ('5') AND t1.user_status IN ('1') ORDER BY t2.lname ASC";
    
                $data = mysqli_query($conn, $get_data);
                while($row = mysqli_fetch_array($data)){
              ?>

                  <tr>
                    <td><?php echo $row['fname']," ",$row['lname']?></td>
                    <td><?php echo $row['email']?></td>
                    <td><?php echo $row['course']?></td>
                    <td><?php echo $row['yr_graduated']?></td>
                    <td><a href="alumni_profile.php?id=<?php echo $row['id']; ?>" title = "View Profile"><i class="bi bi-person-lines-fill" 
                    style="color: black; padding: 5px"></i></i></a></td>
                                      
                  <?php } ?>
                  
                </tbody>
              </table>
              </div>        
            </div>
</body>
</html>


<?php } ?>
