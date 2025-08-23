<?php
include './admin/config/connect.php';

$username = '';
$password = '';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $query = "SELECT * FROM absence_table_creds WHERE (username = ? OR email = ?) AND password = ?";
        $result = mysqli_prepare($connect, $query);

        $success = 'Login Berhasil';

        header('location: ./dashboard.php');
        exit();
    }
    catch (mysqli_error){
        $error = 'Terjadi suatu kesalahan';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="./login/styleLogin.css">
</head>
<body>
    <h1>Login</h1>

    <form method="post">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" placeholder="Name">

        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Password">

        <a href="./login/forgotPassword.php">Forgot your password?</a>

        <button>Login</button>
        
        <p>Don't Have An Account?
        <a href="./login/registerAccount.php">Register</a></p>
    </form>
</body>
</html>