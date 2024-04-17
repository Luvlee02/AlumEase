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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php 
        $alumniID = $_GET['id'];
        $accountStatement2 = "SELECT * FROM `users` t1 INNER JOIN `user_profile` t2 ON t1.`id`=t2.`id` WHERE t1.`id`=$alumniID";
        $accountQuery2 = mysqli_query($conn, $accountStatement2);
        $row2 = mysqli_fetch_array($accountQuery2);
        $fname2 = $row2['fname'];
        $lname2 = $row2['lname'];
        $email2 = $row2['email'];
        $password2 = $row2['password'];
        $bday2 = $row2['bday'];
        $gender2 = $row2['gender'];
        $cnum2 = $row2['cnum'];
        $course2 = $row2['course'];
        $address2 = $row2['address'];
        $yr_graduated2 = $row2['yr_graduated'];
        $regDate2 = $row2['date_registered'];
        $readable_regDate2 = date("F j, Y", $regDate2);
    ?>


      <div class="profile " style="padding-top: 20px;">
      <div class="container mt-3" style="padding-left: 220px;">
        <div class="card" style="width:800px">
          <div class="card-body">

            <form action="../process.php" method="POST">
            <h2>Edit Alumni Profile</h2>
            <hr>

              <div class="row gx-3 mb-3">
              <div class="col-md-6">
                <label><b>First Name</b></label>
                <input type= "text" class="form-control" name="update_fname" value="<?php echo $fname2; ?>" required>
              </div>

            <div class="col-md-6">
              <label><b>Last Name</b></label>
              <input type= "text" class="form-control" name="update_lname" value="<?php echo $lname2; ?>" required>
              </div>
            </div>

            <div class="row gx-3 mb-3">
              <div class="col-md-6">
                <label><b>Email Address</b></label>
                <input type= "email" class="form-control" name="update_email" value="<?php echo $email2; ?>" required>
            </div>

            <div class="col-md-6">
                <label><b>Password</b></label>
                <input type= "password" class="form-control" name="update_password" value="<?php echo $password2; ?>" required>
              </div>
            </div>

            <div class="row gx-3 mb-3">
              <div class="col-md-6">
                <label><b>Date of Birth</b></label>
                <input type= "text" class="form-control" name="update_bday" value="<?php echo $bday2; ?>" required>
            </div>

            <div class="col-md-6">
                <label><b>Gender</b></label>
                <input type= "text" class="form-control" name="update_gender" value="<?php echo $gender2; ?>" required>
                </div>
            </div>

            <div class="row gx-3 mb-3">
              <div class="col-md-6">
                <label><b>Contact Number</b></label>
                <input type= "text" class="form-control" name="update_cnum" value="<?php echo $cnum2; ?>" required>
            </div>

            <div class="col-md-6">
                <label><b>Address</b></label>
                <input type= "text" class="form-control" name="update_address" value="<?php echo $address2; ?>"required>
                </div>
            </div>

            <div class="row gx-3 mb-3">
              <div class="col-md-6">
              <label><b>Course</b></label>
              <input type= "text" class="form-control" name="update_course" value="<?php echo $course2; ?>" required>
            </div>

            <div class="col-md-6">
              <label><b>Year Graduated</b></label>
              <input type= "text" class="form-control" name="update_yr_graduated" value="<?php echo $yr_graduated2; ?>" required>
              </div>
            </div>

            <input type="hidden" class="form-control" name="id" value="<?php echo $alumniID; ?>">

            <div class="button" style="margin-left: 500px;">
              <input type= "submit" class="btn btn-success" name="edit_alumni" value="Save Changes">
            <a href="alumni_accounts.php" class="btn btn-dark" >Back</a>
        </form>
  </div>
  </div>  

  </div>
  </div>  

    </body>
    </html>

    <?php } ?>