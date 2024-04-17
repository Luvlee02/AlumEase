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
            <!-- <img src="../img/profile.jpg" class="profile_image" alt=""> -->
            <h4>Hi! <?php echo $lname; ?></h4>
        </center>
        <a href="company_page.php"><i class="fa-solid fa-desktop"></i><span>Dashboard</span></a>
        <a href="update.php"><i class="fa-regular fa-user"></i><span>Company Profile</span></a>
        <a href="post_a_job.php"><i class="fa-solid fa-briefcase"></i><span>Post a Job</span></a>
        <a href="alumni_accounts.php"><i class="fa-solid fa-users"></i><span>Candidates</span></a>
    </div>
    <!---sidebar area end -->


   
 
    <table class="table table-hover border-primary text-center" >
           <thead class = "table dark text-center">
             <tr>
               <th scope="col">No.</th>
               <th scope="col">Company Name</th>
               <th scope="col">Name</th>
               <th scope="col">Email</th>
               <th scope="col">Website Link</th>
               <th scope="col">Industry </th>
        

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






</body>
</html>

<?php } ?>