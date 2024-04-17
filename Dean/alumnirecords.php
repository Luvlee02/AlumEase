<?php
    include "conn.php";
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Records Page</title>
    <link rel="stylesheet" href="records_style.css">
</head>
<body>

    <div class="nav">
        <a href="index.php"> Add Profile </a> &nbsp; | &nbsp;
        <a href="records.php"> View Records </a>
    </div>
    


    <h1> List of Students </h1>

        <table border="5px solid" >
            <tr>
                <th> ID </th>
                <th> FIRST NAME </th>
                <th> LAST NAME </th>
                <th> DATE OF BIRTH </th>
                <th> GENDER  </th>
                <th> CONTACT NUMBER </th>
                <th> COURSE </th>
                <th> ADDRESS </th>
                <th> YEAR GRADUATED </th>
                <th> ACTION 1 </th>
                <th> ACTION 2 </th>
            </tr>

                <?php
                $getdata = mysqli_query($conn, "SELECT * FROM tbl_list");
                while($row = mysqli_fetch_array($getdata)){
                ?>

            <tr>
                <td> <?php echo $row ['id'];?></td>
                <td> <?php echo $row ['fname'];?></td>
                <td> <?php echo $row ['lname'];?></td>
                <td> <?php echo $row ['bday'];?></td>
                <td> <?php echo $row ['gender'];?></td>
                <td> <?php echo $row ['cnum'];?></td>
                <td> <?php echo $row ['course'];?></td>
                <td> <?php echo $row ['address'];?></td>
                <td> <?php echo $row ['yr_graduated'];?></td>
                <td> <a href="update.php?id=<?php echo $row ['id'];?>"> Update </a> </td>
                <td> <a href="delete.php?id=<?php echo $row['id'];?>"> Delete </td>
            </tr>
                <?php
                }
                ?>

                
        </table>

</body>
</html>




