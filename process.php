<?php
    include "conn.php";
    session_start();
    date_default_timezone_set('Asia/Hong_Kong');
    $currentUnixTimestamp = time();

    //this code is for Users Registration
    if(isset($_POST['users_reg'])){
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
                    window.location.href="index.php";
                </script>
                <?php
            }else{
                ?>
                <script>
                    alert("Registration is unsuccessful!\nPlease try again!");
                    window.location.href="reg.php";
                </script>
                <?php
            }

        }else{
            ?>
            <script>
                alert("Email is already in use");
                window.location.href="reg.php";
            </script>
            <?php

        }

    }

    if(isset($_POST['approve'])){
        $id = $_POST['id'];
    
        $status = "UPDATE `users` SET `user_status` = '1' WHERE id = $id";
        $result = mysqli_query($conn, $status);
    
        echo "<script>
            alert('User Approved!');
            window.location.href='Admin/admin.php';
        </script>";
    }
    
    if(isset($_POST['reject'])){
        $id = $_POST['id'];
    
        $status = "DELETE FROM `users` WHERE id = $id"; 
        $result = mysqli_query($conn, $status);
    
        echo "<script>
            alert('User Denied!');
            window.location.href='Admin/admin.php';
        </script>";
    }


        //Login Validation for admin
            if(isset($_POST['loginform'])){
                $process_email = $_POST['email'];
                $process_password = $_POST['password'];
            
                $checkAccountStatement = "SELECT * FROM `users` WHERE `email`= '$process_email' AND `password` = '$process_password'";
                $checkAccountQuery = mysqli_query($conn, $checkAccountStatement);
                $countAccount = mysqli_num_rows($checkAccountQuery);
            
                if($countAccount > 0){
                    $row = mysqli_fetch_assoc($checkAccountQuery);
                    $status = $row['user_status'];
                    $_SESSION['sess_id'] = $row['id'];
                    if($status == "1"){
                        switch($row['user_type']){
                            case "1":
                                header("refresh: 2; url=SuperAdmin/superadmin.php");
                                break;
                            case "2":
                                header("refresh: 2; url=Admin/admin_page.php");
                                break;
                            case "3":
                                header("refresh: 2; url=Dean/dean_page.php");
                                break;
                            case "4":
                                header("refresh: 2; url=Company/company_page.php");
                                break;
                            case "5":
                                header("refresh: 2; url=Alumni/alumni_page.php");
                                break;
                            default:
                                break;
                        }
                    } else {
                        ?>
                    <script>
                        alert("Your account is still pending for approval!");
                        window.location.href="index.php";
                    </script>
                    <?php
                    }
                } else {
                    ?>
                    <script>
                        alert("Incorrect Email or Password!");
                        window.location.href="index.php";
                    </script>
                    <?php
                }
            }
        
            

    //Update Super Admin profile
    if(isset($_POST['update_superadmin'])){
        $id = $_POST['id'];
        $update_fname = $_POST['update_fname'];
        $update_lname = $_POST['update_lname'];
        $update_email = $_POST['update_email'];
        $update_password = $_POST['update_password'];
        $update_bday = $_POST['update_bday'];
        $update_gender = $_POST['update_gender'];
        $update_cnum = $_POST['update_cnum'];
        $update_course = $_POST['update_course'];
        $update_address = $_POST['update_address'];
        $update_yr_graduated = $_POST['update_yr_graduated'];

        $update_data= mysqli_query($conn,"UPDATE `users` t1 JOIN `user_profile` t2 ON t1.`id` = t2.`id`
        SET t2.fname='$update_fname', t2.lname='$update_lname', t1.email=' $update_email',t1.password='$update_password', t2.bday='$update_bday',
        t2.gender='$update_gender', t2.cnum='$update_cnum', t2.course='$update_course', t2.address=' $update_address', t2.yr_graduated='$update_yr_graduated' 
        WHERE t1.`id`='$id'");

            if( $update_data == true){
                ?>
                <script>
                    alert("Successfully Updated");
                    window.location.href="SuperAdmin/profile.php";
                </script>
                <?php
            }else{
                ?>
                <script>
                    alert("Failed to Update Profile!\nPlease try again!");
                    window.location.href="SuperAdmin/profile.php";
                </script>
                <?php
            }

    }        

        
    
    

    //Update admin profile
    if(isset($_POST['update_admin'])){

        $id = $_GET['id'];
        $update_fname = $_POST['update_fname'];
        $update_lname = $_POST['update_lname'];
        $update_email = $_POST['update_email'];
        $update_password = $_POST['update_password'];
        $update_bday = $_POST['update_bday'];
        $update_gender = $_POST['update_gender'];
        $update_cnum = $_POST['update_cnum'];
        $update_course = $_POST['update_course'];
        $update_address = $_POST['update_address'];
        $update_yr_graduated = $_POST['update_yr_graduated'];

        $last_id = mysqli_insert_id($conn);
        // INSERT INTO `user_profile` 

        $update_data= mysqli_query($conn,"UPDATE `users` t1 JOIN `user_profile` t2 ON t1.`id` = t2.`id`
        SET t2.fname='$update_fname', t2.lname='$update_lname', t1.email=' $update_email',t1.password='$update_password', t2.bday='$update_bday',
        t2.gender='$update_gender', t2.cnum='$update_cnum', t2.course='$update_course', t2.address=' $update_address', t2.yr_graduated='$update_yr_graduated' 
        WHERE t1.`id`='$id'");


            if( $update_data== true){
                ?>
                <script>
                    alert("Successfully Updated");
                    window.location.href="Admin/update.php";
                </script>
                <?php
            }else{
                ?>
                <script>
                    alert("Error in Saving!\nPlease try again!");
                    window.location.href="Admin/update.php";
                </script>
                <?php
            }

    }


    
    //Update Dean Profile 
    if(isset($_POST['update_dean'])){
        
        $id = $_POST['id'];
        $update_fname = $_POST['update_fname'];
        $update_lname = $_POST['update_lname'];
        $update_email = $_POST['update_email'];
        $update_password = $_POST['update_password'];
        $update_bday = $_POST['update_bday'];
        $update_gender = $_POST['update_gender'];
        $update_cnum = $_POST['update_cnum'];
        $update_course = $_POST['update_course'];
        $update_address = $_POST['update_address'];
        $update_yr_graduated = $_POST['update_yr_graduated'];

         $last_id = mysqli_insert_id($conn);
        // INSERT INTO `user_profile` 
        

        $update_data= mysqli_query($conn,"UPDATE `users` t1 JOIN `user_profile` t2 ON t1.`id` = t2.`id`
        SET t2.fname='$update_fname', t2.lname='$update_lname', t1.email=' $update_email',t1.password='$update_password', t2.bday='$update_bday',
        t2.gender='$update_gender', t2.cnum='$update_cnum', t2.course='$update_course', t2.address=' $update_address', t2.yr_graduated='$update_yr_graduated' 
        WHERE t1.`id`='$id'");


            if( $update_data == true){
                ?>
                <script>
                    alert("Successfully Updated");
                    window.location.href="Dean/update.php";
                </script>
                <?php
            }else{
                ?>
                <script>
                    alert("Error in Saving!\nPlease try again!");
                    window.location.href="Dean/update.php";
                </script>
                <?php
            }

    }
    


    //Update Alumni Profile 
    if(isset($_POST['update_alumni'])){
        
        $id = $_POST['id'];
        $update_fname = $_POST['update_fname'];
        $update_lname = $_POST['update_lname'];
        $update_email = $_POST['update_email'];
        $update_password = $_POST['update_password'];
        $update_bday = $_POST['update_bday'];
        $update_gender = $_POST['update_gender'];
        $update_cnum = $_POST['update_cnum'];
        $update_course = $_POST['update_course'];
        $update_address = $_POST['update_address'];
        $update_yr_graduated = $_POST['update_yr_graduated'];
        $update_skills = $_POST['update_skills'];
        $update_educ_background = $_POST['update_educ_background'];

        $update_data= mysqli_query($conn,"UPDATE `users` t1 JOIN `user_profile` t2 ON t1.`id` = t2.`id`
        JOIN `skills` t3 ON t1.`id` = t3.`id` JOIN `educ_background` t4 ON t1.`id` = t4.`id`
        SET t2.fname='$update_fname', t2.lname='$update_lname', t1.email=' $update_email',t1.password='$update_password', t2.bday='$update_bday',
        t2.gender='$update_gender', t2.cnum='$update_cnum', t2.course='$update_course', t2.address=' $update_address', t2.yr_graduated='$update_yr_graduated',
        t3.skills='$update_skills', t4.educ_background='$update_educ_background'
        WHERE t1.`id`='$id'");


            if( $update_data == true){
                ?>
                <script>
                    alert("Successfully Updated");
                    window.location.href="Alumni/update.php";
                </script>
                <?php
            }else{
                ?>
                <script>
                    alert("Error in Saving!\nPlease try again!");
                    window.location.href="Alumni/update.php";
                </script>
                <?php
            }

    }

    


    


    //Update company profile
    if(isset($_POST['update_company'])){

        $id = $_POST['id'];
        $update_fname = $_POST['update_fname'];
        $update_lname = $_POST['update_lname'];
        $update_email = $_POST['update_email'];
        $update_password = $_POST['update_password'];
        $update_bday = $_POST['update_bday'];
        $update_gender = $_POST['update_gender'];
        $update_cnum = $_POST['update_cnum'];
        $update_course = $_POST['update_course'];
        $update_address = $_POST['update_address'];
        $update_yr_graduated = $_POST['update_yr_graduated'];

        $update_data= mysqli_query($conn,"UPDATE `users` t1 JOIN `user_profile` t2 ON t1.`id` = t2.`id`
        SET t2.fname='$update_fname', t2.lname='$update_lname', t1.email=' $update_email',t1.password='$update_password', t2.bday='$update_bday',
        t2.gender='$update_gender', t2.cnum='$update_cnum', t2.course='$update_course', t2.address=' $update_address', t2.yr_graduated='$update_yr_graduated' 
        WHERE t1.`id`='$id'");

            if( $update_data == true){
                ?>
                <script>
                    alert("Successfully Updated");
                    window.location.href="Company/update.php";
                </script>
                <?php
            }else{
                ?>
                <script>
                    alert("Error in Saving!\nPlease try again!");
                    window.location.href="Company/update.php";
                </script>
                <?php
            }

    }

    //Update Alumni Profile(Super Admin Account) 
    if(isset($_POST['alumni'])){
        
        $id = $_POST['id'];
        $update_fname = $_POST['update_fname'];
        $update_lname = $_POST['update_lname'];
        $update_email = $_POST['update_email'];
        $update_password = $_POST['update_password'];
        $update_bday = $_POST['update_bday'];
        $update_gender = $_POST['update_gender'];
        $update_cnum = $_POST['update_cnum'];
        $update_course = $_POST['update_course'];
        $update_address = $_POST['update_address'];
        $update_yr_graduated = $_POST['update_yr_graduated'];

        
        $update_data= mysqli_query($conn,"UPDATE `users` t1 JOIN `user_profile` t2 ON t1.`id` = t2.`id`
        SET t2.fname='$update_fname', t2.lname='$update_lname', t1.email=' $update_email',t1.password='$update_password', t2.bday='$update_bday',
        t2.gender='$update_gender', t2.cnum='$update_cnum', t2.course='$update_course', t2.address=' $update_address', t2.yr_graduated='$update_yr_graduated' 
        WHERE t1.`id`='$id'");

            if( $update_data == true){
                ?>
                <script>
                    alert("Successfully Updated");
                    window.location.href="SuperAdmin/alumni_accounts.php";
                </script>
                <?php
            }else{
                ?>
                <script>
                    alert("Error in Saving!\nPlease try again!");
                    window.location.href="SuperAdmin/alumni_accounts.php";
                </script>
                <?php
            }

    }


    //Update Company Profile(Super Admin Account) 
    if(isset($_POST['edit_company'])){
        
        $id = $_POST['id'];
        $update_fname = $_POST['update_fname'];
        $update_lname = $_POST['update_lname'];
        $update_email = $_POST['update_email'];
        $update_password = $_POST['update_password'];
        $update_bday = $_POST['update_bday'];
        $update_gender = $_POST['update_gender'];
        $update_cnum = $_POST['update_cnum'];
        $update_course = $_POST['update_course'];
        $update_address = $_POST['update_address'];
        $update_yr_graduated = $_POST['update_yr_graduated'];

        
        $update_data= mysqli_query($conn,"UPDATE `users` t1 JOIN `user_profile` t2 ON t1.`id` = t2.`id`
        SET t2.fname='$update_fname', t2.lname='$update_lname', t1.email=' $update_email',t1.password='$update_password', t2.bday='$update_bday',
        t2.gender='$update_gender', t2.cnum='$update_cnum', t2.course='$update_course', t2.address=' $update_address', t2.yr_graduated='$update_yr_graduated' 
        WHERE t1.`id`='$id'");

            if( $update_data == true){
                ?>
                <script>
                    alert("Successfully Updated");
                    window.location.href="SuperAdmin/company_accounts.php";
                </script>
                <?php
            }else{
                ?>
                <script>
                    alert("Error in Saving!\nPlease try again!");
                    window.location.href="SuperAdmin/company_accounts.php";
                </script>
                <?php
            }

    }



    
    //Update Alumni Profile(Admin Account) 
    if(isset($_POST['edit_alumni'])){
        
        $id = $_POST['id'];
        $update_fname = $_POST['update_fname'];
        $update_lname = $_POST['update_lname'];
        $update_email = $_POST['update_email'];
        $update_password = $_POST['update_password'];
        $update_bday = $_POST['update_bday'];
        $update_gender = $_POST['update_gender'];
        $update_cnum = $_POST['update_cnum'];
        $update_course = $_POST['update_course'];
        $update_address = $_POST['update_address'];
        $update_yr_graduated = $_POST['update_yr_graduated'];

        
        $update_data= mysqli_query($conn,"UPDATE `users` t1 JOIN `user_profile` t2 ON t1.`id` = t2.`id`
        SET t2.fname='$update_fname', t2.lname='$update_lname', t1.email=' $update_email',t1.password='$update_password', t2.bday='$update_bday',
        t2.gender='$update_gender', t2.cnum='$update_cnum', t2.course='$update_course', t2.address=' $update_address', t2.yr_graduated='$update_yr_graduated' 
        WHERE t1.`id`='$id'");

            if( $update_data == true){
                ?>
                <script>
                    alert("Successfully Updated");
                    window.location.href="Admin/alumni_accounts.php";
                </script>
                <?php
            }else{
                ?>
                <script>
                    alert("Error in Saving!\nPlease try again!");
                    window.location.href="Admin/alumni_accounts.php";
                </script>
                <?php
            }

    }


    //Update Company Profile(Admin Account) 
    if(isset($_POST['edit_company'])){
        
        $company_id = $_POST['id'];
        $update_fname = $_POST['update_fname'];
        $update_lname = $_POST['update_lname'];
        $update_email = $_POST['update_email'];
        $update_password = $_POST['update_password'];
        $update_bday = $_POST['update_bday'];
        $update_gender = $_POST['update_gender'];
        $update_cnum = $_POST['update_cnum'];
        $update_course = $_POST['update_course'];
        $update_address = $_POST['update_address'];
        $update_yr_graduated = $_POST['update_yr_graduated'];

   
        $update_data= mysqli_query($conn,"UPDATE `users` t1 JOIN `user_profile` t2 ON t1.`id` = t2.`id`
        SET t2.fname='$update_fname', t2.lname='$update_lname', t1.email=' $update_email', t1.password='$update_password', t2.bday='$update_bday',
        t2.gender='$update_gender', t2.cnum='$update_cnum', t2.course='$update_course', t2.address='$update_address', t2.yr_graduated='$update_yr_graduated' 
        WHERE t1.`id`='$company_id'");

            if( $update_data == true){
                ?>
                <script>
                    alert("Successfully Updated");
                    window.location.href="Admin/company_accounts.php";
                </script>
                <?php
            }else{
                ?>
                <script>
                    alert("Error in Saving!\nPlease try again!");
                    window.location.href="Admin/company_accounts.php";
                </script>
                <?php
            }

    }

    //this code is for Posting Events
    if(isset($_POST['events'])){
        $entry_id = $_POST['entry_id'];
        $id = $_POST['id'];
        $title = $_POST['title'];
        $content = $_POST['content'];
    
        $insert_query  = mysqli_query($conn, "INSERT INTO `events` (`entry_id`, `id`,`title`, `content`, `date_posted`) 
        VALUES ('$entry_id','$id', '$title', '$content', '$currentUnixTimestamp')");
                
        if($insert_query==true){
            ?>
            <script>
                alert("Data inserted successfully!");
                window.location.href="Admin/view_events.php";
            </script>
            <?php
        }else{
            ?>
            <script>
                alert("Posting Unsuccessful!\nPlease try again!");
                window.location.href="Admin/events.php";
            </script>
            <?php
        }

    }


 //this code is for Posting Events
 if(isset($_POST['update_events'])){
    $entry_id = $_POST['entry_id'];
    $update_fname = $_POST['update_fname'];
    $update_title = $_POST['update_title'];
    $update_content = $_POST['update_content'];

    $update_data= mysqli_query($conn,"UPDATE `events` SET `entry_id`='$entry_id', `title` = '$update_title', `content`= '$update_content'
    WHERE `entry_id`='$entry_id'");

    if($update_data==true){
        ?>
        <script>
            alert("You have successfully posted");
            window.location.href="Admin/view_events.php";
        </script>
        <?php
    }else{
        ?>
        <script>
            alert("Posting Unsuccessful!\nPlease try again!");
            window.location.href="Admin/update_events.php";
        </script>
        <?php
    }

}


    //this code is for Posting Jobs
    if(isset($_POST['add_jobs'])){
        $entry_id = $_POST['entry_id'];
        $id = $_POST['id'];
        $job_title = $_POST['job_title'];
        $job_des = $_POST['job_des'];
        $job_type = $_POST['job_type'];
        $category = $_POST['category'];
        $salary = $_POST['salary'];
        $skills = $_POST['skills'];
        $location = $_POST['location'];

        $insert_query  = mysqli_query($conn, "INSERT INTO `add_jobs`(`entry_id`, `id`, `job_title`, `job_des`, `job_type`, `category`, `salary`, `skills`, `location`, `date_posted`) 
        VALUES ('$entry_id','$id','$job_title', '$job_des', '$job_type', '$category', '$salary', '$skills', '$location', '$currentUnixTimestamp')");
        if($insert_query==true){
            ?>
            <script>
                alert("You have successfully posted");
                window.location.href="Company/post_a_job.php";
            </script>
            <?php
        }else{
            ?>
            <script>
                alert("Posting Unsuccessful!\nPlease try again!");
                window.location.href="Company/post_a_job.php";
            </script>
            <?php
        }

    }

    //Update Job Post (Company Account)
    if(isset($_POST['job_post'])){
        $entry_id = $_POST['entry_id'];
        $update_fname = $_POST['update_fname'];
        $update_job_title = $_POST['update_job_title'];
        $update_job_des = $_POST['update_job_des'];
        $update_job_type = $_POST['update_job_type'];
        $update_job_cat = $_POST['update_job_cat'];
        $update_salary = $_POST['update_salary'];
        $update_skills = $_POST['update_skills'];
        $update_location = $_POST['update_location'];

        $update_data= mysqli_query($conn,"UPDATE add_jobs SET `entry_id`='$entry_id', job_title='$update_job_title', job_des='$update_job_des', job_type='$update_job_type', category='$update_job_cat', 
        salary='$update_salary', skills='$update_skills', location='$update_location' WHERE entry_id='$entry_id'");



            if( $update_data == true){
                ?>
                <script>
                    alert("Successfully Updated");
                    window.location.href="Company/view_jobposted.php";
                </script>
                <?php
            }else{
                ?>
                <script>
                    alert("Error in Saving!\nPlease try again!");
                    window.location.href="Company/edit_jobpost.php";
                </script>
                <?php
            }

    }



        if(isset($_POST["application_form"])) {
            $application_id = $_POST['application_id']; 
            $id = $_POST['id'];
            $entry_id = $_POST['entry_id'];
            $status = $_POST['status'];
        
            $fileContentName = $_FILES['file_content']['name'];
            $fileContentTmpName = $_FILES['file_content']['tmp_name'];
            $fileContentSize = $_FILES['file_content']['size'];

        
            $explodedFile = explode('.', $fileContentName);
            $fileExtension = end($explodedFile);
            $fileValidateExt = strtolower($fileExtension); 
        
            $allowedFormats = array("doc", "DOC", "docx", "DOCX");
        
            if ($fileContentSize < 20000000) {
                if (in_array($fileValidateExt, $allowedFormats)) {
                    
                    $newFileName = $entry_id . "_" . $id . ".doc";
                    $fileImgDestination = 'uploads/' . $newFileName;

                    move_uploaded_file($fileContentTmpName, $fileImgDestination);
                    
                    $insert = mysqli_query($conn, "INSERT INTO `application`(`application_id`, `id`, `entry_id`, `date_submitted`, `status`)
                    VALUES ('$application_id', '$id', '$entry_id', '$currentUnixTimestamp', 1)");

                        if( $insert == true){
                            ?>
                            <script>
                                alert("Successfully Applied");
                                window.location.href="Alumni/job_search.php";
                            </script>
                            <?php
                        }else{
                            ?>
                            <script>
                                alert("Error in  Applying!\nPlease try again!");
                                window.location.href="Alumni/job_search.php";
                            </script>
                            <?php
                        }
                } else {
                    echo "Invalid Format. This process only accepts .doc and .docx formats only";
                }
            } else {
                echo "File Size is too big! File should be less than 20mb";
            }
        }
        


?>


   
