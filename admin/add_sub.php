<?php

session_start();
if(!isset($_SESSION['user'])){
    header("Location: login.php");
}
require '../connection.php';

// Initialize variables
$name = '';
$semester = '';


// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $semester = mysqli_real_escape_string($conn, $_POST['semester']);
    
    $headURL = "subject_list.php?semid=" . $semester;

    if(empty($name)){
        echo '<script>
        alert("Name required");
        window.location.href = "'. $headURL. '";
        </script>';    
    }else{
    // Insert the subject into the database
    $sql = "INSERT INTO subject (name, semester) VALUES ('$name', '$semester')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to a success page
        echo '<script>
        alert("Added Successfully");
        window.location.href = "'. $headURL. '";
        </script>';
    } else {
        echo '<script>
        alert("Failed Error adding subject: ' . $conn->error . '");
        window.location.href = "' . $headURL . '";
        </script>';
    }
}
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Subject</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            background-color: #007BFF;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        .form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        label {
            display: block;
            margin: 10px 0;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin: 5px 0;
        }

        button {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            margin: 10px 10px 0px 0px;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <br>
    <h1>Add Subject</h1>
    <div class="form">
        <form method="post" action="">
            <input type="hidden" name="semester" value="<?php echo $_GET['semid']; ?>">
            <label for="name">Subject Name:</label>
            <input type="text" name="name" >
            <button type="submit">Add Subject</button>
        </form>
        <a href="subject_list.php?semid=<?php echo $_GET['semid']; ?>" class="button">Back</a>
    </div>
</body>
</html>

