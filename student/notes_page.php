<link rel="stylesheet" type="text/css" href="css/notes.css">

<?php
session_start();

require '../connection.php';
// Get the selected subject and semester from the query parameters
$selectedSubject = $_GET['subject'];
$selectedSemester = $_SESSION['semester']; // Assuming you also pass semester as a query parameter

// Retrieve notes for the selected subject and semester
$sql = "SELECT name, file, date FROM note WHERE subId = (
    SELECT id FROM subject WHERE name = '$selectedSubject' AND semester = '$selectedSemester'
) ORDER BY date DESC";
$result = $conn->query($sql);
$notes = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $notes[] = [
            'name' => $row['name'],
            'file' => $row['file'],
            'date' => $row['date'],
        ];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Subject Notes</title>
    
</head>
<body>
<a href="index.php" style="display: inline-block; padding: 10px 20px; background-color: #0074D9; color: #fff; text-decoration: none; border-radius: 5px; text-align: center;">Back</a>
    <h1>Notes for <?php echo $selectedSubject; ?></h1>
    <h2>Semester: <?php echo $selectedSemester; ?></h2>
    <div id="notes">
        <table>
            <tr>
                <th>SN</th>
                <th>Name</th>
                <th>File</th>
                <th>Upload Date</th>
            </tr>
            <?php
            $isOdd = true;
            $sn = 1;
            foreach ($notes as $note) {
                $zebraClass = $isOdd ? 'odd' : 'even';
                $isOdd = !$isOdd;
                $title=$note['name'];
                echo "<tr class='$zebraClass'>";
                echo "<td>" . $sn++ . "</td>";
                echo "<td><a href='../noteuploads/" . $note['file'] . "' target='_blank' download='$title'>" . $note['name'] . "</a></td>";
                // echo "<td>  <button>  <a href='../noteuploads/" . $note['file'] . "' target='_blank' download='$title'> Download </a>  </button>    </td>";
                // echo "<td>   <button> <a href='../noteuploads/" . $note['file'] . "' target='_blank' download='$title'>" . basename($note['file']) . "</a >  </button> </td>";
                echo "<td>   <button> <a href='../noteuploads/" . $note['file'] . "' target='_blank' download='$title'>Download</a >  </button> </td>";
                
                echo "<td>" . $note['date'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>

