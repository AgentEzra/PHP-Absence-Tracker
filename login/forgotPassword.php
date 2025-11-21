<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="./styleLogin.css">
</head>
<body>
    <div class="auth-box" style="position: absolute; top: 40%; left: 50%; transform: translate(-50%, -50%);">
        <form method="post">
            <h1>Forgot Password</h1>

            <div class="auth-part">
                <input type="text" name="email" placeholder="Email" required>
            </div>

            <button type="submit">Send My Password</button>

            <div class="auth-link">
                <p>Already Have An Account? <a href="../index.php">Login</a></p>
                <p>Don't Have An Account? <a href="./registerAccount.php">Register</a></p>
            </div>
        </form>
    </div>
</body>
</html>
