<?php
session_start();
require '../connection.php';
include 'header.php';
$sessionid=$_SESSION['id'];
if(!$sessionid)
{
    header("Location: logint.php");
}
$sql = "SELECT * FROM teacher WHERE id = $sessionid";
$r = $conn->query($sql);
    if ($r) {
        // Use mysqli_num_rows to check if any rows were returned
        if ($r->num_rows > 0) {

        // Fetch the row and store id and email values
        $row = $r->fetch_assoc();}
    else echo '<script>alert("User not found");</script>';
} else echo '<script>alert("Connection error");</script>';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Profile Update</title>
    <style>
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        h2 {
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
        input[type="text"],
        input[type="password"] {
            width: 90%;
            padding: 12px 20px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Profile Update</h2>
        <form action="backend/updateprofile.php" method="post" autocomplete="off">
        <label for="username">Full Name:</label>
            <input type="text" id="username" name="name" value="<?php echo isset($row['name']) ? $row['name'] : ''; ?>">

            <label for="password">New Password:</label>
            <input type="password" id="password" name="password">

            <label for="address">Address:</label>
            <input type="text" id="email" name="address" value="<?php echo isset($row['address']) ? $row['address'] : ''; ?>">

            <label for="contact">Contact:</label>
            <input type="text" id="email" name="contact" value="<?php echo isset($row['contact']) ? $row['contact'] : ''; ?>">

            <button type="submit" name="submit">Update Profile</button>
        </form>
    </div>
</body>
</html>
