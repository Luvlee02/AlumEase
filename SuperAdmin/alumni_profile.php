
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
    <link rel="stylesheet" href="uprofile.css">
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link  rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>

        <?php

        include "../conn.php";

                $alumni_id = $_GET['id'];
                $statement = "SELECT * FROM `users` t1 INNER JOIN `user_profile` t2 ON t1.`id`=t2.`id` 
                WHERE t1.`id` = '$alumni_id'";
                $query = mysqli_query($conn, $statement);
                $row = mysqli_fetch_assoc($query);

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
        ?>

                <div class="content-profile">
                    <div class="row" style="padding-top: 50px;">
                        <div class="col-xl-8" style="margin-left: 300px;">
                            <div class="card mb-8">
                            <div class="card-header text-white bg-success" ><h3>User Account Details</h3></div>
                <div class="card-body">
                    <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1">First name</label>
                                <input class="form-control" type= "text" name="update_fname" value="<?php echo $fname; ?>" disabled>
                            </div>
                           
                            <div class="col-md-6">
                                <label class="small mb-1">Last name</label>
                                <input class="form-control" type= "text" name="update_lname" value="<?php echo $lname; ?>" disabled>
                            </div>
                        </div>
                  
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1">Email</label>
                                <input class="form-control" type="email" name="update_email" value="<?php echo $email; ?>" disabled>
                            </div>
                         
                            <div class="col-md-6">
                                <label class="small mb-1">Year Graduated</label>
                                <input class="form-control" type= "text" name="update_yr_graduated" value="<?php echo $yr_graduated; ?>" disabled>
                            </div>
                        </div>

                        <div class="row gx-3 mb-3">
                          <div class="col-md-6">
                                <label class="small mb-1">Date of Birth</label>
                                <input class="form-control" type= "text" name="update_bday" value="<?php echo $bday; ?>" disabled>
                            </div>
                         
                            <div class="col-md-6">
                                <label class="small mb-1">Gender</label>
                                <input class="form-control" type= "text" name="update_gender" value="<?php echo $gender; ?>" disabled>
                            </div>
                        </div>
                       
                        <div class="row gx-3 mb-3">
                           
                            <div class="col-md-6">
                                <label class="small mb-1">Phone number</label>
                                <input class="form-control" type= "text" name="update_cnum" value="<?php echo $cnum; ?>" disabled>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="small mb-1">Course</label>
                                <input class="form-control" type= "text" name="update_course" value="<?php echo $course; ?>" disabled>
                            </div>
                        </div>

                        <div class="row gx-3 mb-3">
                            
                            <div class="col-md-6">
                                <label class="small mb-1">Address</label>
                                <input class="form-control"type= "text" name="update_address" value="<?php echo $address; ?>"disabled>
                            </div>
                          
                        </div>

                        <input type ="hidden" name="id" value="<?php echo $browserId;?>">
                        <div class="button" style="margin-left: 750px;">
                             <a href="alumni_accounts.php" class="btn btn-dark" >Back</a>
                        </div>  
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

</body>
</html>

<?php } ?>


</body>
</html>