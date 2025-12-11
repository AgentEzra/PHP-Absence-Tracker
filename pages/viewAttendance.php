<?php
include '../admin/config/connect.php';
include '../session.php';

redirectIfNotLoggedIn();

$credsId = $_SESSION['credsId'];

$sql = "SELECT t1.nama, t2.kelas, t2.jurusan, t2.waktu, t2.keterangan 
    FROM absence_table_creds as t1 
    INNER JOIN absence_table_abs as t2 ON t1.id = t2.credsId where t1.id = ?";
$stmt = $connect->prepare($sql);
$stmt->bind_param("i", $credsId);
$stmt->execute();

$result = $stmt->get_result();

$results = [];
while ($row = $result->fetch_assoc()) {
    $results[] = $row;
}

$profile = !empty($resultData['profImage']) ? $resultData['profImage'] : "../image/default.webp";

$stmt->close();
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

    <?php if(!empty($results)): ?>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Grade</th>
                    <th>Major</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $id = 0; ?>
                <?php foreach ($results as $resultsData): $id++ ?>
                <tr>
                    <td><?=$id; ?></td>
                    <td><?=$resultsData['nama']; ?></td>
                    <td><?=$resultsData['kelas']; ?></td>
                    <td><?=$resultsData['jurusan']; ?></td>
                    <td><?=$resultsData['waktu']; ?></td>
                    <td><?=$resultsData['keterangan']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <div class="no-records">
        <p>No attendance records found.</p>
    </div>
<?php endif; ?>

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
</html>