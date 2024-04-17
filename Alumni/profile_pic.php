<?php
  include "../conn.php";
  session_start();

  if(!isset($_SESSION['sess_id'])){
    header("refresh: 2; url=login.php");
  } else {
    $browserId = $_SESSION['sess_id'];
    $accountStatement = "SELECT * FROM `users` t1 INNER JOIN `user_profile` t2 ON t1.`id`=t2.`id` WHERE t1.`id`=$browserId";
    $accountQuery = mysqli_query($conn, $accountStatement);
    $row = mysqli_fetch_array($accountQuery);
    $fname = $row['fname'];
    $lname = $row['lname'];
    $email = $row['email'];
    $regDate = $row['date_registered'];
    $readable_regDate = date("F j, Y", $regDate);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile Picture</title>
</head>
<body>

    
    <form action="../process.php" method="POST" enctype="multipart/form-data">



        <label for="pic">Picture</label> <br>

        <img src="uploads/<?php echo $user['pic']; ?>" id = "image">
        <input type="file" name="pic" id="pic" required accept=".gif, .jpg, .jpeg, .webp"> <br>

        <input type="hidden" name="id" value="<?php echo $browserId; ?>">

        <input type="submit" name="profile_pic" value="SUBMIT">

    </form>

</body>
</html>

<?php } ?>
