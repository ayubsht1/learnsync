<?php
session_start();
$sessionid=$_SESSION['id'];
if(!$sessionid)
{
    header("Location: ../logint.php");
}
if (isset($_POST["submit"])) {
    $n = $_POST['name'];
    $p = $_POST['password'];
    $a = $_POST['address'];
    $c = $_POST['contact'];
    $s = $_POST['semid'];
    $conn = new mysqli("localhost", "root", "", "finaldb");
    $id=$_SESSION['id'];
    if ($conn->connect_error) {
        die("Connection Error");
    }

    // Form validation
    $errors = array();
    if (empty($n) || empty($a) || empty($c)|| empty($s)) {
        array_push($errors, "All fields are required");
    }
    if (!$p==NULL){
        if (strlen($p) < 8 || strlen($p) > 24) {
            array_push($errors, "Password must be between 8 and 24 characters");
        }
    }
    if (strlen($c) !== 10) {
        array_push($errors, "Incorrect Phone Number: Length must be 10!");
    }
    if(!is_numeric($c))
    {
        array_push($errors,"Phone number should only contain numbers.");
    }

    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<script>alert('$error');</script>";
        }
        echo "<script>window.location.href = '../profile.php';</script>";
        exit;
    } else {
        // Prepare and execute the SQL statement using prepared statements
    $hashedPassword = password_hash($p, PASSWORD_DEFAULT);
    if(!empty($p)){
    $stmt = $conn->prepare("UPDATE student SET name = ?, password = ?, address = ?, contact = ?, semester=? WHERE id=$id");
    $stmt->bind_param("sssss", $n, $hashedPassword, $a, $c,$s);
    } else{
        $stmt = $conn->prepare("UPDATE student SET name = ?, address = ?, contact = ?, semester=? WHERE id=$id");
        $stmt->bind_param("ssss", $n, $a, $c,$s);
    }

    $r = $stmt->execute();

        if ($r) {
            echo '<script>alert("Updated successfully");</script>';
            $_SESSION['semester']=$s;
            echo '<script>window.location.href="../profile.php"</script>';
        } else {
            echo '<script>alert("Failed to update");</script>';
            echo '<script>window.location.href="../profile.php"</script>';
        }
    }
}

?>