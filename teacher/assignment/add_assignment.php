<?php
require '../../connection.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>Add Assignment</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    h2 {
        text-align: center;
        margin-top: 20px;
    }

    form {
        max-width: 400px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    label {
        font-weight: bold;
    }

    input[type="text"],
    input[type="date"],
    input[type="file"],
    select {
        width: 95%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 3px;
        font-size: 16px;
    }

    input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 3px;
        font-size: 18px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }
</style>
</head>
<body>
<a href="../assignment.php">back to home</a>
    <h2>Add Assignment</h2>
    <form action="upload_assignment.php" method="post" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" name="title" required><br>
        <label for="file">File:</label>
        <input type="file" name="file" accept=".pdf, .doc, .docx" required><br>
        <label for="subject">Subject:</label>
        <select name="subject" name='sub' required>
            <?php
           if(isset($_POST['submit']))
           {
               $semid=$_POST['semid'];
               echo $semid;
               $sql = "SELECT * FROM subject where semester = $semid";
               $result = $conn->query($sql);
               while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['id']}'>{$row['name']}</option>";
            }
              
           }
                // Assuming you have a database connection here-
               
            ?>
        </select><br>
        <label for="subject">Duedate:</label>
        <input type="date" name="duedate">
        <br>
        <input type="submit" value="Upload">
    </form>
</body>
</html>
