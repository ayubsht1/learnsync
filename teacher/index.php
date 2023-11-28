<?php
session_start();
require '../connection.php';
include 'header.php';
$sessionid=$_SESSION['id'];
if(!$sessionid)
{
    header("Location: logint.php");
    exit();
}
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$sql1="SELECT verify FROM teacher where id=$sessionid";
$res = $conn->query($sql1);
while ($row=mysqli_fetch_assoc($res)){
  $verify = $row["verify"];
  if( $verify === 'no'){
    echo "<script>alert('Your account is not verified');</script>";
    // Clear all session variables
    $_SESSION = array();
    // Destroy the session
    session_destroy();
    // Redirect the user to the login page or any desired page
    echo "<script>window.location.href = 'logint.php';</script>";
    exit();
    exit;
  }
}

?>



<?php

if (isset($_POST['delete'])) {
    $noteid = $_POST['noteid'];
    $file=$_POST['file'];
    $sql = "DELETE FROM note WHERE id='$noteid'";
    $r = $conn->query($sql);
    $file_path = "../noteuploads/" . $file;
    if ($r) {
        if (file_exists($file_path)){
            unlink($file_path);
        }
        echo '<script>
            alert("Note deleted successfully");
            window.location.href = "index.php";
        </script>';
    } else {
        echo '<script>
            alert("Note deletion failed");
            window.location.href = "index.php";
        </script>';
    }
}



?>
<style>
    /* body{
  background-image:url("../images/b.jpg");
  background-size: cover;
} */
    .table-container {
        max-width:80%; /* Set the maximum width of the container */
        margin: 0 auto; /* Center the container horizontally */
        padding: 10px; /* Add 10px padding on all sides */
        background-color: #ffffff; /* Background color for the container */
        border: 1px solid #dddddd; /* Add a border around the container */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Add a box shadow for a raised effect */
        border-radius: 5px; /* Add rounded corners */
    }

    /* Style for the table within the container */
    .table-container table {
        width: 100%;
        border-collapse: collapse; /* Collapse table borders */
    }

    .table-container th,
    .table-container td {
        border: 1px solid #dddddd; /* Add borders to table cells */
        padding: 8px; /* Add padding to table cells */
        text-align: left; /* Align text to the left within cells */
    }

    /* Add additional styles to table headers (th) if needed */
    .table-container th {
        background-color: #f2f2f2; /* Background color for header cells */
        font-weight: bold; /* Bold text for header cells */
    }

    /* Style alternate rows with a different background color */
    .table-container tr:nth-child(even) {
        background-color: #f9f9f9; /* Background color for even rows */
    }
</style>
<div class="table-container">
<form action="notes/add_note_form.php" method="POST">
    <h1> ADD NOTE</h1>
    <label for="semid">Choose Semester:</label>
    <select name="semid" id="semid">
        <?php
        // Assuming you have a database connection named $conn
        $sql =" SELECT * FROM semester
        ORDER BY semID ASC";
        
        $result = $conn->query($sql);

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $semid = $row['semID'];
                $semname = $row['sem_name'];
                echo "<option value='$semid'>$semname</option>";
            }
        }
        ?>
    </select>
    <input type="submit" name="sem" value="Submit">
</form>

<!-- <a href="notes/add_note_form.php"><button>ADD</button></a> -->

<table border="1" width=100%;>
    <th>S.N.</th>
    <th>Title</th>
    <th>Date</th>
    <th>File</th>
    <th>Subject</th>
    <th>Semester</th>
    <th>Action</th>

    <?php
    // Retrieving Data
    $sql = "SELECT note.*, subject.name AS subject_name, subject.semester 
            FROM note 
            INNER JOIN subject ON note.subId = subject.id
            WHERE note.teacherId = '$sessionid'"; // Assuming teacherId is a column in the 'note' table

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $i = 1;
        while ($row = $result->fetch_assoc()) {
            $id=$row['id'];
            echo "<tr>";
            echo "<td>$i</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['date'] . "</td>";
            echo "<td>" . $row['file'] . "</td>";
            $file_name=$row['name'];
            $file_file=$row['file'];
            echo "<td>" . $row['subject_name'] . 
            "
            <a href='../noteuploads/$file_file' download='$file_name'>
            download
            </a>
            </td>"; // Use the alias            
            echo "<td>" . $row['semester'] . "</td>";
            echo "
            <td>
                <form action='notes/note_edit.php' method='POST' style='padding-top: 2px; padding-bottom: 2px;'>
                    <input type='hidden' name='noteid' value='$id'>
                    <input type='submit' name='edit' value='edit' style='width: 100%;'>
                </form>
        
                <form action='index.php' method='POST' style='padding-top: 2px; padding-bottom: 2px;'>
                    <input type='hidden' name='noteid' value='$id'>
                    <input type='hidden' name='file' value='".htmlspecialchars($file_file,ENT_QUOTES,'UTF-8')."'>
                    <input type='submit' name='delete' value='delete' style='width: 100%;'>
                </form>
            </td>";
        
            echo "</tr>";
            $i++;
        }
    } else {
        echo "No results found.";
    }


    ?>
</table>
</div>
