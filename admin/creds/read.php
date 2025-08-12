<?php
include '../config/connect.php';

$query = "SELECT * FROM absence_table_creds";
$result = mysqli_query($connect, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../styleAdmin.css">
</head>
<body>
    <a href="./create.php">Buat user baru</a>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>USERNAME</th>
            <th>EMAIL</th>
            <th>PASSWORD</th>
            <th>EDIT</th>
            <th>DELETE</th>
        </tr>

        <?php 
        $i = 0;
        while ($data = mysqli_fetch_assoc($result)): $i++;?>
        <tr>
            <td><?=$i; ?></td>
            <td><?=$data['nama']; ?></td>
            <td><?=$data['email']; ?></td>
            <td><?=$data['password']; ?></td>

            <td><a href="./update.php?id= <?=$data['id']; ?>">Edit</a></td>
            <td><a href="./delete.php?id= <?=$data['id']; ?>">Delete</a></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>