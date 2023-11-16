<?php
session_start();

$id = $_SESSION['id'];
if (empty($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}

if (isset($_POST["submit"])) {
    $e = $_POST['email'];
    $p = $_POST['password'];
    $a = $_POST['address'];
    $c = $_POST['contact'];

// Check if any of the fields are empty or invalid
$errors = array();
if (empty($c)) {
    array_push($errors, "Contact is required");
}
if(!empty($e)){
    if (!filter_var($e, FILTER_VALIDATE_EMAIL)) {
        array_push($errors,"Invalid email format!");
    }
}
if(!empty($p)){
    if (strlen($p) < 8 || strlen($p) > 24) {
        array_push($errors, "Password must be between 8 and 24 characters");
    }
}
if(empty($a)){
    array_push($errors, "Address Is Required.");
}
if(!empty($c)){
if (strlen($c) !== 10) {
    array_push($errors, "Incorrect Phone Number: Length must be 10");
}
}

if (count($errors) > 0) {
    foreach ($errors as $error) {
        echo "<script>alert('$error');</script>";
    }
    echo "<script>window.location.href = '../profile.php';</script>";
    exit;
}

// Database connection
$conn = new mysqli("localhost", "root", "", "finaldb");
if ($conn->connect_error) {
    die("Connection Error");
}

// Prepare the SQL statement based on the fields to update

if (!empty($e)) {
    $fieldsToUpdate[] = "email = '$e'";
}
if (!empty($p)) {
    $hashedPassword = password_hash($p, PASSWORD_DEFAULT);
    $fieldsToUpdate[] = "password = '$hashedPassword'";
}
if (!empty($a)) {
    $fieldsToUpdate[] = "address = '$a'";
}
if (!empty($c)) {
    $fieldsToUpdate[] = "contact = '$c'";
}

if (!empty($fieldsToUpdate)) {
    // Build the SQL statement based on the fields to update
    $sql = "UPDATE admin SET " . implode(', ', $fieldsToUpdate) . " WHERE id = '$id'";

    // Execute the update statement
    $r = $conn->query($sql);
}


    if ($r) {
        echo '<script>alert("Updated successfully");</script>';
        echo '<script>window.location.href="../profile.php"</script>';
    } else {
        echo '<script>alert("Failed to update profile");</script>';
        echo '<script>window.location.href="../profile.php"</script>';
    }

    // Close the database connection
    $conn->close();
}
?>
