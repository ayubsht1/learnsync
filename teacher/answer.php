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
<h2>Check Answers</h2>
<table border="1" width=100%;>
    <th>S.N.</th>
    <th>Title</th>
    <th>Submitted Date</th>
    <th>Student id</th>
    <th>Student Name</th>
    <th>File</th>
    <th>Subject</th>
    <th>Semester</th>
    <th>Status</th>
    <th>Action</th>
    <?php
    $sql ="SELECT
    answer.id as ans_id,
    answer.file as ans_file,
    answer.up_date as ans_date,
    answer.verify as ans_status,
    student.id as std_id,
    student.name as std_name,
    subject.name as sub_name,
    subject.semester as sub_sem,
    assignment.name as a_name
FROM
    answer
INNER JOIN
    student
ON
    answer.stuId = student.id
INNER JOIN
    subject
ON
    answer.subId = subject.id
INNER JOIN
    assignment
ON
    answer.aId = assignment.id
WHERE
assignment.teacherId='$sessionid'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $i = 1;
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>$i</td>";
            echo "<td>".$row['a_name']."</td>";
            echo "<td>".$row['ans_date']."</td>";
            echo "<td>".$row['std_id']."</td>";
            echo "<td>".$row['std_name']."</td>";
            $file_name=$row['ans_file'];
            $file_file=$row['ans_file'];
            echo "<td>" . $row['ans_file'] . "
            <a href='../answeruploads/$file_file' download='$file_name'>
            download
            </a></td>";
            echo "<td>".$row['sub_name']."</td>";
            echo "<td>".$row['sub_sem']."</td>";
            echo "<td>".$row['ans_status']."</td>";
            $ans_id=$row['ans_id'];
            echo "
            <td>
                <form action='answer.php' method='POST' style='padding-top: 2px; padding-bottom: 2px;'>
                    <input type='hidden' name='ansid' value='$ans_id'>
                    <input type='submit' name='approve' value='approve' style='width: 100%;'>
                </form>
                <form action='answer.php' method='POST' style='padding-top: 2px; padding-bottom: 2px;'>
                    <input type='hidden' name='ansid' value='$ans_id'>
                    <input type='submit' name='deny' value='deny' style='width: 100%;'>
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
<?php
require '../connection.php';
if(isset($_POST['approve'])){
$id=$_POST['ansid'];
$sql="UPDATE answer
SET verify='approved'
where id=$id";
    if($conn->query($sql)){
        echo "<script>alert('Approved successfully'); window.location.href='answer.php';</script>";
    }else 
    echo "<script>alert('Failed to approve'); window.location.href='answer.php';</script>";
} 
else if(isset($_POST['deny'])){
    $id=$_POST['ansid'];
    $file_path = "../noteuploads/" . $file_name;
    if (file_exists($file_path)){
        unlink($file_path);
    }
    $sql="DELETE FROM answer WHERE id=$id";
    // $sql="UPDATE answer
    // SET verify='deny'
    // where id=$id";
        if($conn->query($sql)){
            echo "<script>alert('Deny successful'); window.location.href='answer.php';</script>";
            
        }else 
        echo "<script>alert('Failed to deny'); window.location.href='answer.php';</script>";
    } 
?>