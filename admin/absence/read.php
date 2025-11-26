<!-- <?php
include '../config/connect.php';

$query = "SELECT * FROM absence_table_abs";
$result = mysqli_query($connect, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator</title>
</head>
<body>
    <a href="./create.php">Create New User</a>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>No</th>
            <th>User</th>
            <th>Grade</th>
            <th>Major</th>
            <th>Date/Time</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        
        <?php 
        $no = 1;
        while($row = mysqli_fetch_assoc($result)) : 
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['user_id'] ?></td>
            <td><?= $row['kelas'] ?></td>
            <td><?= $row['jurusan'] ?></td>
            <td><?= $row['waktu'] ?></td>
            <td><?= $row['keterangan'] ?></td>

            <td><a href="./update.php?id= <?=$row['id']; ?>">Edit</a></td>
            <td><a href="./delete.php?id= <?=$row['id']; ?>">Delete</a></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html> -->
