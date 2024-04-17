<?php
    include "../conn.php";
    session_start();

    if(!isset($_SESSION['sess_id'])){
        header("refresh: 2; url=login.php");
      }else{
        $browserId = $_SESSION['sess_id'];
        $accountStatement = "SELECT * FROM `users` t1 INNER JOIN `user_profile` t2 ON t1.`id`=t2.`id` WHERE t1.`id`=$browserId ";
        $accountQuery = mysqli_query($conn, $accountStatement);
        $row = mysqli_fetch_array($accountQuery);
        $fname = $row['fname'];
        $lname = $row['lname'];
        $email = $row['email'];
        $password = $row['password'];
        $bday = $row['bday'];
        $gender = $row['gender'];
        $cnum = $row['cnum'];
        $course = $row['course'];
        $address = $row['address'];
        $yr_graduated = $row['yr_graduated'];
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
            <a href="index.php" class="logout_btn"></a>
        </div>
    </header>


   

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

</head>
<body>
        
        <div class="content-profile">
                    <div class="row" style="padding-top: 70px;">
                        <div class="col-xl-8" style="margin-left: 360px;">
                            <div class="card mb-8">
                            <form action="../process.php" method="POST">
                            <div class="card-header text-white bg-success" ><h3>Account Details</h3></div>
                <div class="card-body">
                    <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1">First name</label>
                                <input type= "text" class="form-control" name="update_fname" value="<?php echo $fname; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1">Last name</label>                 
                                <input type= "text" class="form-control" name="update_lname" value="<?php echo $lname; ?>" required>
                            </div>
                            </div>

                            <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1">Email</label>
                                <input type= "email" class="form-control" name="update_email"  value="<?php echo $email; ?>" required>
                            </div>

                            <div class="col-md-6">
                                <label class="small mb-1">Password</label>
                                <input type= "password" class="form-control" name="update_password" value="<?php echo $password; ?>" required>
                                </div>
                            </div>
 

                            <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1">Date of Birth</label>
                                <input type= "text" class="form-control" name="update_bday"  value="<?php echo $bday; ?>" required>
                            </div>

                            <div class="col-md-6">
                                <label class="small mb-1">Gender</label>
                                <input type= "text" class="form-control" name="update_gender" value="<?php echo $gender; ?>" required>
                                </div>
                            </div>
 
                            <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1">Position</label>
                                <input type= "text" class="form-control" name="update_course" value="<?php echo $course; ?>" required>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="small mb-1">Department</label>
                                <input type= "text" class="form-control" name="update_yr_graduated" value="<?php echo $yr_graduated; ?>" required>
                                </div>
                            </div>
        
                            <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1">Contact number</label>
                                <input type= "text" class="form-control" name="update_cnum" value="<?php echo $cnum; ?>" required> 
                            </div>

                            <div class="col-md-6">
                                <label class="small mb-1">Company Address</label>
                                <input type= "text" class="form-control" name="update_address" value="<?php echo $address; ?>" required>
                                </div>
                            </div>

                            <input type="hidden" name="id" value="<?php echo $browserId; ?>">

                            <center><input type= "submit" class="btn btn-success" name="update_superadmin" value="Save Changes"></center>

                        </form>
                    </div>
                </div>
            </div>
</body>
</html>

<?php } ?>