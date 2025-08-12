<?php
include '../config/connect.php';

$username = '';
$email = '';
$password = '';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $query = "INSERT INTO absence_table_creds (nama, email, password) VALUES ('$username', '$email', '$password')";
        $result = mysqli_query($connect, $query);

        $success = 'Berhasil Login';
    }
    catch (mysqli_sql_exception $e){
        if (str_contains($e->getMessage(), 'Duplicate entry')) {
                $error = 'Username atau Email sudah digunakan.';
            } else {
                $error = 'Error: ' . $e->getMessage();
        }
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
        <input type="text" name="username" id="username" placeholder="Nama">

        <label for="email">Email</label>
        <input type="text" name="email" id="email" placeholder="Email">

        <label for="password">Password</label>
        <input type="number" name="password" id="password" placeholder="Password">

        <button>Create User</button>
    </form>

    <a href="./read.php">Kembali Ke Main?</a>
</body>
</html>