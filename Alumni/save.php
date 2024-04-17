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

      $job_id = $_GET['entry_id'];
      $statement = "SELECT * FROM `application` WHERE `id`= '$browserId' AND `entry_id`='$job_id'";
      $query = mysqli_query($conn, $statement);
      $count = mysqli_num_rows($query);
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALUMEASE</title>
    <link rel="stylesheet" href="../astyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="../css/postjob.css">
</head>
<body>


    <h1><b>Saved Jobs</h1>

    <form action="../process.php" method="POST">

        <label>User ID</label>
        <input type="text" name="id" value="<?php echo $browserId; ?>">

        <label>Job ID</label>
        <input type="text" name="entry_id" value="<?php echo $job_id; ?>">

        <input type="submit" name = "save_job_post" value ="SAVE"> 
    
    </form>
    <?php

?>
    

</body>

</html>

<?php } ?>