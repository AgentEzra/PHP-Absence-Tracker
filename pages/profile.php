<?php
include '../admin/config/connect.php';
include '../session.php';

redirectIfNotLoggedIn();

$username = '';
$name = '';
$grade = '';
$major = '';
$ppImg = '';
$address = '';
$bio = '';

$credsId = $_SESSION['credsId'];

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username'];
    $name = $_POST['name'];
    $grade = $_POST['grade'];
    $major = $_POST['major'];
    $address = $_POST['address'];
    $bio = $_POST['bio'];

    if (isset($_FILES['profile-img']) && $_FILES['profile-img']['error'] == 0){
        $file = $_FILES['profile-img'];

        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $newFileName = $credsId . '-' . date('ymd') . '.' . $extension;

        $uploadPath = '../image/' . $newFileName;

        if (move_uploaded_file($file['tmp_name'], $uploadPath)){
            $imageFileName = $newFileName;

            $checkImageQuery = "SELECT profImage FROM user_profile where credsId = '$credsId'";
            $result = mysqli_query($connect, $checkImageQuery);

            if (mysqli_num_rows($result) > 0){
                $updateImageQuery = "UPDATE user_profile SET profImage = '$imageFileName' WHERE credsId = '$credsId'";
                $result = mysqli_query($connect, $updateImageQuery);
            }
            else {
                $insertImageQuery = "INSERT INTO user_profile(credsId, profImage) VALUES ('$credsId', '$imageFileName')";
                $result = mysqli_query($connect, $insertImageQuery);
            }
        }
    }  

    //query update creds
    $queryUpdateCreds = "UPDATE absence_table_creds SET 
        username = '$username', nama = '$name', kelas = '$grade', jurusan = '$major' WHERE id = '$credsId'";
    
    //query insert profile
    $queryUpdateProfile = "UPDATE user_profile SET
        alamat = '$address', bio = '$bio' WHERE credsId = '$credsId'";

    //query update profile
    $queryInsertProfile = "INSERT INTO user_profile(credsId, alamat, bio) VALUES('$credsId', '$address', '$bio')";

    //query check data by select
    $queryFetchProfile = "SELECT * FROM user_profile WHERE credsId = '$credsId'";
    mysqli_query($connect, $queryUpdateCreds);



    $result = mysqli_query($connect, $queryFetchProfile);

    $checkProfile = mysqli_fetch_assoc($result);

    if (!empty($checkProfile)){
        $result = mysqli_query($connect, $queryUpdateProfile);
    }
    else {
        $result = mysqli_query($connect, $queryInsertProfile);
    }

    // Redirect to refresh page and show updated image
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}


$sql = "SELECT t1.username, t1.nama, t1.kelas, t1.jurusan, t2.profImage, t2.alamat, t2.bio 
    FROM absence_table_creds as t1 
    LEFT JOIN user_profile as t2 ON t1.id = t2.credsId where t1.id = ?";
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
$profile = !empty($resultData['profImage']) ? "../image/" . $resultData['profImage'] : "../image/default.webp";

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" href="../styleDashboard.css">
    <link rel="stylesheet" href="./styleProfile.css">
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
    <div class="box-profile">
        <div class="absence-rows">
            <form method="post" enctype="multipart/form-data">
                <div class="profile-image">
                    <img src="<?=$profile ?>" alt="Profile" style="width: 300px; height: 300px; border-radius: 200px">
                </div>

                <div class="absence-part">
                    <label for="profile-img" class="label-file">Edit Profile Image</label>
                    <input type="file" id="profile-img" name="profile-img" accept="image/*" class="file-input">
        
                    <input type="text" name="username" placeholder="Username" value="<?=$resultData['username'] ?? ''; ?>">
                    <input type="text" name="name" placeholder="Name" value="<?=$resultData['nama'] ?? ''; ?>">
                    <input type="text" name="grade" placeholder="Grade" value="<?=$resultData['kelas'] ?? ''; ?>">
                    <input type="text" name="major" placeholder="Major" value="<?=$resultData['jurusan'] ?? ''; ?>">
                    <input type="text" name="address" placeholder="Address" value="<?=$resultData['alamat'] ?? ''; ?>">
                    <textarea type="text" name="bio" placeholder="Bio" value="<?=$resultData['bio'] ?? ''; ?>"></textarea>
                    <button>Submit</button>
                </div>
            </form>
        </div>
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