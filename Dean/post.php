<?php
  include "../conn.php";
  session_start();

  if(!isset($_SESSION['sess_id'])){
    header("refresh: 2; url=login.php");
  }else{
    $browserId = $_SESSION['sess_id'];
    $accountStatement = "SELECT * FROM users t1 INNER JOIN user_profile t2 ON t1.`id` = t2.`id` INNER JOIN add_jobs t3 ON t1.`id` = t3.`id`
    WHERE t1.`id`=$browserId";
    $accountQuery = mysqli_query($conn, $accountStatement);
    $row = mysqli_fetch_array($accountQuery);
 
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

          <h1>News and Events</h1>

          <a href="events.php"> Add news and Events</a>
         
          <table border = 3px solid>
          <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Entry ID</th>
                <th scope="col">name</th>
                <th scope="col">Title</th>
                <th scope="col">Content</th>
                <th scope="col">Date Posted</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>


          <?php
            include "../conn.php";

            $get_data = "SELECT t1.id, t3.entry_id, t2.fname, t3.title, t3.content, t3.date_posted 
            FROM users t1 
            INNER JOIN user_profile t2 
            ON t1.id = t2.id 
            INNER JOIN events t3 
            ON t1.id = t3.id 
            WHERE t1.user_type IN ('3')";

            $data = mysqli_query($conn, $get_data);
            while($row = mysqli_fetch_array($data)){
          ?>
      
  
              <tr>
                <th><?php echo $row['id'];?></th></br>
                <th><?php echo $row['entry_id'];?></th></br>
                <td><?php echo $row['fname'];?></td></br>
                <td><?php echo $row['title'];?></td></br>
                <td><?php echo $row['content'];?></td></br>
                <td><?php echo date("F j, Y", $row['date_posted'])?> </td>
                <td><a href="update_events.php?entry_id=<?php echo $row['entry_id'];?>"><i class="bi bi-pencil-square"></i></a></td> 
                <td><a href="../delete.php?entry_id=<?php echo $row['entry_id'];?>"><i class="bi bi-trash"></a></td>

              </tr>
              <?php } ?>
              
            </tbody>
          </table>
          <!-- <a href="events.php"> <i class="bi bi-plus-square-fill"></i></a> -->
           

</body>
</html>

<?php } ?>