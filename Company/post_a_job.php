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
    $fname = $row['fname'];
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALUMEASE</title>
    <link rel="stylesheet" href="../mystyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link  rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
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

<div class="jobs " style="padding-top: 55px;">
<div class="container mt-3" style="padding-left: 300px;">
  <div class="card" style="width:800px">
    <div class="card-body">
    <form action="../process.php?<?php echo $browserId; ?>" method="POST">
      <center><h2>Post a Job</h2>
      <p>Please fill in the details of the job you want to post.</p></center>
      <hr>
      <a href = view_jobposted.php class="btn btn-dark"><i class="bi bi-person-lines-fill"></i> View Jobs Posted</a><br><br>

        <label><b>Company Name</label></b>
        <input type="text" class="form-control" name="fname" value = "<?php echo $fname ?>"; disabled><br>
        
        <label><b>Job Title</label></b>
        <input type="text" class="form-control" name="job_title" placeholder="Enter Job Title" required><br>

        <div class="row gx-3 mb-3">
            <div class="col-md-6">
            <label><b>Job Type</b></label>
                <input type="text" class="form-control" name="job_type" placeholder="Enter Job Type" required>
            </div>

            <!-- <div class="row"> -->
           <div class="col-md-6">
              <label><b>Job Category</b></label>
                <select class= "form-select" name="category" required>>
                    <option selected>Select Category</option>
                    <option value="1">Accounting</option>
                    <option value="2">Administration & Office Support</option>
                    <option value="3">Banking and Financial Services</option>
                    <option value="4">Construction</option>
                    <option value="5">Education & Training</option>
                    <option value="6">Engineering</option>
                    <option value="7">Human Resources & Recruitment</option>
                    <option value="8">Information & Communications Technology</option>
                </select>
           </div>


            <div class="row gx-3 mb-3">
            <div class="col-md-6">
            <label><b>Salary</b></label>
                <input type="text" class="form-control" name="salary" placeholder="Enter Salary" required>
            </div>
            
        <div class="col-md-6">
            <label><b>Skills</b></label>
            <input type="text" class="form-control" placeholder="Enter Skills" name="skills" required>
        </div>
        </div>

        <label><b>Job Description</b></label>
         <textarea type="text" class="form-control" rows="3" name="job_des" placeholder="Enter Job Description" required></textarea><br>

         
        <div class="col-md-6">
        <label><b>Location</b></label> 
        <input type="text" class="form-control" placeholder="Location" name="location" required><br>
        </div>
        </div>

        <input type="hidden" name="id" value="<?php echo $browserId; ?>">

        <input type="submit" class="btn btn-success" style= "width: 100px;" name = "add_jobs" value ="Submit"> 
        </form>
    </div>
  </div>
</div>
</div>

  



</body>

</html>

<?php } ?>