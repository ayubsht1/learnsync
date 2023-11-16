<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="header.css">


</head>
<body>
    <header>
        <div class="logo">
        <h3>LearnSync</h3>
        </div>
        <div class="search">
        <form action="search.php" method="POST">
        <input type="text" placeholder="Search Notes.." name="search">
        <button type="submit">Search</button>
        </form>
        </div>
        <div class="navigation">
            <ul>
            <li><a href="index.php">My Notes</a></li>
                <li><a href="assignment.php">MY Assignments</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="backend/logoutmodule.php">Logout</a></li>
            </ul>
        </div>
    </header>
</body>
</html>
