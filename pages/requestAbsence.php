<?php
include '../admin/config/connect.php';
include '../session.php';

redirectIfNotLoggedIn();

//function for prevent if on value option
function isSelected($sessionValue, $optionValue) {
    return ($sessionValue == $optionValue) ? 'selected' : '';
}

// $query = "INSERT INTO absence_tracker_abs (something) VALUES ('some', 'thing')";
// $result = mysqli_query($connect, $query);

$name = '';
$username = $_SESSION['username'];
$grade = ''; 
$major = '';
$status = '';
$waktu = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
  $name = $_POST[''];
  $grade = $_POST[''];
  $major = $_POST[''];
  $status = $_POST[''];
  $waktu = date('Y-m-d H:i:s');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" href="../styleDashboard.css">
</head>
<body>
  <nav class="navbar">
    <div class="navbar-container">
        <a class="navbar-brand" href="../index.php">Absence Tracker</a>
        
        <button class="navbar-toggle" id="navbarToggle">
            ☰
        </button>
        
        <div class="navbar-collapse" id="navbarCollapse">
            <!-- Main navigation items on the left -->
            <ul class="navbar-nav navbar-nav-main">
                <li class="nav-item">
                    <a class="nav-link" href="../dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./viewAttendance.php">My Attendance</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./requestAbsence.php">Request Absence</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./myReports.php">My Reports</a>
                </li>
            </ul>
            
            <!-- Profile on the right -->
            <ul class="navbar-nav navbar-nav-profile">
                <li class="nav-item profile-dropdown">
                    <div class="dropdown-toggle" id="profileDropdown">
                        <img src="./image/dias.jpg" alt="Profile" class="profile-img"> <?=$_SESSION['username']; ?>
                    </div>
                    <ul class="dropdown-menu" id="dropdownMenu">
                        <li><a class="dropdown-item" href="./pages/profile.php">Profile</a></li>
                        <li><a class="dropdown-item" href="./login/forgotPassword.php">Change Password</a></li>
                        <li><div class="dropdown-divider"></div></li>
                        <li><a class="dropdown-item text-danger" href="./admin/config/logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<h1>Request Absence</h1>
<h1><?=$_SESSION['kelas'] ?></h1>
<h1><?=$_SESSION['jurusan'] ?></h1> 

    <form method="post"> 
        <label for="kelas">Grade</label>
        <select name="kelas" id="kelas">
          <option value="10" <?= isSelected($_SESSION['kelas'], '10') ?>>10</option>
          <option value="11" <?= isSelected($_SESSION['kelas'], '11') ?>>11</option>
          <option value="12" <?= isSelected($_SESSION['kelas'], '12') ?>>12</option>
        </select>

        <!-- Make sure jurusan value in db was capital -Ezra -->
        <label for="jurusan">Major</label> 
        <select name="jurusan" id="jurusan">
          <option value="rpl" <?= isSelected($_SESSION['jurusan'], 'RPL') ?>>RPL</option> 
          <option value="dkv" <?= isSelected($_SESSION['jurusan'], 'DKV') ?>>DKV</option>
          <option value="akl" <?= isSelected($_SESSION['jurusan'], 'AKL') ?>>AKL</option>
          <option value="mp" <?= isSelected($_SESSION['jurusan'], 'MP') ?>>MP</option>
          <option value="br" <?= isSelected($_SESSION['jurusan'], 'BR') ?>>BR</option>
        </select>

        <label for="keterangan">Status</label>
        <select name="keterangan" id="keterangan">
          <option value="Hadir">Present</option> 
          <option value="Sakit">Sick</option>
          <option value="Izin">Busy</option>
        </select>

        <button>Add Absence</button>
    </form>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>