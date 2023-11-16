<?php
if (isset($_GET['id'])) {
    $teacherId = $_GET['id'];

    // Connect to the MySQL database
    require '../../connection.php';

    // Delete teacher from the database
    $sql = "DELETE FROM teacher WHERE id = $teacherId";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Teacher deleted successfully'); window.location.href='../index.php';</script>";

    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>