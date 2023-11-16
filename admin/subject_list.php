<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: login.php");
}
include 'header.php';
require '../connection.php';

$semester = "";
// Fetch data from the subjects table
if (isset($_POST['semid'])) {
    $semester = $_POST['semid'];
} elseif (isset($_GET['semid'])) {
    $semester = $_GET['semid'];
}

        $sql = "SELECT id, name, semester FROM subject WHERE semester = '$semester'";
        $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Subjects Table</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        th {
            background-color: #333;
            color: white;
        }

        .action-buttons {
            display: flex;
            justify-content: space-around;
        }

        .table-buttons {
            margin: 10px;
            display: flex;
            justify-content: center;
        }

        .button {
    display: inline-block;
    width: auto;
    padding: 10px 20px;
    background-color: #007BFF;
    color: #fff;
    text-decoration: none;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-align: center;
    margin-right: 10px;
    margin-bottom: 5px; /* Add margin to the bottom for spacing */
}

.button:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>
    <div class="table-buttons">
        <a href="index.php" class="button">Back</a>
        <a href="add_sub.php?semid=<?php echo $semester; ?>" class="button">Add Subjects</a>
    </div>
    <table>
        <tr>
            <th>SN</th>
            <th>Name</th>
            <th>Semester</th>
            <th width="15%">Action</th>
        </tr>
        <?php


        
        if ($result->num_rows > 0) {
            $i = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $i . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["semester"] . "</td>";
                echo '<td class="action-buttons">';
                echo '<form method="post" action="update_delete.php">';
                echo '<input type="hidden" name="subject_id" value="' . $row["id"] . '">';
                echo '<input type="hidden" name="sem_id" value="' . $row['semester'] . '">';
                echo '<button type="submit" name="action" value="update">Update</button>';
                echo '&nbsp;'; // Add a non-breaking space
                echo '<button type="submit" name="action" value="delete">Delete</button>';
                echo '</form>';
                echo '</td>';
                echo "</tr>";
                $i++;
            }
        } else {
            echo "<tr><td colspan='5'>No subjects found</td></tr>";
        }

        // Close the database connection
        $conn->close();
        ?>

    </table>
</body>
</html>
