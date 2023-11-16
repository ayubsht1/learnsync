<?php
session_start();
require '../../connection.php';
$id=$_SESSION['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $subjectId = $_POST["subject"];
    $teacherId = $id; // Replace with your session logic
    $date = date("Y-m-d"); // Current date
    $file = $_FILES["file"]["name"];

    // Upload file to a directory on your server
    $target_dir = "noteuploads/";
    $target_file = '../../' . $target_dir . basename($_FILES["file"]["name"]);
    move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

    // Insert the note into the database
    $sql = "INSERT INTO note (subId, teacherId, date, name, file) 
            VALUES ('$subjectId', '$teacherId', '$date', '$title', '$file')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>
        alert("Note added successfully");
        window.location.href = "../index.php";
    </script>
    ';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
