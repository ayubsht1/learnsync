<?php
if (isset($_GET['id'])) {
    $studentId = $_GET['id'];

    // Connect to the MySQL database
    require '../../connection.php';

    // Update the student's verification status in the database
    $sql = "UPDATE student SET verify = 'yes' WHERE id = $studentId";

    if ($conn->query($sql) === TRUE) {
        // echo "student verified successfully. <a href='admin.php'>Back to Admin Page</a>";
        echo "<script>alert('Student verified successfully'); window.location.href='../stdmgmt.php';</script>";

    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>