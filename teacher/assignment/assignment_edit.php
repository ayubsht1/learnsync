<?php
require '../../connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    input[type="file"],
    input[type="date"],
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
<?php
if (isset($_POST['edit']))
    {
        $assignmentid=$_POST['assignmentid'];
        $sql="select * from assignment where id='$assignmentid'";
        $r=$conn->query($sql);
        $row=$r->fetch_assoc();
        $assignment_name=$row['name'];
    }
?>

<?php
if (isset($_POST["edit_assignment"])) {
    $assignmentid=$_POST['assignment_id'];
    $title = $_POST["title"];
    $file = $_FILES["file"]["name"];
    $duedate=$_POST["duedate"];
    // Check if a file was uploaded
    if (!empty($_FILES["file"]["name"])) {
        // Upload file to a directory on your server
        $target_dir = "assignmentuploads/";
        $target_file = '../../' . $target_dir . basename($_FILES["file"]["name"]);
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            // File uploaded successfully, proceed to update the database
            // Insert the Assignment into the database
            $sql = "UPDATE assignment SET name='$title', file='$file', duedate='$duedate' where id='$assignmentid'";

            if ($conn->query($sql) === TRUE) {
                echo '<script>
                    alert("Assignment edited successfully");
                    window.location.href = "../assignment.php";
                </script>';
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error uploading file.";
        }
    } else {
        $sql = "UPDATE assignment SET name='$title',duedate='$duedate' where id='$assignmentid'";

        if ($conn->query($sql) === TRUE) {
            echo '<script>
                alert("Assignment edited successfully");
                window.location.href = "../assignment.php";
            </script>';
        } else {
            echo '<script>
                alert("Assignment edited Failed");
                window.location.href = "../assignment.php";
            </script>';
        }
    }
}
?>
<form action="assignment_edit.php" method="post" enctype="multipart/form-data">
<h1>Edit Assignment</h1>
    <label for="title">Title:</label>
    <input type="text" name="title" value="<?php echo $assignment_name; ?>" required><br>
    <input type="date" name="duedate"><br>
    <label for="file">File:</label>
    <input type="file" name="file" accept=".pdf, .doc, .docx"><br>
<input type="hidden" name="assignment_id" value="<?php echo $assignmentid;  ?>" id="">
    <input type="submit" name="edit_assignment" value="Upload">
</form>
</body>
</html>