<?php
  include "../conn.php";
  session_start();

  
  if(!isset($_SESSION['sess_id'])){
    header("refresh: 2; url=login.php");
  }else{
    $browserId = $_SESSION['sess_id'];
    $accountStatement = "SELECT * FROM users t1 INNER JOIN user_profile t2 ON t1.`id` = t2.`id` 
    INNER JOIN events t3 ON t1.`id` = t3.`id`
    WHERE t1.`id`='$browserId'";

    $accountQuery = mysqli_query($conn, $accountStatement);
    $row = mysqli_fetch_array($accountQuery);
    $entry_id = $row['entry_id'];
    $fname = $row['fname'];
    $title = $row['title'];
    $content = $row['content'];
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
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="../css/postjob.css">
</head>
<body>
    
    <?php 
        $eventID = $_GET['entry_id'];
        $accountStatement2 = "SELECT t1.id, t3.entry_id, t2.fname,  t3.title, t3.content, t3.date_posted 
        FROM users t1 
        INNER JOIN user_profile t2 ON t1.id = t2.id
        INNER JOIN events t3
        ON t1.`id` = t3.`id`
        WHERE t1.`id` = $browserId AND t3.`entry_id` = '$eventID'";

        $accountQuery2 = mysqli_query($conn, $accountStatement2);
        $row2 = mysqli_fetch_array($accountQuery2);
        $fname2 = $row2['fname'];
        $title2 = $row2['title'];
        $content2 = $row2['content'];
        $regDate2 = $row2['date_posted'];
        $readable_regDate2 = date("F j, Y", $regDate2);
    ?>



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

    <div class="container">
    <h1><b>EDIT JOB POST</b></h1>
    <p>Please fill in the details of the job you want to post.</p>
    <hr>

    <form action="../process.php" method="POST">

        <label><b>Company Name</label></b>
        <input type="text"  name="update_fname"  value = "<?php echo $fname2 ?>"; required>
        
        <label><b>Title</label></b>
        <input type="text" name="update_title" placeholder="Enter Title" value = "<?php echo $job_title2 ?>";required>

        <label><b>Content</b></label>
        <input type="text" name="update_content" placeholder="Enter Content" value = "<?php echo $job_des2 ?>";required>

        <input type="hidden" name="id" value="<?php echo $browserId; ?>">
        <input type="hidden" name="entry_id" value="<?php echo $eventID; ?>">

        <input type="submit" class="submit-btn" name = "update_events" value ="Update"> 
    </div>
  </form>

</body>

</html>

<?php } ?>