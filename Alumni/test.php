<?php
  include "../conn.php";
  session_start();

  if(!isset($_SESSION['sess_id'])){
    header("refresh: 2; url=login.php");
  }else{
    $browserId = $_SESSION['sess_id'];
    $accountStatement = "SELECT * FROM `users` t1 INNER JOIN `user_profile` t2 ON t1.`id`=t2.`id` 
    INNER JOIN `add_jobs` t3 ON t1.`id`=t2.`id`
    WHERE t1.`id`=$browserId";
    $accountQuery = mysqli_query($conn, $accountStatement);
    $row = mysqli_fetch_array($accountQuery);
    $fname = $row['fname'];
    $lname = $row['lname'];
    $job_title = $row['job_title']; 
    $job_des = $row['job_des'];
    $job_type = $row['job_type'];
    $job_cat = $row['job_cat'];
    $salary = $row['salary'];
    $skills = $row['skills'];
    $location = $row['location'];
    $regDate = $row['date_posted'];
    $readable_regDate = date("F j, Y", $regDate);

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALUMEASE</title>
    <link rel="stylesheet" href="../astyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>
        
<?php

            include "../conn.php";

            $job_post_id = $_GET['entry_id'];
            $a = "SELECT * FROM `add_jobs` WHERE `entry_id`=$job_post_id";
            $b = mysqli_query($conn, $a);
            $c = mysqli_fetch_assoc($b);

              $statement = "SELECT * FROM `application` WHERE `id`= '$browserId' AND `entry_id`='$job_post_id'";
              $query = mysqli_query($conn, $statement);
              $count = mysqli_num_rows($query);

              ?>
              
              <td><?php echo $job_post_id;?></td>
                    <p><?php echo $c['job_title'];?>
                    <p><?php echo $c['job_des'];?>
                    <p><?php echo $c['job_type'];?>
                    <p><?php echo $c['job_cat'];?>
                    <p><?php echo $c['salary'];?>
                    <p><?php echo $c['skills'];?>
                    <p><?php echo $c['location'];?></p>
                    <p><?php echo date("M d, Y", $c['date_posted']); ?></p>
                    <?php 
                          if ($count == 0){
                              echo '<a href="application_form.php?entry_id=' .$job_post_id . '">Apply</a>';
                          }else{
                            echo "Applied";
                          }
                        ?>
                        <a href="application_form.php?entry_id=<?php echo $job_post_id;?>">SAVE</a>
         
              </div>
           </div>

</body>
</html>

<?php } ?>