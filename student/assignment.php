<link rel="stylesheet" type="text/css" href="css/notes.css">

<?php
include 'header.php';
session_start();

// Assuming you have a database connection established
require '../connection.php';

// Assuming you have a session with student's semester
$semester = $_SESSION['semester'];

// Retrieve subjects for the student's semester
$sql = "SELECT name FROM subject WHERE semester = '$semester'";
$result = $conn->query($sql);

$subjects = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $subjects[] = $row['name'];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Subject Selection</title>
</head>
<body>
    <h1>Select Subject For Assignment</h1>
    <div class="navbar">
        <?php
        foreach ($subjects as $subject) {
            echo "<a href='view_assignment.php?subject=$subject'>$subject</a>";
        }
        ?>
    </div>
</body>
</html>

