<?php
include '../admin/config/connect.php';
include '../session.php';

redirectIfNotLoggedIn();

//function for prevent if on value option
function isSelected($sessionValue, $optionValue) {
    return ($sessionValue == $optionValue) ? 'selected' : '';
}

$error = '';
$success = '';

$credsId = '';
$grade = ''; 
$major = '';
$waktu = '';
$status = '';

$credsId = $_SESSION['credsId'];

$sqlProfile = "SELECT profImage FROM user_profile WHERE credsId = '$credsId'";
$resultProfile = mysqli_query($connect, $sqlProfile);
$resultProfileData = mysqli_fetch_assoc($resultProfile);

$profile = !empty($resultProfileData['profImage']) ? "../image/" .  $resultProfileData['profImage'] : "../image/default.webp";

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $credsId = $_SESSION['credsId'];
    $grade = $_POST['kelas'];
    $major = $_POST['jurusan'];
    $waktu = date('Y-m-d H:i:s');
    $status = $_POST['keterangan'];
    try {
    
        $query = "INSERT INTO absence_table_abs (credsId, kelas, jurusan, waktu, keterangan) 
        VALUES ('$credsId', '$grade', '$major', '$waktu', '$status')";
    
        $result = mysqli_query($connect, $query);
        $success = "Absensi berhasil";
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
                        <img src="<?=$profile ?>" alt="Profile" class="profile-img"> <?=$_SESSION['username']; ?>
                    </div>
                    <ul class="dropdown-menu" id="dropdownMenu">
                        <li><a class="dropdown-item" href="./profile.php">Profile</a></li>
                        <li><a class="dropdown-item" href="../login/forgotPassword.php">Change Password</a></li>
                        <li><div class="dropdown-divider"></div></li>
                        <li><a class="dropdown-item text-danger" href="../admin/config/logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <div class="box-absence">
        <h1>Request Absence</h1> 

        <?php if(!empty($success)): ?>
        <div class="error-success-abs">
            <?=$success ?>
        </div>
        <?php endif; ?>

        <?php if(!empty($error)): ?>
        <div class="error-success-abs">
            <?=$error ?>
        </div>
        <?php endif; ?>
        
            <form method="post"> 
                <div class="option-part">
                    <label for="kelas">Grade</label>
                    <select name="kelas" id="kelas">
                      <option value="10" <?= isSelected($_SESSION['kelas'], '10') ?>>10</option>
                      <option value="11" <?= isSelected($_SESSION['kelas'], '11') ?>>11</option>
                      <option value="12" <?= isSelected($_SESSION['kelas'], '12') ?>>12</option>
                    </select>
                </div>

                <div class="option-part">
                    <!-- Make sure jurusan value in db was capital -Ezra -->
                    <label for="jurusan">Major</label> 
                    <select name="jurusan" id="jurusan">
                      <option value="RPL" <?= isSelected($_SESSION['jurusan'], 'RPL') ?>>RPL</option> 
                      <option value="DKV" <?= isSelected($_SESSION['jurusan'], 'DKV') ?>>DKV</option>
                      <option value="AKL" <?= isSelected($_SESSION['jurusan'], 'AKL') ?>>AKL</option>
                      <option value="MP" <?= isSelected($_SESSION['jurusan'], 'MP') ?>>MP</option>
                      <option value="BR" <?= isSelected($_SESSION['jurusan'], 'BR') ?>>BR</option>
                    </select>
                </div>
        
                <div class="option-part">
                    <label for="keterangan">Status</label>
                    <select name="keterangan" id="keterangan">
                      <option value="present">Present</option> 
                      <option value="sick">Sick</option>
                      <option value="busy">Busy</option>
                    </select>
                </div>
        
                <div class="auth-button">
                    <button>Add Absence</button>
                </div>
            </form>
    </div>
</div>

    <!-- Custom JavaScript for dropdown and mobile menu -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle mobile menu
            const navbarToggle = document.getElementById('navbarToggle');
            const navbarCollapse = document.getElementById('navbarCollapse');
            
            if (navbarToggle && navbarCollapse) {
                navbarToggle.addEventListener('click', function() {
                    navbarCollapse.classList.toggle('show');
                });
            }
            
            // Toggle profile dropdown
            const profileDropdown = document.getElementById('profileDropdown');
            const dropdownMenu = document.getElementById('dropdownMenu');
            
            if (profileDropdown && dropdownMenu) {
                profileDropdown.addEventListener('click', function(e) {
                    e.stopPropagation();
                    dropdownMenu.classList.toggle('show');
                });
                
                // Close dropdown when clicking elsewhere
                document.addEventListener('click', function() {
                    dropdownMenu.classList.remove('show');
                });
            }
        });
    </script>
</body>
</html>