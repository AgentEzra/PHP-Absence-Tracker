<!-- <?php
include '../config/connect.php';

$userID = '';
$kelas = '';
$jurusan = '';
$waktu = '';
$keterangan = '';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $userID = $_POST['userid'];
    $kelas = $_POST['kelas'];
    $jurusan = $_POST['jurusan']; 
    $waktu = date('Y-m-d H:i:s');
    $keterangan = $_POST['keterangan'];

    try {
        $query = "INSERT INTO absence_table_abs (user_id, kelas, jurusan, waktu, keterangan) 
        VALUES ('$userID', '$kelas', '$jurusan', '$waktu', '$keterangan')";

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
        <input type="text" name="userid" id="userid" placeholder="User">

        <label for="kelas">Grade</label>
        <select name="kelas" id="kelas">
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
        </select>

        <label for="jurusan">Major</label>
        <select name="jurusan" id="jurusan">
            <option value="rpl">RPL</option>
            <option value="dkv">DKV</option>
            <option value="akl">AKL</option>
            <option value="mp">MP</option>
            <option value="br">BR</option>
        </select>

        <label for="keterangan">Status</label>
        <select name="keterangan" id="keterangan">
            <option value="Hadir">Present</option>
            <option value="Sakit">Sick</option>
            <option value="Izin">Busy</option>
        </select>

        <button>Add Absence</button>
    </form>

    <a href="./read.php">Back To Main?</a>
</body>
</html> -->