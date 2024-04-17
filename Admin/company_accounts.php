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
        <a href="admin_page.php"><i class="fa-solid fa-desktop"></i><span>Dashboard</span></a>
        <a href="update.php"><i class="fa-regular fa-user"></i><span>My Profile</span></a>
        <a href="job_search.php"><i class="bi bi-briefcase-fill"></i><span>Manage Jobs</span></a>
        <a href="alumni_accounts.php"><i class="fa-solid fa-users"></i><span>Alumni Accounts</span></a>
        <a href="company_accounts.php"><i class="fa-solid fa-users"></i><span>Company Accounts</span></a>
        <a href="view_events.php"><i class="fa-regular fa-chart-bar"></i><span>News and Events</span></a>
    </div>
    <!---sidebar area end -->

    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>

                 <div class="company" style="width:70%"><br>
                    <div class="container pt-5" style="margin-left: 320px"><br>
                    <h2>Company Accounts</h2><br>

                    <a href="reg.php" class= "btn btn-dark" title="Add User">
                    <i class="bi bi-plus-square-dotted"></i> Add User </a><br><br>

                        <table id="example" class="table table-hover border-primary text-center">
                        <thead class="table-success">
                          <tr id = "header">
                          <th>Company Name</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Website Link</th>
                          <th>Industry </th>
                          <th>Action </th>
                        </tr>
                      </thead>
                      <tbody>


         <?php
           $get_data = "SELECT u.id, p.fname, p.lname, u.email, p.course, p.yr_graduated
           FROM users u
           JOIN user_profile p
           ON u.id = p.id 
           WHERE u.user_type = '4' AND u.user_status = '1'";

           $data = mysqli_query($conn, $get_data);
           while($row = mysqli_fetch_array($data)){
         ?>


             <tr>
               <td><?php echo $row['fname'];?></td>
               <td><?php echo $row['lname'];?></td>
               <td><?php echo $row['email'];?></td>
               <td><?php echo $row['course'];?></td>
               <td><?php echo $row['yr_graduated'];?></td>
               <td><a href="edit_company.php?id=<?php echo $row['id'];?>"><i class="bi bi-pencil-square" style="font-size: 20px; color: black;"></i></a>
               <a href="../delete.php?id=<?php echo $row['id'];?>"><i class="bi bi-trash" style="font-size: 20px; color: red;"></a></td>
             </tr>
             <?php } ?>
             
           </tbody>
         </table>
         <!-- End Company Table -->
           </div>
           </div>



</body>
</html>

<?php } ?>