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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../astyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    

    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>


</head>
<body>

                    <h1>Job Applications</h1>
                    <div class="container pt-5">
                        <table id="example" class="table table-striped" style="width:70%">
                            <thead>
                                <tr>
                                <th>Company Name</th>
                                <th>Job Title</th>
                                <th>Job Description</th>
                                <th>Location</th>
                                <th>Date Submitted</th>
                                <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                          <?php
                          include "../conn.php";

                                $fetchAppliedJobs = "SELECT t1.id, t3.entry_id, t4.fname, t3.job_title, t3.job_des, t3.location, t2.date_submitted, t5.status 
                                FROM users t1 
                                INNER JOIN application t2 ON t1.id = t2.id 
                                INNER JOIN add_jobs t3 ON t2.entry_id = t3.entry_id 
                                INNER JOIN user_profile t4 ON t3.id = t4.id 
                                INNER JOIN status t5 ON t2.status = t5.id
                                WHERE t1.id = '$browserId' ORDER BY date_submitted DESC";
                                  $data = mysqli_query($conn, $fetchAppliedJobs);
                                  while ($row = mysqli_fetch_array($data)) {
                                      $job_post_id = $row['entry_id'];
                                  
                                      ?>
                                      <tr>
                                          <td><?php echo $row['fname'] ?></td>
                                          <td><?php echo $row['job_title'] ?></td>
                                          <td><?php echo $row['job_des'] ?></td>
                                          <td><?php echo $row['location'] ?></td>
                                          <td><?php echo date("M d, Y", $row['date_submitted']); ?></p></td>
                                          <td><?php echo $row['status'] ?></td>
                                      </tr>
                                  <?php } ?>
                          </tbody>
                        </table>

</body>
</html>

<?php } ?>
<!-- 
SELECT t1.id, t3.entry_id, t3.job_title, t3.job_des, t3.location, t3.date_posted, t2.status FROM users t1 
INNER JOIN application t2 ON t1.id = t2.id 
INNER JOIN add_jobs t3 ON t2.entry_id = t3.entry_id 
INNER JOIN user_profile t4 ON t3.id = t4.id WHERE t1.id = '83'; -->


 
       

       