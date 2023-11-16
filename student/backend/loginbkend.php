<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['email'])) {
    // Redirect the user to the home page or any other authenticated page
    header("Location: ../index.php");
    exit;
}

if(isset($_POST['submit'])) {
    // Get the username and password from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

        $conn = new mysqli("localhost", "root", "", "finaldb");
        if ($conn->connect_error) {
            die("Connection Error");
        }
        // Note the corrected SQL query with properly concatenated strings
        $sql = "SELECT * FROM student WHERE email='$email' ";
        $r = $conn->query($sql);
        if ($r) {
            // Use mysqli_num_rows to check if any rows were returned
            if ($r->num_rows > 0) {

            // Fetch the row and store id and email values
            $row = $r->fetch_assoc();
            $id = $row['id'];
            $email = $row['email'];
            $semester = $row['semester'];
             if(password_verify($password,$row['password']))
             {
            // Store the id and email in session variables
             $_SESSION['id'] = $id;
             $_SESSION['email'] = $email;
             $_SESSION['semester'] = $semester;
             // Redirect the user to the home page
             header("Location: ../index.php");
                exit;
             }
             else {
                echo '<script>alert("Invalid password");</script>';
                echo '<script>window.location.href="../logins.php"</script>';
                exit;
            }
            } 
            else {
                echo '<script>alert("Invalid email");</script>';
                echo '<script>window.location.href="../logins.php"</script>';
                exit;
            }
        } else {
            echo "Error: ";
        }
}
?>