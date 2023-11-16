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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assignment upload</title>
    <style>
        /* Reset some default styles */
        body, ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        /* Styles for the form container */
        .form-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .form-container h1 {
            text-align: center;
        }

        /* Styles for form labels */
        .form-container label {
            display: block;
            margin-bottom: 5px;
        }

        /* Styles for select and input elements */
        .form-container select,
        .form-container input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 16px;
        }

        /* Styles for the submit button */
        .form-container button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 18px;
            border-radius: 3px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Assignment Upload Form</h1>
        <form action="assignment/add_assignment.php" method="post">
            <label for="semester">Select Semester:</label>
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
                echo "<option value='$semid' >$semname</option>";
            }
        }
        ?>
            </select>
            <button type="submit" name='submit'>Submit</button>
        </form>
    </div>
</body>
</html>
