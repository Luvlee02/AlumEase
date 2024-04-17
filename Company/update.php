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
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
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

<form action="../process.php?id=<?php echo $browserId;?>" method="POST">
                  <div class="content-profile" style= "margin-left: 50px">
                    <div class="row" style= "width: 1500px;">
                    <div class="col-xl-3">
                    </div>
                    <div class="col-xl-6" style= "margin-top:80px;">
                        <div class="card mb-4">
                            <div class="card-header" >Account Details</div>
                            <div class="card-body">
                                         
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1">Company Name</label>
                                <input class="form-control" type= "text" name="update_fname" value="<?php echo $fname; ?>" required>
                            </div>
                           
                            <div class="col-md-6">
                                <label class="small mb-1">Incharge</label>
                                <input class="form-control" type= "text" name="update_lname" value="<?php echo $lname; ?>" required>
                            </div>
                        </div>
                  
                        <div class="row gx-3 mb-3">
                         
                            <div class="col-md-6">
                                <label class="small mb-1">Email</label>
                                <input class="form-control" type="email" name="update_email" value="<?php echo $email; ?>" required>
                            </div>

                            <div class="col-md-6">
                                <label class="small mb-1">Gender</label>
                                <input class="form-control" type= "text" name="update_gender" value="<?php echo $gender; ?>" required>
                            </div>
                        </div>

                        <div class="row gx-3 mb-3">

                        <div class="col-md-6">
                                <label class="small mb-1">Password</label>
                                <input class="form-control" type="password" name="update_password" value="<?php echo $password; ?>"required>
                            </div>

                          <div class="col-md-6">
                                <label class="small mb-1">Date of Birth</label>
                                <input class="form-control" type= "text" name="update_bday" value="<?php echo $bday; ?>" required>
                            </div>
                         
                        </div>
                       
                        <div class="row gx-3 mb-3">

                        <div class="col-md-6">
                                <label class="small mb-1">Website Link</label>
                                <input class="form-control" type= "text" name="update_course" value="<?php echo $course; ?>" required>
                            </div>
                           
                            <div class="col-md-6">
                                <label class="small mb-1">Phone number</label>
                                <input class="form-control" type= "text" name="update_cnum" value="<?php echo $cnum; ?>" required>
                            </div>
                            
                        </div>

                        <div class="row gx-3 mb-3">
                            
                            <div class="col-md-6">
                                <label class="small mb-1">Address</label>
                                <input class="form-control"type= "text" name="update_address" value="<?php echo $address; ?>"required>
                            </div>
                           
                            <div class="col-md-6">
                                <label class="small mb-1">Industry</label>
                                <input class="form-control" type= "text" name="update_yr_graduated" value="<?php echo $yr_graduated; ?>" required>
                            </div>
                        </div>

                        <input type ="hidden" name="id" value="<?php echo $browserId;?>">
                        
                        <center><button type="submit" class="btn btn-success" name="update_company">Save Changes</button></center>
                        </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>
</html>
<?php } ?>


   