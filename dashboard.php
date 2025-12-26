<?php
include './admin/config/connect.php';
include 'session.php';

redirectIfNotLoggedIn();

$waktu = date('Y-m-d');
$credsId = $_SESSION['credsId'];

$sql = "SELECT profImage FROM user_profile WHERE credsId = ?";
$stmt = $connect->prepare($sql);
$stmt->bind_param("i", $credsId);
$stmt->execute();

$result = $stmt->get_result();

$results = [];
while ($row = $result->fetch_assoc()) {
    $results[] = $row;
}

$resultData = $results[0] ?? [];

//check profile is empty or no
$profile = !empty($resultData['profImage']) ? "./image/" . $resultData['profImage'] : "./image/default.webp";

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" href="styleDashboard.css">
    <style>
        
    </style>
</head>
<body>
<nav class="navbar">
    <div class="navbar-container">
        <a class="navbar-brand" href="index.php">Absence Tracker</a>
        
        <button class="navbar-toggle" id="navbarToggle">
            ☰
        </button>
        
        <div class="navbar-collapse" id="navbarCollapse">
            <!-- Main navigation items on the left -->
            <ul class="navbar-nav navbar-nav-main">
                <li class="nav-item">
                    <a class="nav-link" href="./dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./pages/viewAttendance.php">My Attendance</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./pages/requestAbsence.php">Request Absence</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./pages/myReports.php">My Reports</a>
                </li>
            </ul>
            
            <!-- Profile on the right -->
            <ul class="navbar-nav navbar-nav-profile">
                <li class="nav-item profile-dropdown">
                    <div class="dropdown-toggle" id="profileDropdown">
                        <img src="<?=$profile ?>" alt="Profile" class="profile-img"> <?=$_SESSION['username']; ?>
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

<div class="dashboard-container">
    <div class="dashboard-part">
        <img src="<?=$profile ?>" alt="Profile" style="max-width: 100px; max-height:100px; border-radius:100px;">
        <h3>Hello <?=$_SESSION['username'] . "!"?></h3>
        <p><?=$waktu; ?></p>
    </div>

    <div class="dashboard-notif">
        <h3>You have absenced today, have a nice day!</h3>
        <h3>You haven'th absence today, <a href="./pages/requestAbsence.php">Click here to absence</a></h3>
    </div>

    <div class="dashboard-chart">
        <h3>dev cant make chart yet :D</h3>
    </div>

    <div class="dashboard-help">
        <h3>Having a problem? <a href="#">let us know</a></h3>
    </div>

    <div class="dashboard-footer">
            <p>Attendance System © <?php echo date('Y'); ?>. All rights reserved.</p>
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