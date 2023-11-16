<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
}

include 'header.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
    <style>
/* body{
  background-image:url("../images/photo.jpg");
  background-size: cover;
} */
    .table-container {
        max-width:80%; /* Set the maximum width of the container */
        margin: 0 auto; /* Center the container horizontally */
        padding: 10px; /* Add 10px padding on all sides */
        background-color: #ffffff; /* Background color for the container */
        border: 1px solid #dddddd; /* Add a border around the container */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Add a box shadow for a raised effect */
        border-radius: 5px; /* Add rounded corners */
    }

    /* Style for the table within the container */
    .table-container table {
        width: 100%;
        border-collapse: collapse; /* Collapse table borders */
    }

    .table-container th,
    .table-container td {
        border: 1px solid #dddddd; /* Add borders to table cells */
        padding: 8px; /* Add padding to table cells */
        text-align: left; /* Align text to the left within cells */
    }

    /* Add additional styles to table headers (th) if needed */
    .table-container th {
        background-color: #f2f2f2; /* Background color for header cells */
        font-weight: bold; /* Bold text for header cells */
    }

    /* Style alternate rows with a different background color */
    .table-container tr:nth-child(even) {
        background-color: #f9f9f9; /* Background color for even rows */
    }
</style>
</head>
<body>
    <div class="table-container">
    <h1>Teacher Verification</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Verified</th>
            <th>Action</th>
        </tr>
        <?php
        require '../connection.php';

        // Fetch and display teachers from the database
        $sql = "SELECT * FROM teacher ORDER BY name";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["verify"] . "</td>";
                echo "<td><a href='verify/verify.php?id=" . $row["id"] . "' style='text-decoration: none; color: black; display: inline-block; width: 100%;'><button style='width: 100%;'>Verify</button></a>";
                echo "<br><a href='verify/delete.php?id=" . $row["id"] . "' style='text-decoration: none; color: black; display: inline-block; width: 100%;'><button style='width: 100%;'>Delete</button></a></td>";
                // echo "<br><button style='width:100%'><a href='verify/delete.php?id=" . $row["id"] . "' style='text-decoration: none;color:black; width:100%'>Delete</a></button></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No teachers found</td></tr>";
        }
        
        // Close the database connection
        $conn->close();
        ?>
    </table>
</div>
</body>
</html>
