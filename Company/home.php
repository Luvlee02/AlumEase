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
    $entry_id = $row['entry_id'];
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

    
<!-- <style>
  body{
    padding:0;
    margin: 0;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
  }
  table{
    position: absolute;
    left: 50%;
    top: 60%;
    transform: translate(-50%, -50%);
    border-collapse: collapse;
    width: 800px;
    height: 200px;
    border: 1px solid #bdc3c7;
    box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.2), -1px -1px 8px rgba(0, 0, 0, 0.2);
  }
  tr{
    transition: all -2s. ease-in;
    cursor: pointer;
  }
  th{
    font-size: 12px;
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #ddd;
    width: 15px;
  }
  td{
    font-size: 11px;
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }
  #header{
    background-color: black;
    color: #fff;
  }

  h1{
    font-weight: 600;
    text-align: center;
  }
  /* media query */
  @media only screen and (max-width: 768px){
    table{
      width: 90%
    }
  }

</style> -->

          <h1>Featured Jobs</h1>
        
          <input type="text" placeholder ="Search data" name="search">
          <button>Search</button>
  
          <table>
                <tr id = "header">
                <!-- <th>ID</th>
                <th>Entry ID</th> -->
                <th>Company Name</th>
                <th>Job Title</th>
                <th>Job Type</th>
                <th>Date Posted</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>


          <?php
            include "../conn.php";
    
            $get_data = "SELECT t1.id, t2.fname, t3.entry_id, t3.job_title, t3.job_des, t3.job_type, t3.job_cat, t3.salary, t3.skills, t3.location, t3.date_posted
            FROM users t1
            LEFT OUTER JOIN user_profile t2
            ON t1.id = t2.id 
            LEFT OUTER JOIN add_jobs t3
            ON t1.id = t3.id
            WHERE t1.id = '$browserId'";

            $data = mysqli_query($conn, $get_data);
            while($row = mysqli_fetch_array($data)){



            ?>
              <tr>
                <!-- <th><?php echo $row['id'];?></th>
                <th><?php echo $row['entry_id'];?></th> -->
                <td><?php echo $row['fname'];?></td>
                <td><?php echo $row['job_title'];?></td>
                <td><?php echo $row['job_type'];?></td>
                <td><?php echo date("M d, Y", $row['date_posted']); ?></td>
                <td><a href = "applicants.php?entry_id=<?php echo $row['entry_id'];?>">View Applicants</a>
                <td><a href = "edit_jobpost.php?entry_id=<?php echo $row['entry_id'];?>"><i class="bi bi-pencil-square"></i></a>
                <a href="../delete.php?entry_id=<?php echo $row['entry_id'];?>"><i class="bi bi-trash"></a></td>
                
          
              </tr>
              <?php } ?>
              
            </tbody>
          </table>
      
         

</body>
</html>

<?php } ?>
