<?php
include '../admin/config/connect.php';
include '../session.php';

if (isLoggedIn()) {
    header("Location: ../index.php");
    exit();
}

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
        $query = "INSERT INTO absence_table_creds (username, email, password, nama, kelas, jurusan, role) 
        VALUES ('$username', '$email', '$password', '$fullName', '$grade', '$major', 'user')";

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
    <title>Register</title>
    <link rel="stylesheet" href="./styleLogin.css">
</head>
<body>
    <form method="post">
        <h1>Register</h1>

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
            <option value="RPL">RPL</option>
            <option value="DKV">DKV</option>
            <option value="AKL">AKL</option>
            <option value="MP">MP</option>
            <option value="BR">BR</option>
        </select>

        <button>Register</button>

        <p>Already Have An Account?
        <a href="../index.php">Login</a></p>
    </form>
</body>
</html>