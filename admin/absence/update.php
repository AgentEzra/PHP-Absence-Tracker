<!-- <?php
include '../config/connect.php';

$userID = '';
$kelas = '';
$jurusan = '';
$waktu = '';
$keterangan = '';

$error = '';
$success = '';

$id = $_GET['id'];

$fetchQuery = "SELECT * FROM absence_table_abs WHERE id = '$id'";
$fetchResult = mysqli_query($connect, $fetchQuery);
$data = mysqli_fetch_assoc($fetchResult);

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $userID = $_POST['user'];
    $kelas = $_POST['kelas'];
    $jurusan = $_POST['jurusan'];
    $waktu = date('Y-m-d H:i:s');
    $keterangan = $_POST['keterangan'];

    try {
        $postQuery = "UPDATE absence_table_abs SET 
        user_id = '$userID', kelas = '$kelas', jurusan = '$jurusan', waktu = '$waktu', keterangan = '$keterangan'
        WHERE id = '$id'";

        $postResult = mysqli_query($connect, $postQuery);
        $success = 'Berhasil update data';

        $query = "SELECT * FROM absence_table_abs WHERE id = '$id'";
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
        <label for="user">User</label>
        <input type="text" name="user" value="<?=$data['user_id']; ?>" id="user">

        <label for="kelas">Grade</label>
        <select name="kelas" id="kelas">
            <option value="10" <?=$data['kelas'] == '10' ? 'selected' : '' ?>>10</option>
            <option value="11" <?=$data['kelas'] == '11' ? 'selected' : '' ?>>11</option>
            <option value="12" <?=$data['kelas'] == '12' ? 'selected' : '' ?>>12</option>
        </select>

        <label for="jurusan">Major</label>
        <select name="jurusan" id="jurusan">
            <option value="rpl" <?=$data['jurusan'] == 'RPL' ? 'selected' : '' ?>>RPL</option>
            <option value="dkv" <?=$data['jurusan'] == 'DKV' ? 'selected' : '' ?>>DKV</option>
            <option value="akl" <?=$data['jurusan'] == 'AKL' ? 'selected' : '' ?>>AKL</option>
            <option value="mp" <?=$data['jurusan'] == 'MP' ? 'selected' : '' ?>>MP</option>
            <option value="br" <?=$data['jurusan'] == 'BR' ? 'selected' : '' ?>>BR</option>
        </select>

        <label for="keterangan">Keterangan</label>
        <select name="keterangan" id="keterangan">
            <option value="Hadir">Present</option>
            <option value="Sakit">Sick</option>
            <option value="Izin">Busy</option>
        </select>

        <button>Edit User</button>
    </form>

    <a href="./read.php">Kembali Ke Main?</a>
</body>
</html> -->