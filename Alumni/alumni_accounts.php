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


    <!---sidebar area start -->
    <div class="sidebar">
        <center>
            <img src="../img/profile.jpg" class="profile_image" alt="">
            <h4><?php echo $fname; ?></h4>
        </center>
        <a href="alumni_page.php"><i class="fa-solid fa-desktop"></i><span>Dashboard</span></a>
        <a href="update.php"><i class="fa-regular fa-user"></i><span>My Profile</span></a>
        <a href="job_search.php"><i class="bi bi-search"></i><span>Job Search</span></a>
        <a href="#"><i class="fa-regular fa-user"></i><span>Statistics</span></a>
        <a href="view_events.php"><i class="fa-regular fa-user"></i><span>News and Events</span></a>
    </div>
    <!---sidebar area end -->



    <h1>Alumni Database</h1>

    
         
    <table class="table table-hover border-primary text-center" >
           <thead class = "table dark text-center">
             <tr>
               <th scope="col">No.</th>
               <th scope="col">First Name</th>
               <th scope="col">Last Name</th>
               <th scope="col">Email</th>
               <th scope="col">Course</th>
               <th scope="col">Year Graduated</th>
        

             </tr>
           </thead>
           <tbody>


         <?php
           include "../conn.php";

      

           $get_data = "SELECT u.id, p.fname, p.lname, u.email, p.course, p.yr_graduated
           FROM users u
           JOIN user_profile p
           ON u.id = p.id 
           WHERE u.user_type = '5'";
        

           $data = mysqli_query($conn, $get_data);
           while($row = mysqli_fetch_array($data)){
         ?>


             <tr>
               <th><?php echo $row['id'];?></th>
               <td><?php echo $row['fname'];?></td>
               <td><?php echo $row['lname'];?></td>
               <td><?php echo $row['email'];?></td>
               <td><?php echo $row['course'];?></td>
               <td><?php echo $row['yr_graduated'];?></td>
             </tr>
             <?php } ?>
             
           </tbody>
         </table>
         <!-- End Alumni Table -->





</body>
</html>

<?php } ?>