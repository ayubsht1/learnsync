<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: login.php");
}

include 'header.php';
require '../connection.php';


// Check if the form was submitted and if 'subject_id' and 'action' are set in the POST data
if (isset($_POST['subject_id']) && isset($_POST['action'])) {
    $sub_id = mysqli_real_escape_string($conn, $_POST['subject_id']);
    $action = $_POST['action'];

    // Perform the action based on the 'action' value
    if ($action === 'update') {
        // Fetch the subject's current data from the database
        $sql = "SELECT id, name, semester FROM subject WHERE id = $sub_id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $semester = $row['semester'];
        
        $headURL = "subject_list.php?semid=" . $semester;

        if ($row) {
            // Check if the update form was submitted
            if (isset($_POST['update'])) {
                $newName = mysqli_real_escape_string($conn, $_POST['name']);
                $newSemester = mysqli_real_escape_string($conn, $_POST['semester']);

                if(empty($newName)){
                    echo '<script>
                    alert("Name required");
                    window.location.href = "'. $headURL. '";
                    </script>';    
                }else{
                // Update the subject's information in the database
                $updateSql = "UPDATE subject SET name = '$newName', semester = '$newSemester' WHERE id = $sub_id";
                if ($conn->query($updateSql) === TRUE) {
                    echo '<script>
                    alert("Update Success");
                    window.location.href = "'. $headURL. '";
                    </script>';
                } else {
                    echo "Error updating subject: " . $conn->error;
                }
            }
            } else {
                // Display the update form
                ?>
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Update Subject</title>
                    <style> 
           .update{
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
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
            width: 98%;
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
        }</style>
                </head>
                <body>  
                <div class="update">                  
                    <h1>Update Subject</h1>
                    <form method="post" action="">
                        <input type="hidden" name="subject_id" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="semid" value="<?php echo $row['semester']; ?>"> <!-- Add this line -->
                        <label for="name">Name:</label>
                        <input type="text" name="name" value="<?php echo $row['name']; ?>"><br>
                        <label for="semester">Semester:</label>
                        <input type="text" name="semester" value="<?php echo $row['semester']; ?>"><br>
                        <button type="submit" name="update">Update Subject</button>
                    </form>
                    </div>                    
                </body>
                </html>
                <?php
            }
        } else {
            echo '<script>
            alert("Subject not found.");
            window.location.href = "subject_list.php?sem=" + $semester;
            </script>';
        }
    } elseif ($action === 'delete' ) {
        $sql = "DELETE FROM subject WHERE id = $sub_id";
        
        $semester = $_POST['sem_id'];
        
        $headURL = "subject_list.php?semid=" . $semester;
        if ($conn->query($sql)) {
            echo '<script>
            alert("Delete Success");
            window.location.href = "'. $headURL. '";
            </script>';
        } else {
            echo "Error deleting subject: " . $conn->error;
        }
    } else {
        echo '<script>
        alert("Invalid action.");
        window.location.href = "'. $headURL. '";
        </script>';
    }
} else {
    echo '<script>
        alert("Invalid request.");
        window.location.href = "'. $headURL. '";
        </script>';
    }
    
    // Close the database connection
    $conn->close();
    ?>

