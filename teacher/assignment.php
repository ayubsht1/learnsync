<?php
session_start();
require '../connection.php';
include 'header.php';
$sessionid=$_SESSION['id'];
if(!$sessionid)
{
    header("Location: logint.php");
}
?>

<?php
if (isset($_POST['delete'])) {
    $assignmentid = $_POST['assignmentid'];
    $file=$_POST['file'];
    $file_path = "../assignmentuploads/" . $file;
    $sql = "DELETE FROM assignment WHERE id='$assignmentid'";
    $r = $conn->query($sql);

    if ($r) {
        if (file_exists($file_path)){
            unlink($file_path);
        }
        echo '<script>
            alert("Assignment deleted successfully");
            window.location.href = "assignment.php";
        </script>';
    } else {
        echo '<script>
            alert("Assignment deletion failed");
            window.location.href = "assignment.php";
        </script>';
    }
}
?>
<style>
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
<form action="assignment/add_assignment.php" method="POST">
    <h1> ADD Assignments</h1>
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
    <input type="submit" name="submit">
</form>
<table border="1" width=100%;>
    <th>S.N.</th>
    <th>Title</th>
    <th>Upload Date</th>
    <th>Due Date</th>
    <th>File</th>
    <th>Subject</th>
    <th>Semester</th>
    <th>Action</th>
    <?php
    // Retrieving Data
    $sql = "SELECT assignment.*, subject.name AS subject_name, subject.semester 
    FROM assignment
    INNER JOIN subject ON assignment.subId = subject.id
    WHERE assignment.teacherId = '$sessionid'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $i = 1;
        while ($row = $result->fetch_assoc()) {
            $id=$row['id'];
            echo "<tr>";
            echo "<td>$i</td>";
            $file_name=$row['name'];
            $file_file=$row['file'];
            echo "<td>" . $row['name'] . "
            <a href='../assignmentuploads/$file_file' download='$file_name'>
            download
            </a></td>";
            echo "<td>" . $row['uploaddate'] . "</td>";
            echo "<td>" . $row['duedate'] . "</td>";
            echo "<td>" . $row['file'] . "</td>";
            echo "<td>" . $row['subject_name'] . 
            "</td>"; // Use the alias            
            echo "<td>" . $row['semester'] . "</td>";
            echo "
            <td>
                <form action='assignment/assignment_edit.php' method='POST' style='padding-top: 2px; padding-bottom: 2px;'>
                    <input type='hidden' name='assignmentid' value='$id'>
                    <input type='submit' name='edit' value='edit' style='width: 100%;'>
                </form>
                <form action='assignment.php' method='POST' style='padding-top: 2px; padding-bottom: 2px;'>
                    <input type='hidden' name='assignmentid' value='$id'>
                    <input type='hidden' name='file' value='".$file_file."'>
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
