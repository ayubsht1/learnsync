<?php
session_start();

if(isset($_SESSION['user'])){
    header("Location: index.php");
    exit;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require '../connection.php';

    // Get user input from the form
    $email = $_POST["email"];
    $enteredPassword = $_POST["password"];
    
    $sql = "SELECT * FROM admin WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $rowcount = mysqli_num_rows($result);
    if ($rowcount > 0) {
        $row = mysqli_fetch_assoc($result); // Fetch the user data
        if (password_verify($enteredPassword, $row['password'])) {
            $_SESSION['user'] = $email;
            $_SESSION['id'] = $row['id'];
            header("Location: index.php");
            exit();
        } else {
            echo '<script>alert("Invalid password");</script>';
            echo '<script>window.location.href="login.php"</script>';
            exit;
        }
    } else {
        echo '<script>alert("Invalid email");</script>';
        echo '<script>window.location.href="../logins.php"</script>';
        exit;
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="css/login.css" rel="stylesheet">
</head>
<body>
<div class='login-form'>
<form action="login.php" method="post" autocomplete="off">
  <h2>Sign In <br>Admin </h2>
  <div class="input1">
    <span class="icon"><i class='bx bxs-envelope'></i></span>
    <input type="email" placeholder="Enter your email" name="email" id="email" required>
    <label>Email</label>
  </div>
  <div class="input1">
    <span class="icon"><i class='bx bxs-lock'></i></span>
    <input type="password" placeholder="Enter your password" name="password" id="password" required>
    <label>Password</label>
  </div>
  <br>
  <button type="submit" class="btn" name="submit" value="Login">Sign In</button>
  </form>
</div>
</form>
</body>
</html>