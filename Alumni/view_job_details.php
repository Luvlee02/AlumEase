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
    $regDate = $row['date_registered'];
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


        <h2>Featured Jobs</h2>

          <table border = 3px solid>
            <thead>
              <tr>
                <th scope="col">Company Name</th>
                <th scope="col">Job Title</th>
                <th scope="col">Job Description</th>
                <th scope="col">Job Type</th>
                <th scope="col">Salary</th>
                <th scope="col">Location</th>
                <th scope="col">Date Posted</th>
                <th scope="col">Action </th>

              </tr>
            </thead>
            <tbody>


          <?php
            include "../conn.php";
            
            $get_data = "SELECT t1.id, t3.entry_id, t2.fname, t3.job_title, t3.job_des, t3.job_type, t3.job_cat, t3.salary, t3.skills, 
            t3.location, t3.date_posted
            FROM users t1
            INNER JOIN user_profile t2
            ON t1.id = t2.id 
            INNER JOIN add_jobs t3
            ON t1.id = t3.id
            WHERE t1.user_type = '4'";

            $data = mysqli_query($conn, $get_data);
            while($row = mysqli_fetch_array($data)){
              $job_post_id = $row['entry_id'];
            
              $statement = "SELECT * FROM `application` WHERE `id`= '$browserId' AND `entry_id`='$job_post_id'";
              $query = mysqli_query($conn, $statement);
              $count = mysqli_num_rows($query);
          
          ?>
              <tr>
                <td><?php echo $row['fname'];?></td>
                <td><?php echo $row['job_title'];?></td>
                <td><?php echo $row['job_des'];?></td>
                <td><?php echo $row['job_type'];?></td>
                <td><?php echo $row['salary'];?></td>
                <td><?php echo $row['location'];?></td>
                <td><?php echo date("F j, Y", $row['date_posted'])?> </td>
                <td><a href="test.php?entry_id=<?php echo $job_post_id; ?>">View</a></td>

              </tr>
              <?php } ?>
              
            </tbody>
          </table>

</body>
</html>

<?php } ?>