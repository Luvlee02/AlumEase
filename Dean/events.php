<?php
  include "../conn.php";
  session_start();

  if(!isset($_SESSION['sess_id'])){
    header("refresh: 2; url=login.php");
  }else{
    $browserId = $_SESSION['sess_id'];
    $accountStatement = "SELECT * FROM users t1 INNER JOIN user_profile t2 ON t1.id = t2.id INNER JOIN events t3 ON t1.id = t3.id
    WHERE t1.id =$browserId"; 

    $accountQuery = mysqli_query($conn, $accountStatement);
    $row = mysqli_fetch_array($accountQuery);
    $entry_id = $row['entry_id'];
    $fname = $row['fname'];
    $title = $row['title'];
    $content = $row['content'];
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
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="../css/postjob.css">
</head>
<body>


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

    <!---sidebar area start -->
    <div class="sidebar">
        <center>
            <img src="../img/profile.jpg" class="profile_image" alt="">
            <h4><?php echo $fname; ?></h4>
        </center>
  <a href="dean_page.php"><i class="fa-solid fa-desktop"></i><span>Dashboard</span></a>
        <a href="profile.php"><i class="fa-regular fa-user"></i><span>My Profile</span></a>
        <a href="job_search.php"><i class="fa-solid fa-magnifying-glass"></i><span>Job Search</span></a>
        <a href="alumni_accounts.php"><i class="fa-solid fa-users"></i><span>Alumni Accounts</span></a>
        <a href="company_accounts.php"><i class="fa-solid fa-users"></i><span>Company Accounts</span></a>
        <a href="#"><i class="fa-regular fa-chart-bar"></i><span>Statistics</span></a>
        <a href="view_events.php"><i class="fa-regular fa-chart-bar"></i><span>News and Events</span></a>
        <a href="#"><i class="fa-solid fa-rectangle-ad"></i><span>Advertisements</span></a>
        <a href="#"><i class="fa-solid fa-circle-info"></i></i><span>About</span></a>
        <a href="#"><i class="fa-solid fa-gear"></i><span>Settings</span></a>
    </div>
    <!---sidebar area end -->

    <div class="container">
    <h1><b>News and Events</h1>
    <p>Please fill in the details of the job you want to post.</p>
    <hr>

    <form action="../process.php" method="POST">

        <label><b>Name</label></b>
        <input type="text"  name="fname"  value = "<?php echo $fname ?>"; required>
        
        <label><b>Title</label></b>
        <input type="text" name="title" placeholder="Enter Title " required>

        <label><b>Content</label></b>
        <input type="text" name="content" placeholder="Enter Content" required>

        <input type="hidden" name="id" value="<?php echo $browserId; ?>">

        <input type="submit" class="submit-btn" name = "events" value ="Post"> 
    
    </form>
  </div>
</body>

</html>

<?php } ?>