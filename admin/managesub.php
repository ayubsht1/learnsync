<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: login.php");
}
include 'header.php';
require '../connection.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Select Semester</title>
    <style>
        /* Reset some default styles */
body, ul {
    margin: 0;
    padding: 0;
    list-style: none;
}

/* Semester selection page styles */
.semester-container {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: rgba(0, 0, 0, 0.4);
}

.semester-content {
    background-color: #fff;
    width: 300px;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    text-align: center;
}

.semester-content h1 {
    color: #333;
}

.semester-content label {
    font-weight: bold;
    display: block;
    margin-top: 10px;
}

.semester-content select, .semester-content input[type="submit"] {
    width: 100%;
    padding: 10px;
    margin-top: 10px;
}

.semester-content input[type="submit"] {
    background-color: #007BFF;
    color: #fff;
    border: none;
    cursor: pointer;
    border-radius: 5px;

}
.button {
            display: block;
            width: auto;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="semester-container">
    <div class="semester-content">
    <h1>Select a Semester</h1>
    <form action="subject_list.php" method="POST">
    <label for="semid">Choose Semester:</label>
    <select name="semid" id="semester">
        <?php
        $sql =" SELECT * FROM semester
        ORDER BY semID ASC";
        
        $result = $conn->query($sql);

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $semid = $row['semID'];
                $semname = $row['sem_name'];
                echo "<option value='$semid'>$semname</option>";
            }
        }
        ?>
    </select>
    <input type="submit" name="sem" value="Submit">
</form>
    <br>
    <a href="index.php" class="button">Back</a>
    </div>
</div>

</body>
</html>
<!-- <form action="process_semester.php" method="POST">
                <label for="semester">Choose a semester:</label>
                <select name="semester" id="semester">
                    <option value="1">Semester 1</option>
                    <option value="2">Semester 2</option>
                    <option value="3">Semester 3</option>
                    <option value="3">Semester 4</option>
                    <option value="3">Semester 5</option>
                    <option value="3">Semester 6</option>
                    <option value="3">Semester 7</option>
                    <option value="3">Semester 8</option>
                </select>
                <input type="submit" value="Submit">
                </form> -->