<?php
include './admin/config/connect.php';
include 'session.php';

if (isLoggedIn()) {
    header("Location: dashboard.php");
    exit();
}

$username = '';
$password = '';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query dengan prepared statement
    $query = "SELECT * FROM absence_table_creds WHERE (username = ? OR email = ?) AND password = ? LIMIT 1";
    $stmt = mysqli_prepare($connect, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sss", $username, $username, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            $_SESSION['user_id'] = $row['id']; // Make sure to set user_id
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];

            $success = 'Login Berhasil';
            header('Location: ./dashboard.php');
            exit();
        } else {
            $error = 'Username/Email atau Password salah';
        }

        mysqli_stmt_close($stmt);
    } else {
        $error = 'Terjadi suatu kesalahan pada query';
    }
    exit();
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
    <div class="auth-box">
    <h1>Login</h1>

    <form method="post">
        <div class="auth-part">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" placeholder="Name">
        </div>

        <div class="auth-part">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Password">
            <a href="./login/forgotPassword.php">Forgot your password?</a>
        </div>

        <div class="auth-button">
            <button>Login</button>
        </div>
        
        <div class="auth-link">
            <p>Don't Have An Account?
            <a href="./login/registerAccount.php">Register</a></p>
        </div>
    </form>
    </div>
</body>
</html>