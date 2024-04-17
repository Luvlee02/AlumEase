<?php
include "../conn.php";
session_start();

if (!isset($_SESSION['sess_id'])) {
    header("refresh: 2; url=login.php");
} else {
    $browserId = $_SESSION['sess_id'];
    $accountStatement = "SELECT * FROM `users` t1 INNER JOIN `user_profile` t2 ON t1.`id`=t2.`id` WHERE t1.`id`=$browserId";
    $accountQuery = mysqli_query($conn, $accountStatement);
    $row = mysqli_fetch_array($accountQuery);
    $fname = $row['fname'];
    $lname = $row['lname'];
    $regDate = $row['date_registered'];
    $readable_regDate = date("F j, Y", $regDate);


    if(isset($_POST['status'])){
        $id = $_POST['application_id'];
        $entry_id = $_POST['entry_id'];
        $status = $_POST['status'];
    
        $statusUpdate = "UPDATE `application` SET `status` = '$status' WHERE application_id = $id";
    
        $result = mysqli_query($conn, $statusUpdate);
        if($result) {
            echo "<script>
                alert('User status updated successfully!');
                window.location.href='applicants.php?entry_id=$entry_id';
            </script>";
        } else {
            echo "<script>
                alert('Failed to update user status!');
                window.location.href='applicants.php?entry_id=$entry_id';
            </script>";
        }
    }


    
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALUMEASE</title>
    <link rel="stylesheet" href="../mystyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link  rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
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

    <div class="sidebar">
        <center>
            <!-- <img src="../img/profile.jpg" class="profile_image" alt=""> -->
            <h4>Hi! <?php echo $lname; ?></h4>
        </center>
        <a href="company_page.php"><i class="fa-solid fa-desktop"></i><span>Dashboard</span></a>
        <a href="update.php"><i class="fa-regular fa-user"></i><span>Company Profile</span></a>
        <a href="post_a_job.php"><i class="fa-solid fa-briefcase"></i><span>Post a Job</span></a>
        <a href="alumni_accounts.php"><i class="fa-solid fa-users"></i><span>Candidates</span></a>
    </div>
    <!---sidebar area end -->
<?php 
    include "../conn.php";
  ?>
  
  <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>

                        <div class="jobs" style="width:70%;"><br>
                            <div class="container pt-5" style="margin-left: 320px"><br>
                                <h2>Applicants</h2><br>
                                <table id="example" class="table table-hover border-primary text-center">
                                    <thead class="table-success">
                                    <tr id = "header">
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Date Submitted</th>
                                        <th>Download</th>
                                        <th>Status</th>
                                    </tr>
                                <tbody>
                    
                                <?php        
                                    $applicants_id = $_GET['entry_id'];
                                    $statement2 = "SELECT  t2.application_id, t1.id, t2.entry_id, t1.fname, t1.lname, t2.date_submitted, t2.status
                                    FROM `user_profile` t1
                                    INNER JOIN `application` t2
                                    ON t1.`id`= t2.`id`
                                    WHERE t2.`entry_id` = '$applicants_id' ORDER BY `date_submitted` DESC";
                                    
                                    $query = mysqli_query($conn, $statement2);
                                    if (mysqli_num_rows($query) > 0) {
                                        while($row2 = mysqli_fetch_array($query)){  
                                                $application_id = $row2['application_id']; 
                                                $id = $row2['id'];
                                                $entry_id = $row2['entry_id'];
                                                $fname = $row2['fname'];
                                                $lname = $row2['lname'];
                                                $regDate = $row2['date_submitted'];
                                                $status = $row2['status'];
                                ?>
                                    <tr>
                                        <td><?php echo $fname; ?></td>
                                        <td><?php echo $lname; ?></td>
                                        <td><?php echo date("M d, Y", $row2['date_submitted']); ?></td>
                                        <td><a href="../uploads/<?php echo $entry_id . "_" . $id . ".doc"; ?>" target="_blank" style="text-decoration: none;">Resume</a></td>
                                        <td>
                                        <form method="post" action="applicants.php">
                                            <input type="hidden" name="application_id" value="<?php echo $application_id; ?>">
                                            <input type="hidden" name="entry_id" value="<?php echo $applicants_id; ?>">
                                            <select name="status">
                                                <option value="1" <?php if ($status == '1') echo 'selected'; ?>>Pending</option>
                                                <option value="2" <?php if ($status == '2') echo 'selected'; ?>>Under Review</option>
                                                <option value="3" <?php if ($status == '3') echo 'selected'; ?>>Rejected</option>
                                                <option value="4" <?php if ($status == '4') echo 'selected'; ?>>Shortlisted</option>
                                                <!-- <option value="5" <?php if ($status == '5') echo 'selected'; ?>>Interview</option> -->
                                                <option value="6" <?php if ($status == '6') echo 'selected'; ?>>Hired</option>
                                            </select>
                                            <button type="submit" class="btn btn-success" >Update</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='5'>No applicants found</td></tr>";
                                    }
                                ?>
                                </tbody>
                            </table>

</body>
</html>


<?php } ?>
