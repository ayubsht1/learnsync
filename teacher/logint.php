<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['email'])) {
  
    // Redirect the user to the home page or any other authenticated page
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="css/login.css" rel="stylesheet">
</head>
<body>
<div class='login-form'>
<form action="backend/loginbkendt.php" method="post" autocomplete="off">
  <h2>Sign In</h2>
  <div class="input1">
    <span class="icon"><i class='bx bxs-envelope'></i></span>
    <input type="email" placeholder="Enter your email" name="email">
    <label>Email</label>
  </div>
  <div class="input1">
    <span class="icon"><i class='bx bxs-lock'></i></span>
    <input type="password" placeholder="Enter your password" name="password">
    <label>Password</label>
  </div>
  <br>
  <button type="submit" class="btn" name="submit">Sign In</button>
  <div>
  <p>Don't have an account? <a href="regt.php" class="signup">Sign up</a></p>
  <p><a href="../index.php" class="signup">Login as Student</a></p>
  </div>
  </form>
</div>
</form>
</body>
</html>