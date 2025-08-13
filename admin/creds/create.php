<?php
include '../config/connect.php';

$username = '';
$email = '';
$password = '';
$nama = '';
$kelas = '';
$jurusan = '';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $fullName = $_POST['fullname'];
    $grade = $_POST['grade'];
    $major = $_POST['major'];

    try {
        $query = "INSERT INTO absence_table_creds (username, email, password, nama, kelas, jurusan) 
        VALUES ('$username', '$email', '$password', '$fullName', '$grade', '$major')";

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
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Username">

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Email">

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Password">

        <label for="fullname">Full Name</label>
        <input type="text" name="fullname" id="fullname" placeholder="fullname">

        <label for="grade">Grade</label>
        <select name="grade" id="grade">
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
        </select>

        <label for="major">Major</label>
        <select name="major" id="major">
            <option value="rpl">RPL</option>
            <option value="dkv">DKV</option>
            <option value="akl">AKL</option>
            <option value="mp">MP</option>
            <option value="br">BR</option>
        </select>

        <button>Register</button>
    </form>

    <a href="./read.php">Kembali Ke Main?</a>
</body>
</html>