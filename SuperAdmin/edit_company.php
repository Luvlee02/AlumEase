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
        $companyId = $_GET['id'];
        $accountStatement3 = "SELECT * FROM `users` t1 INNER JOIN `user_profile` t2 ON t1.`id`=t2.`id` WHERE t1.`id`= $companyId";
        $accountQuery3 = mysqli_query($conn, $accountStatement3);
        $row3 = mysqli_fetch_array($accountQuery3);
        $fname3 = $row3['fname'];
        $lname3 = $row3['lname'];
        $email3 = $row3['email'];
        $password3 = $row3['password'];
        $bday3 = $row3['bday'];
        $gender3 = $row3['gender'];
        $cnum3 = $row3['cnum'];
        $course3 = $row3['course'];
        $address3 = $row3['address'];
        $yr_graduated3 = $row3['yr_graduated'];
        $regDate3 = $row3['date_registered'];
        $readable_regDate3 = date("F j, Y", $regDate3);
    ?>
    
    

    <div class="profile " style="padding-top: 10px;">
      <div class="container mt-3" style="padding-left: 200px;">
        <div class="card" style="width:800px">
          <div class="card-body">

            <form action="../process.php" method="POST">
            <h2>Edit Company Profile</h2>
            <hr>

            <label><b>Company Name</b></label>
            <input type= "text" class="form-control" name="update_fname" value="<?php echo $fname3; ?>" required><br>
            
            <div class="row gx-3 mb-3">
              <div class="col-md-6">
                <label><b>In Charge</b></label>
                <input type= "text" class="form-control" name="update_lname" value="<?php echo $lname3; ?>" required>
            </div>

            <div class="col-md-6">
                <label><b>Position</b></label>
                <input type= "text" class="form-control" name="update_gender" value="<?php echo $gender3; ?>" required>
                </div>
            </div>

            <div class="row gx-3 mb-3">
              <div class="col-md-6">
                <label><b>Email Address</b></label>
                <input type= "email" class="form-control" name="update_email" value="<?php echo $email3; ?>" required>
              </div>
              
              <div class="col-md-6">
                <label><b>Password</b></label>
                <input type= "password" class="form-control" name="update_password" value="<?php echo $password3; ?>" required>
                </div>
            </div>
            
            <div class="row gx-3 mb-3">
              <div class="col-md-6">
                <label><b>Year Established</b></label>
                <input type= "text" class="form-control" name="update_bday" value="<?php echo $bday3; ?>" required>
              </div>

              <div class="col-md-6">
                <label><b>Industry</b></label>
                <input type= "text" class="form-control" name="update_yr_graduated" value="<?php echo $yr_graduated3; ?>" required>
                </div>
            </div>
            
            <div class="row gx-3 mb-3">
              <div class="col-md-6">
                <label><b>Telephone Number</b></label>
                <input type= "text" class="form-control" name="update_cnum" value="<?php echo $cnum3; ?>" required>
              </div> 

              <div class="col-md-6">
                <label><b>Website Link</b></label>
                <input type= "text" class="form-control" name="update_course" value="<?php echo $course3; ?>" required>
                </div>
            </div>

             <label><b>Address</b></label>
            <input type= "text" class="form-control" name="update_address" value="<?php echo $address3; ?>"required><br>

            <input type="hidden" name="id" value="<?php echo $companyId; ?>">
            
            <div class="button" style="margin-left: 500px;">
            <a href="company_accounts.php" class="btn btn-dark" >Back</a>
            <input type= "submit" name="edit_company" class= "btn btn-success" value="Save Changes">
        </form>
        </div>
        </div>

    </body>
    </html>

    <?php } ?>