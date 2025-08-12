<?php
include '../config/connect.php';

$username = '';
$email = '';
$password = '';

$error = '';
$success = '';

$id = $_GET['id'];

$fetchQuery = "SELECT * FROM absence_table_creds WHERE id = '$id'";
$fetchResult = mysqli_query($connect, $fetchQuery);
$data = mysqli_fetch_assoc($fetchResult);

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $postQuery = "UPDATE absence_table_creds SET nama = '$username', email = '$email', password = '$password' WHERE id = '$id'";
        $postResult = mysqli_query($connect, $postQuery);
        $success = 'Berhasil update data';
    }
    catch (mysqli_sql_exception $e){
        $error = 'Terjadi suatu kesalahan';
    }
}


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
    <h1>Administrator</h1>

    <form method="post">
        <label for="username">Nama</label>
        <input type="text" name="username" id="username" value="<?=$data['nama'] ?>" placeholder="Nama">

        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="<?=$data['email'] ?>" placeholder="Email">

        <label for="password">Password</label>
        <input type="number" name="password" id="password" value="<?=$data['password'] ?>" placeholder="Password">

        <button>Edit User</button>
    </form>

    <a href="./read.php">Kembali Ke Main?</a>
</body>
</html>