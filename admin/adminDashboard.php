<?php
// function redirectIfNotAdmin() {
//     if (!isAdmin()) {
//         header("Location: ../pages/404.php");
//         exit();
//     }
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Dashboard</title>
    <link rel="stylesheet" href="./styleAdmin.css">
</head>
<body>
    <div class="container">
        <div class="card-box">
            <h2>Manage Credential Database</h2>
            <p>Manage user credentials and access permissions</p>
            <a href="./creds/read.php">Go To Credential Database</a>
        </div>

        <div class="card-box">
            <h2>Manage Absence Database</h2>
            <p>Manage and view attendance record</p>
            <a href="./absence/read.php">Go To Absence Database</a>
        </div>
    </div>
</body>
</html>