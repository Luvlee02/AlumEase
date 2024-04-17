<?php
  include "../conn.php";
  session_start();

  if(!isset($_SESSION['sess_id'])){
    header("refresh: 2; url=login.php");
  }else{
    $browserId = $_SESSION['sess_id'];
    $accountStatement = "SELECT * FROM users t1 INNER JOIN user_profile t2 ON t1.`id` = t2.`id` WHERE t1.`id`=$browserId";
    $accountQuery = mysqli_query($conn, $accountStatement);
    $row = mysqli_fetch_array($accountQuery);
    $lname = $row['lname'];
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

                  <?php
                      include "../conn.php";

                      $get_data = "SELECT t1.id, t2.fname, t3.entry_id, t3.job_title, t3.job_des, t3.job_type, t3.date_posted
                      FROM users t1
                      INNER JOIN user_profile t2 ON t1.id = t2.id 
                      INNER JOIN add_jobs t3 ON t1.id = t3.id
                      WHERE t1.id = '$browserId' 
                      ORDER BY `date_posted` DESC";

                      $data = mysqli_query($conn, $get_data);

                      if(mysqli_num_rows($data) > 0) {
                      ?>

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
  padding-left: 300px;
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
      <h5>Total Job Vacancies</h5>
     <center> <h5> 4 </h5>  </center> 
    </div>
  </div>
    
  <div class="card  text-white" style="width:400px; ; height: 150px; background-color: #5e308c;">
    <div class="card-body">
    <i class="bi bi-people"></i>
        <h5>Total Candidates</h5>
        <center> <h5> 6 </h5>  </center> 
    </div>
  </div>

  <div class="card  text-white" style="width:400px; ; height: 150px; background-color: #20283E;">
    <div class="card-body">
    <i class="bi bi-briefcase-fill"></i>
        <h5>Total Job Posted</h5>
        <center> <h5> 4 </h5>  </center> 
    </div>
  </div>
</div>


 <!---Alumni Accounts  start -->
 <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>

                    <div class="jobs" style="width:100%;"><br>
                        <div class="container pt-5" style="margin-left: 80px"><br>
                            <h2>Applicants</h2><br>
                              <table id="example" class="table table-hover border-primary">
                                <thead class="table-success">
                                  <tr id = "header">
                                      <th scope="col" style="width: 120px;">Job Title</th>
                                      <th>Job Description</th>
                                      <th scope="col" style="width: 120px;">Date Posted</th>
                                      <th scope="col" style="width: 50px;">Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php
                                  while($row = mysqli_fetch_array($data)){
                                  ?>
                                  <tr>
                                      <td><?php echo $row['job_title'];?></td>
                                      <td><?php echo $row['job_des'];?></td>
                                      <td><?php echo date("M d, Y", $row['date_posted']); ?></td>
                                      <td><a href="applicants.php?entry_id=<?php echo $row['entry_id'];?>" title="View Applicants"
                                        style="text-decoration: none; color: blue;"><i class="bi bi-person-lines-fill"></i></a></td>
                                  </tr>
                                  <?php } ?>
                              </tbody>
                          </table>
                      <?php
                      } else {
                          echo "No jobs posted";
                      }
                      ?>
              </div>
                    </div><br><br><br>
</body>
</html>

<?php } ?>
