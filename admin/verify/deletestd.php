<?php
if (isset($_GET['id'])) {
    $studentId = $_GET['id'];

    // Connect to the MySQL database
    require '../../connection.php';

    // Delete student from the database
    $sql = "DELETE FROM student WHERE id = $studentId";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Student deleted successfully'); window.location.href='../stdmgmt.php';</script>";

    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>