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

    if(isset($_POST['approve'])){
      $id = $_POST['id'];
  
      $status = "UPDATE `users` SET `user_status` = '1' WHERE id = $id";
      $result = mysqli_query($conn, $status);
  
      echo "<script>
          alert('User Approved!');
          window.location.href='admin_page.php';
      </script>";
  }
  
  if(isset($_POST['reject'])){
      $id = $_POST['id'];
  
      $status = "DELETE FROM `users` WHERE id = $id"; 
      $result = mysqli_query($conn, $status);
  
      echo "<script>
          alert('User Denied!');
          window.location.href='admin_page.php';
      </script>";
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

    <!---sidebar area start -->
    <div class="sidebar">
        <center>
            <!-- <img src="../img/profile.jpg" class="profile_image" alt=""> -->
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
  
    <style>
.flex-container {
  display: flex;
  background-color: white;
  margin-left: 350px;
  width: 70%;
 
}

.flex-container > div {
  background-color: whitesmoke;
  margin: 20px;
  padding: 5px;
  font-size: 30px;
}
 .container{
  padding-left: 252px;
 }

 .flex-container h5{
  font-size: 18px;
 }

</style>

<div class="container" style="padding-top: 100px">
<h2> Dashboard </h2>
</div>

<div class="flex-container">
  <div class="card  text-white" style="width:400px; ; height: 150px; background-color: #47C1BF;">
    <div class="card-body">
    <i class="bi bi-search"></i>
      <h5>No. of Vacancies</h5>
     <center> <h5> 4 </h5>  </center> 
    </div>
  </div>
    
  <div class="card  text-white" style="width:400px; ; height: 150px; background-color: #5e308c;">
    <div class="card-body">
    <i class="bi bi-mortarboard"></i>
        <h5>Total Alumni</h5>
        <center> <h5> 5 </h5>  </center> 
    </div>
  </div>
  <div class="card  text-white" style="width:400px; ; height: 150px; background-color:#F49342">
    <div class="card-body">
    <i class="bi bi-people"></i>
        <h5>Total Employers</h5>
        <center> <h5> 4 </h5>  </center> 
    </div>
  </div>
  
  <div class="card  text-white" style="width:400px; ; height: 150px; background-color: #20283E;">
    <div class="card-body">
    <i class="bi bi-briefcase-fill"></i>
        <h5>Total Job Posted</h5>
        <center> <h5> 9 </h5>  </center> 
    </div>
  </div>
</div>

    <!---Alumni Accounts  start -->
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>

                 <div class="accounts" style="width:100%">
                    <div class="container pt-5" style="margin-left: 100px"><br>
                    <h2>User Accounts</h2><br>
                        <table id="example" class="table table-hover border-primary text-center">
                        <thead class="table-success">
                          <tr id = "header">
                    <th>Email</th>
                    <th>User Type</th>
                    <th>Status</th>   
                    <th>Action</th>                
                  </tr>
                </thead>
                <tbody>
     
     
              <?php         
                $get_data = "SELECT t1.id, t1.email, t2.user_type, t3.user_status
                FROM users t1
                JOIN user_type t2
                ON t1.user_type = t2.id 
                JOIN user_status t3
                ON t1.user_status = t3.id 
                WHERE t1.user_status = '3'";
    
                $data = mysqli_query($conn, $get_data);
                while($row = mysqli_fetch_array($data)){
              ?>

                  <tr>
                    <td><?php echo $row['email']?></td>
                    <td><?php echo $row['user_type']?></td>
                    <td><?php echo $row['user_status']?></td>
                    <td>
                    <form action="admin_page.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <input type="submit" class="btn btn-success" name="approve" value="Approve">
                            <input type="submit" class="btn btn-danger"name="reject" value="Reject">
                    </form>
                </td>
                  </tr>
                  <?php } ?>
                  
                </tbody>
              </table>
              </div><br><br><br>
    <!---Alumni Accounts end -->

</body>
</html>

<?php } ?>