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

    if(isset($_GET['id'])){
      $company_id = $_GET['id'];
      $delete_company = mysqli_query($conn, "DELETE FROM `users` WHERE id ='$company_id' AND user_type = '4'");
  
      if($delete_company == true){
          ?> 
          <script>
              alert("1 data is deleted");
              window.location.href="company_accounts.php";
          </script>
          <?php
      }else{
          ?> 
          <script>
              alert("Error in Deleting");
              window.location.href="company_accounts.php";
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
    
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>

</head>
<body>

        <div class="company-accounts" style="width:78%"><br>
            <div class="container pt-5" style="margin-left: 280px"><br>
              <h2>Company Accounts</h2><br>  
              
              <a href="company_reg.php" class= "btn btn-dark" title="Add User">
            <i class="bi bi-plus-square-dotted"></i> Add User </a><br><br>

            <table id="example" class="table table-hover border-primary text-center">
            <thead class="table-success">
              <tr>
               <th>Company Name</th>
               <th>Incharge</th>
               <th>Email</th>
               <th>Industry </th>
               <th>Action </th>
             </tr>
           </thead>
           <tbody>

         <?php
           include "../conn.php";

           $get_data = "SELECT t1.id, t2.fname, t2.lname, t1.email, t2.course, t2.yr_graduated, t3.user_type, t4.user_status
           FROM users t1 
           JOIN user_profile t2 ON t1.id = t2.id 
           JOIN user_type t3 ON t1.user_type = t3.id
           JOIN user_status t4 ON t1.user_status = t4.id
           AND t1.user_type IN ('4') AND t1.user_status IN ('1') ORDER BY t2.lname ASC";
        

           $data = mysqli_query($conn, $get_data);
           while($row = mysqli_fetch_array($data)){

          ?>

            <tr>
              <td><?php echo $row['fname'] ?></td>
              <td><?php echo $row['lname'] ?></td>
              <td><?php echo $row['email'] ?></td>
              <td><?php echo $row['yr_graduated'] ?></td>
              <td>
              <a href="company_profile.php?id=<?php echo $row['id']; ?>" title = "View Profile"><i class="bi bi-person-lines-fill" style="color: black; padding: 5px"></i></i></a>
              <a href="edit_company.php?id=<?php echo $row['id']; ?>" class="mr-3 edituser" title="Edit" data-target="usermodal" data-toggle="modal">
                <i class="bi bi-pencil-square" style="color: blue; padding: 3px"></i></a>
              <a href="company_accounts.php?id=<?php echo $row['id']; ?>" title="Delete"><i class="bi bi-trash" style="color: red; padding: 3px"></i></a>
              </td>
              </tr>
          <?php } ?>
        </tbody>
      </table>
  </div>
</div>


</body>
</html>

<?php } ?>
