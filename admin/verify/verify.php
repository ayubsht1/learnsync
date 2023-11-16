<?php
if (isset($_GET['id'])) {
    $teacherId = $_GET['id'];

    // Connect to the MySQL database
    require '../../connection.php';

    // Update the teacher's verification status in the database
    $sql = "UPDATE teacher SET verify = 'yes' WHERE id = $teacherId";

    if ($conn->query($sql) === TRUE) {
        // echo "Teacher verified successfully. <a href='admin.php'>Back to Admin Page</a>";
        echo "<script>alert('Teacher verified successfully'); window.location.href='../index.php';</script>";

    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>