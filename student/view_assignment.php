<link rel="stylesheet" type="text/css" href="css/notes.css">
<?php
session_start();

$stuId = $_SESSION['id']; // Set the student ID

require '../connection.php';

// Check if the user is logged in (you need to implement proper login functionality)
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$sql1="SELECT verify FROM student where id=$stuId";
$res = $conn->query($sql1);
while ($row=mysqli_fetch_assoc($res)){
  $verify = $row["verify"];
  if( $verify === 'no'){
    echo "<script>alert('Your account is not verified');</script>";
    echo "<script>window.location.href = 'index.php';</script>";
    exit;
  }
}

// Get the selected subject and semester from the query parameters
$selectedSubject = $_GET['subject'];
$selectedSemester = $_SESSION['semester']; // Assuming you also pass semester as a query parameter

// Retrieve assignments and associated answers for the selected subject and semester
$sql = "SELECT 
            a.id AS assignmentId, 
            a.name AS assignmentName,
            a.file AS assignmentFile, 
            t.name AS teacherName, 
            ans.verify AS answerVerify,
            ans.id AS answerId,
            ans.name AS answerName,
            ans.file AS answerFile,
            a.subId AS assignmentSubId
        FROM assignment a
        INNER JOIN teacher t ON a.teacherId = t.id
        LEFT JOIN answer ans ON a.id = ans.aId AND ans.stuId = ?
        WHERE a.subId = (
            SELECT id FROM subject WHERE name = ? AND semester = ?
        )";

        $retriveSql = "SELECT * FROM answer WHERE stuId = $stuId";
        $retrive = $conn->query($retriveSql);

$stmt = $conn->prepare($sql);
$stmt->bind_param("iss", $_SESSION['user_id'], $selectedSubject, $selectedSemester);
$stmt->execute();
$result = $stmt->get_result();
$assignments = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $assignments[] = $row;
    }
}




// Upload file part

if (isset($_POST['upload'])) {
    $assignmentId = $_POST['assignmentId'];
    
    // Handle file upload
    $targetDirectory = "../answeruploads/"; // Set the target directory
    $uploadedFile = $_FILES['answerFile']['tmp_name'];
    $fileName = $_FILES['answerFile']['name'];
    
    if (move_uploaded_file($uploadedFile, $targetDirectory . $fileName)) {
        // File uploaded successfully
        // Insert data into the 'answer' table
        $insertSql = "INSERT INTO answer (name, file, aId, subId, stuId) VALUES (?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($insertSql);
        $name = $fileName; // You can set a specific name for the uploaded file if needed
        $file = $fileName;
        $aId = $assignmentId;
        $subId = $assignments[0]['assignmentSubId']; // Use the assignment's subject ID
        
        $stmt->bind_param("sssii", $name, $file, $aId, $subId, $stuId);
if ($stmt->execute()) {
    // Insertion was successful
    echo "<script>alert('File uploaded successfully.');</script>";
    header("Location: view_assignment.php?subject=$selectedSubject"); // Use double quotes to include $selectedSubject
    exit;
} else {
    // Error occurred during database insertion
    echo "Error: " . $conn->error;
}

    } else {
        
    // Error occurred during file upload
    echo "Error: " . $_FILES['answerFile']['error'];
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Assignment Management</title>
</head>
<body>
<a href="assignment.php" style="display: inline-block; padding: 10px 20px; background-color: #0074D9; color: #fff; text-decoration: none; border-radius: 5px; text-align: center;">Back</a>
    <h1>Assignment Management for <?php echo $selectedSubject; ?></h1>
    <h2>Semester: <?php echo $selectedSemester; ?></h2>
    <table>
        <thead>
            <tr>
                <th>SN</th>
                <th>Assignment Name</th>
                <th>Teacher Name</th>
                <th>Answer Name</th>
                <th>Answer Verify Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>            
            <?php
$isOdd = true;
$sn = 1;

// Retrieve all answer data and store it in an associative array
$answersData = [];
if ($retrive->num_rows > 0) {
    while ($rowRetrieved = $retrive->fetch_assoc()) {
        $answersData[$rowRetrieved['aId']] = $rowRetrieved;
    }
}

foreach ($assignments as $assignment) {
    $zebraClass = $isOdd ? 'odd' : 'even';
                $isOdd = !$isOdd;
                echo "<tr class='$zebraClass'>";
    echo "<td>" . $sn++ . "</td>";
    echo "<td><a href='../assignmentuploads/" . $assignment['assignmentFile'] . "' download>" . $assignment['assignmentName'] . "</a></td>";
    echo "<td>" . $assignment['teacherName'] . "</td>";

    // Check if answer data exists for this assignment
    if (isset($answersData[$assignment['assignmentId']])) {
        $answer = $answersData[$assignment['assignmentId']];
        echo "<td><a href='../answeruploads/" . $answer['file'] . "' download>" . $answer['name'] . "</a></td>";
        echo "<td>" . $answer['verify'] . "</td>";
    } else {
        // Display a message if no answer data exists
        echo "<td>No answer submitted</td>";
        echo "<td>N/A</td>";
    }

    echo "<td>";
    echo "<form method='post' enctype='multipart/form-data'>";
    echo "<input type='hidden' name='assignmentId' value='" . $assignment['assignmentId'] . "'>";
?>
    <input type='hidden' name='answerId' value='<?php echo $assignment['answerId']; ?>'>
    <input type='file' name='answerFile'>
    <input type='submit' name='upload' value='Submit Answer'>

    <?php
    echo "</form>";
    echo "</td>";
    echo "</tr>";
}
?>


        </tbody>
    </table>
</body>
</html>
