<?php
include "../conn.php";
session_start();

if (!isset($_SESSION['sess_id'])) {
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


if (isset($_POST['save_job_post'])) {
    $id = $_POST['id'];
    $entry_id = $_POST['entry_id'];

    $query = mysqli_query($conn, "SELECT * FROM `saved_jobs` WHERE `id`= '$id' AND `entry_id`='$entry_id'");
    $data = mysqli_num_rows($query);

    if ($data == 0) {
        $insert_query = mysqli_query($conn, "INSERT INTO `saved_jobs`(`id`, `entry_id`)
            VALUES ('$id','$entry_id')");

        if ($insert_query) {
             echo "<script>
                alert('Job saved successfully!');
                window.location.href='job_search.php';
            </script>";
            exit;
        } else {
            echo "<script>
                alert('Error saving job!');
                window.location.href='job_search.php';
            </script>";
            exit; 
        }
    } else {
        echo "<script>
            alert('Job is already saved!');
            window.location.href='job_search.php';
        </script>";
        exit; 
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
            <!-- <img src="../img/profile.jpg" class="profile_image" alt=""> -->
            <h4>Hi! <?php echo $fname; ?></h4>
        </center>
        <a href="alumni_page.php"><i class="fa-solid fa-desktop"></i><span>Dashboard</span></a>
        <a href="update.php"><i class="fa-regular fa-user"></i><span>Profile</span></a>
        <a href="job_search.php"><i class="bi bi-search"></i><span>Job Search</span></a>
        <a href="view_events.php"><i class="bi bi-newspaper"></i><span>News and Events</span></a>
        <a href="saved_jobs.php"><i class="bi bi-journal-text"></i><span>Activities</span></a>
    </div>
    <!---sidebar area end -->

    
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>

  <div class="jobs" style="width:70%;">
    <div class="container pt-5" style="margin-left: 320px"><br>
        <h2>Job Posted</h2><br>
          <table id="example" class="table table-hover border-primary text-center">
            <thead class="table-success">
              <tr id = "header">
                <th scope="col">Company Name</th>
                <th scope="col">Job Title</th>
                <th scope="col">Location</th>
                <th scope="col">Date Posted</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

        
            <?php
            $get_data = "SELECT *, t1.`id` AS `job_post_id` 
                        FROM `add_jobs` t1
                        INNER JOIN `user_profile` t2
                        ON t1.`id`=t2.`id`";

            $data = mysqli_query($conn, $get_data);
            while ($row = mysqli_fetch_array($data)) {
                $job_post_id = $row['entry_id'];

                $statement = "SELECT * FROM `saved_jobs` WHERE `id`= '$browserId' AND `entry_id`='$job_post_id'";
                $query = mysqli_query($conn, $statement);
                $count = mysqli_num_rows($query);
            ?>
            <tr>
                <td><?php echo $row['fname']; ?></td>
                <td><?php echo $row['job_title']; ?></td>
                <td><?php echo $row['location']; ?></td>
                <td><?php echo date("F j, Y", $row['date_posted']) ?> </td>
                <td>
                    <div class="action" style="display: flex; gap: 5px;">
                    <a href="job_details.php?entry_id=<?php echo $job_post_id; ?>"class="btn btn-success" >View</a>
                    <?php if ($count == 0) { ?>
                        <form action="job_search.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $browserId; ?>">
                            <input type="hidden" name="entry_id" value="<?php echo $job_post_id; ?>">
                            <input type="submit" class="btn btn-primary" name="save_job_post" value="Save">
                        </form>
                    <?php } else { ?>
                        <span><button class="btn btn-danger" >Saved</span>
                    <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</div>

</body>
</html>
<?php } ?>