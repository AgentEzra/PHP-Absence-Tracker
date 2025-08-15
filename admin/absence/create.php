<?php
include '../config/connect.php';

$userID = '';
$waktu = '';
$keterangan = '';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $userID = $_POST['userid'];
    $waktu = date('Y-m-d H:i:s');
    $keterangan = $_POST['keterangan'];

    try {
        $id = $_GET['id'];
        $queryGet = "SELECT * FROM absence_table_creds WHERE id = '$id'";
        $resultGet = mysqli_query($connect, $queryGet);
        $dataGet = mysqli_fetch_assoc($resultGet);

        $query = "INSERT INTO absence_table_abs (nama, email, password) VALUES ('$username', '$email', '$password')";
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
        <label for="userid">Name</label>
        <input type="text" name="userid" id="userid" placeholder="User ID">

        <select name="keterangan" id="keterangan">
            <option value="Hadir">Present</option>
            <option value="Sakit">Sick</option>
            <option value="Izin">Busy</option>
        </select>

        <button>Add Absence</button>
    </form>

    <a href="./read.php">Back To Main?</a>
</body>
</html>