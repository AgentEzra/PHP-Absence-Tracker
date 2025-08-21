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

$id = $_GET['id'];

$fetchQuery = "SELECT * FROM absence_table_creds WHERE id = '$id'";
$fetchResult = mysqli_query($connect, $fetchQuery);
$data = mysqli_fetch_assoc($fetchResult);

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $fullName = $_POST['fullname'];
    $grade = $_POST['grade'];
    $major = $_POST['major'];

    try {
        $postQuery = "UPDATE absence_table_creds SET username = '$username', email = '$email', password = '$password', 
        nama = '$fullName', kelas = '$grade', jurusan = '$major' WHERE id = '$id'";

        $postResult = mysqli_query($connect, $postQuery);
        $success = 'Berhasil update data';

        $query = "SELECT * FROM absence_table_creds WHERE id = '$id'";
        $result = mysqli_query($connect, $query);
        $data = mysqli_fetch_assoc($result);
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
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?=$data['username'] ?>" placeholder="Nama">

        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="<?=$data['email'] ?>" placeholder="Email">

        <label for="password">Password</label>
        <input type="number" name="password" id="password" value="<?=$data['password'] ?>" placeholder="Password">

        <label for="fullname">Full Name</label>
        <input type="text" name="fullname" id="fullname" value="<?=$data['nama']; ?>" placeholder="fullname">

        <label for="grade">Grade</label>
        <select name="grade" id="grade">
            <option value="10" <?=$data['kelas'] == '10' ? 'selected' : '' ?>>10</option>
            <option value="11" <?=$data['kelas'] == '11' ? 'selected' : '' ?>>11</option>
            <option value="12" <?=$data['kelas'] == '12' ? 'selected' : '' ?>>12</option>
        </select>

        <label for="major">Major</label>
        <select name="major" id="major">
            <option value="rpl" <?=$data['jurusan'] == 'RPL' ? 'selected' : '' ?>>RPL</option>
            <option value="dkv" <?=$data['jurusan'] == 'DKV' ? 'selected' : '' ?>>DKV</option>
            <option value="akl" <?=$data['jurusan'] == 'AKL' ? 'selected' : '' ?>>AKL</option>
            <option value="mp" <?=$data['jurusan'] == 'MP' ? 'selected' : '' ?>>MP</option>
            <option value="br" <?=$data['jurusan'] == 'BR' ? 'selected' : '' ?>>BR</option>
        </select>

        <button>Edit User</button>
    </form>

    <a href="./read.php">Kembali Ke Main?</a>
</body>
</html>