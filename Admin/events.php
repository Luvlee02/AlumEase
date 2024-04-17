<?php
  include "../conn.php";
  session_start();

  
  if(!isset($_SESSION['sess_id'])){
    header("refresh: 2; url=login.php");
  }else{
    $browserId = $_SESSION['sess_id'];
    $accountStatement = "SELECT * FROM users t1 INNER JOIN user_profile t2 ON t1.`id` = t2.`id` WHERE t1.`id`='$browserId'";
    $accountQuery = mysqli_query($conn, $accountStatement);
    $row = mysqli_fetch_array($accountQuery);
    $fname = $row['fname'];
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALUMEASE</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
</head>
<body>

    
  <form action="../process.php" method="POST">
  <div class="container mt-3" style="margin-left:300px;"><br>
  <h2>News and Events</h2><br>
    <div class="card" style="width:800px;">
      <div class="card-body">
  
      <label><b>Department</label></b>
        <input class="form-control" type="text"  name="update_fname"  value = "<?php echo $fname ?>"; disabled><br>
        
        <label><b>Title</label></b>
        <input class="form-control" type="text" name="title" placeholder="Enter Title " required><br>

        <label><b>Content</label></b>
        <textarea class="form-control" type="text" name="content" placeholder="Enter Content" required 
        rows="5"></textarea><br>

        <input type="hidden" name="id" value="<?php echo $browserId; ?>">

        <div class="btn" style="margin-left: 600px;">
        <input type="submit" class="btn btn-success" name = "events" value ="POST"> 
        <a href="view_events.php" class="btn btn-dark">Back</a>
        </div>

        </div>
    </div>
  </div>
    </form>
   
  
    <a href="update_events.php"><i class="bi bi-pencil-square"></i></a>
 
</body>

</html>

<?php } ?>