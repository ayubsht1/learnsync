<?php
session_start();
require '../../connection.php';
$id=$_SESSION['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $subjectId = $_POST["subject"];
    $teacherId = $id; // Replace with your session logic
    $date = date("Y-m-d"); // Current date
    $duedate=$_POST["duedate"];
    $file = $_FILES["file"]["name"];

    // Upload file to a directory on your server
    $target_dir = "assignmentuploads/";
    $target_file = '../../' . $target_dir . basename($_FILES["file"]["name"]);
    move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

    // Insert the assignment into the database
    $sql = "INSERT INTO assignment(subId, teacherId, uploaddate, duedate, name, file) 
            VALUES ('$subjectId', '$teacherId', '$date', '$duedate', '$title', '$file')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>
        alert("Assignment added successfully");
        window.location.href = "../assignment.php";
    </script>
    ';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
