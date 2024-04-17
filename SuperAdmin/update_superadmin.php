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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="mystyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
    <div class="content-profile">
                    <div class="row" style="padding-top: 70px;">
                        <div class="col-xl-8" style="margin-left: 360px;">
                            <div class="card mb-8">
                            <form action="../process.php?id=<?php echo $id;?>" method="POST">
                            <div class="card-header text-white bg-success" ><h3>Account Details</h3></div>
                <div class="card-body">
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1">First name</label>
                            <input type= "text" class="form-control" name="update_fname" value="<?php echo $fname; ?>" required>
                    </div>
                <div class="col-md-6">
                        <label class="small mb-1">Last name</label>  
                        <input type= "text" class="form-control" name="update_lname"value="<?php echo $lname; ?>" required>
                    </div>
                </div>

                    <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1">Date of Birth</label>
                                <input type= "text" class="form-control" name="update_bday" value="<?php echo $bday; ?>" required>
                            </div>

                            <div class="col-md-6">
                                <label class="small mb-1">Gender</label> 
                                <input type= "text" class="form-control" name="update_gender" value="<?php echo $gender; ?>" required>
                            </div>
                    </div>

                    <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1">Contact Number</label>
                                <input type= "text" class="form-control" name="update_cnum" value="<?php echo $cnum; ?>" required>
                            </div>
                  
                            <div class="col-md-6">
                                <label class="small mb-1">Course</label>
                                 <input type= "text" class="form-control" name="update_course" value="<?php echo $course; ?>" required>
                                 </div>
                    </div>

                    <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1">Address</label>
                                <input type= "text" class="form-control" name="update_address" value="<?php echo $address; ?>"required>
                            </div>

                    <div class="col-md-6">
                        <label class="small mb-1">Year Graduated</label>
                        <input type= "text" class="form-control" name="update_yr_graduated" value="<?php echo $yr_graduated; ?>" required>
                        </div>
                    </div>

        <input type= "submit" class="btn btn-success" name="update_superadmin" value="UPDATE">

    </form>
    
</body>
</html>

<?php } ?>