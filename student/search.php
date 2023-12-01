<link rel="stylesheet" type="text/css" href="css/notes.css">
<?php
require '../connection.php';
$selectedSubject = $_POST['search'];
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the search term from the form
    $searchTerm = $_POST['search'];

    // Use prepared statements to prevent SQL injection
$sql = "SELECT note.name as note_name, note.file, note.date FROM note
        INNER JOIN subject ON subject.id = note.subId
        WHERE subject.name LIKE ? 
        ORDER BY note.date DESC";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Bind the parameter with a wildcard "%" to search for partial matches
$searchTerm = '%' . $searchTerm . '%';
$stmt->bind_param("s", $searchTerm);

// Execute the statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();

$notes = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $notes[] = [
            'name' => $row['note_name'], // Use 'note_name' alias
            'file' => $row['file'],
            'date' => $row['date'],
        ];
    }
}
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Subject Notes</title>
    
</head>
<body>
    <h1>Search for <?php echo $selectedSubject; ?></h1>
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
                echo "<td><a href='../noteuploads/" . $note['file'] . "' target='_blank' download='$title'>" . basename($note['file']) . "</a></td>";
                
                echo "<td>" . $note['date'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>