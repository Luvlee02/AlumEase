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
    $regDate = $row['date_registered'];
    $readable_regDate = date("F j, Y", $regDate);
    

    $job_id = $_GET['entry_id'];

    $statement = "SELECT * FROM `application` WHERE `id`= '$browserId' AND `entry_id`='$job_id'";
    $query = mysqli_query($conn, $statement);
    $count = mysqli_num_rows($query);
    

?>
          <!-- <form method='post'>
          <input type='hidden' name='entry_id' value='<?php echo $job_id; ?>'>
          <button class='apply_button' type='submit' name='apply'>Apply Now</button>
          </form>"; --> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Form</title>
    <link rel="stylesheet" href="../astyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>


<?php       
  if($count == 0){
?>
 
<div class="container p-4 my-5 border" style="width: 600px">
  <center><h1>Application Form</h1><br></center>
  <form action="../process.php"  enctype = "multipart/form-data" method="POST">
      
  <div class="row">
      <div class="col">
        <LABEL> First Name: </label> 
        <input class= "form-control" type= "text" name="fname"  value="<?php echo $fname; ?>" disabled>
      </div>
      
      <div class="col">
        <LABEL> Last Name: </label> 
        <input class= "form-control" type= "text" name="lname"  value="<?php echo $lname; ?>" disabled><br><br>
      </div>

      <LABEL> Upload Resume </label> 
      <input class= "form-control" type= "file" name="file_content" required>

      <input class= "form-control" type="hidden" name="id" value="<?php echo $browserId; ?>">
  
      <input class= "form-control" type="hidden" name="entry_id" value="<?php echo $job_id; ?>">

      <center><input class="btn btn-success" style="margin-top: 20px;" type= "submit" name="application_form" value="Submit"></br></center>

    </form>

</div>
    
<?php
  }else{
    echo "You already submitted an application for this job post!";
  }
?>
      
  
</body>
</html>

<?php } ?>