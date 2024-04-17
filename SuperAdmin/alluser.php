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


    <div class="content">

    <h1>Alumni Database</h1> 



        <label><b></b></label>
        <select class="form-select" name="accounts" onchange="window.location.href=this.value";>
            <option selected>View Accounts </option> 
            <option value="alluser.php">All Users</option>
            <option value="alumni_accounts.php">Alumni</option>
            <option value="company_accounts.php">Company</option>
         </select>

              <table border = 3px solid>
                  <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Course</th>
                    <th scope="col">Year Graduated</th>
                    <th scope="col">Action</th>                 
                  </tr>
                </thead>
                <tbody>
     
     
              <?php         
                $get_data = "SELECT u.id, p.fname, p.lname, u.email, p.course, p.yr_graduated
                FROM users u
                JOIN user_profile p
                ON u.id = p.id";

                $data = mysqli_query($conn, $get_data);
                while($row = mysqli_fetch_array($data)){
              ?>

                  <tr>
                    <td><?php echo $row['id']?></td>
                    <td><?php echo $row['fname']?></td>
                    <td><?php echo $row['lname']?></td>
                    <td><?php echo $row['email']?></td>
                    <td><?php echo $row['course']?></td>
                    <td><?php echo $row['yr_graduated']?></td>
                    <td><a href="edit_alumni.php?id=<?php echo $row['id'];?>" class="mr-3 edituser" title="Edit" data-target="usermodal" data-toggle="modal"><i class="bi bi-pencil-square"></i></a></td> 
                    <!-- <td><a href="test.php?id=<?php echo $row['id'];?>"><i class="bi bi-pencil-square"></i></a> -->
                    <td><a href="../delete.php?id=<?php echo $row['id'];?>"><i class="bi bi-trash"></a></td>
              
              
                  </tr>
                  <?php } ?>
                  
                </tbody>
              </table>
                </div>


              <!-- End Alumni Table -->
    
              <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
              <script src="https://cdnjs.cloudflare.com/ajax/popper.js/1.14.6/umd/popper.min.js"></script>

     
     
     </body>
     </html>
     
     <?php } ?>

    