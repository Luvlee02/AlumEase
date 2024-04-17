<?php
    include "../conn.php";
    session_start();
    date_default_timezone_set('Asia/Hong_Kong');
    $currentUnixTimestamp = time();

    //this code is for Users Registration
    if(isset($_POST['alumni_reg'])){
        $type = $_POST['user_type'];
        $status = $_POST['user_status'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        //validation
        $validate = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
        $validate_num = mysqli_num_rows($validate);

        if($validate_num <= 0){
    
            $insert = "INSERT INTO `users`(`user_type`, `user_status`, `email`, `password`, `date_registered`) 
            VALUES ($type, 3, '$email','$password', '$currentUnixTimestamp')";
            mysqli_query($conn, $insert);

            
            $last_id = mysqli_insert_id($conn);
            // INSERT INTO `user_profile` 

            
            $insert_data =mysqli_query($conn, "INSERT INTO `user_profile` (`id`, `fname`, `lname`, `bday`, `gender`, `cnum`, `course`, `address`, `yr_graduated`)
            VALUES('$last_id', '', '', '', '', '', '', '', '')");

            $insert_skills =mysqli_query($conn, "INSERT INTO `skills` (`id`, `skills`)
            VALUES('$last_id', '')");

            $insert_educational_background =mysqli_query($conn, "INSERT INTO `educ_background` (`id`, `educ_background`)
            VALUES('$last_id', '')");

            if($insert){
                ?>
                <script>

                    alert("Your Registration is Successful!");
                    window.location.href="alumni_accounts.php";
                </script>
                <?php
            }else{
                ?>
                <script>
                    alert("Registration is unsuccessful!\nPlease try again!");
                    window.location.href="alumni_accounts.php";
                </script>
                <?php
            }

        }else{
            ?>
            <script>
                alert("Email is already in use");
                window.location.href="alumni_accounts.php";
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
    <title>Registration Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" >
    
</head>
<body>


<div class="container mt-3" style="margin-left:420px" >
  <div class="card" style="width:500px">
    <div class="card-body">
    <center>
      <h1><b>REGISTER</b></h1>
            <p>Please fill in this form to create an account.<br>
        <hr> 
        </center>
        <form action="reg.php" method ="POST">
                
                    <label><b>User Type</b></label><br>
                        <select class= "form-select" name="user_type" style="width: 200px;">
                            <option selected> </option> 
                            <option value="4">Company</option>
                            <option value="5">Alumni</option>
                        </select><br>
    
                       
                    <div class="col">
                        <input type="hidden" name="user_status" value="Pending">
                    <div>
                            

                    <label><b>Email</b></label>
                    <input type="email" class="form-control" placeholder="Enter Email" name="email" required><br>
                      
                    <label><b>Password</b></label>
                    <input type="password" name="password" placeholder="Enter Password" class="form-control" id="Password3" 
                      pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                      title="Must contain at least one number and one uppercase and lowercase letter, 
                      and at least 8 or more characters" required>
                   

                    <div class="mx-auto" style="padding: 10px;">
                      <input type="checkbox" onclick="myFunctions()"> Show Password
                    </div>
            
                    <div class="btn" style="margin-left: 250px;">
                        <a href="SuperAdmin/alumni_accounts.php" class="btn btn-dark">Back</a>
                        <input type="submit" name="alumni_reg" class="btn btn-success" value="REGISTER" style="width: 100px;">  
                    </div>
            </form>
    </div>
  </div>      

<script>
    function myFunctions() {
    var x = document.getElementById("Password3");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
</script>
</body>
</html>