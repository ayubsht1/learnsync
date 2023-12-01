<?php
if (isset($_POST["submit"])) {
    $n = $_POST['name'];
    $e = $_POST['email'];
    $p = $_POST['password'];
    $a = $_POST['address'];
    $c = $_POST['contact'];
    $s = $_POST['semester'];
    $gen = $_POST['gen'];
    $conn = new mysqli("localhost", "root", "", "finaldb");
    if ($conn->connect_error) {
        die("Connection Error");
    }

    // Form validation
    $errors = array();
    if (empty($n) || empty($e) || empty($p) || empty($a) || empty($c)) {
        array_push($errors, "All fields are required");
    }
    if (!empty($e) && !filter_var($e, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email not valid");
    }
    if (strlen($p) < 8 || strlen($p) > 24) {
        array_push($errors, "Password must be between 8 and 24 characters");
    }
    if (strlen($c) !== 10) {
        array_push($errors, "Incorrect Phone Number: Length must be 10!");
    }
    if(!is_numeric($c))
    {
        array_push($errors,"Phone number should only contain numbers.");
    }

     // Uniqye Key Validation 
     $sql_check_mail = "SELECT * FROM student WHERE email = '$e'";
     $result_check_mail = $conn->query($sql_check_mail);
     if ($result_check_mail->num_rows > 0){
         $errors[] = "Email Already Registered";
     }
    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<script>alert('$error');</script>";
        }
        echo "<script>window.location.href = '../regs.php';</script>";
        exit;
    } 
else {
if (empty($errors)) {

    // Prepare and execute the SQL query
    $sql = "INSERT INTO student (name, email, password, address, contact, semester, gender) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        // $errors[] = "Error in database connection.";
        echo "<script>alert('Error in database connection.');</script>";
    } else {
        // Sanitize user inputs
        $n = mysqli_real_escape_string($conn, $n);
        $e = mysqli_real_escape_string($conn, $e);
        $p = mysqli_real_escape_string($conn, $p);
        $a = mysqli_real_escape_string($conn, $a);
        $c = mysqli_real_escape_string($conn, $c);
        $s = mysqli_real_escape_string($conn, $s);
        $gen = mysqli_real_escape_string($conn, $gen);

        // Hashing password
        $hashedPassword = password_hash($p, PASSWORD_DEFAULT);

        // Bind parameters and execute
        $stmt->bind_param("sssssss", $n, $e, $hashedPassword, $a, $c, $s, $gen );
        if ($stmt->execute()) {
            echo '<script>alert("Signed up successfully");</script>';
            echo '<script>window.location.href="../logins.php"</script>';
            exit;
        } else {
            echo "<script>alert('An error occurred while processing your request. Please try again later.');</script>";

        }
    }
}
}
}
?>