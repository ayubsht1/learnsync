<?php
session_start();
include 'header.php';
if(!$_SESSION['user'])
{
    header("Location: login.php");
}

require '../connection.php';
$id=$_SESSION['id'];


$sql = "SELECT * FROM admin WHERE id = '$id'";

// Execute the update statement
$r = $conn->query($sql);
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
        input[type="email"],
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
            <?php
                if($r->num_rows > 0)
                while($row = $r->fetch_assoc()){
            ?>

            <label for="username">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>">

            <label for="password">New Password:</label>
            <input type="password" id="password" name="password">

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?php echo $row['address']; ?>">

            <label for="contact">Contact:</label>
            <input type="text" id="contact" name="contact" value="<?php echo $row['contact']; ?>">

            <button type="submit" name="submit">Update Profile</button>
            <?php
                }
            ?>

        </form>
    </div>
</body>
</html>
