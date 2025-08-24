<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="../index.php">Absence Tracker</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav me-auto">

        <!-- Dashboard -->
        <li class="nav-item">
          <a class="nav-link" href="../dashboard.php">Dashboard</a>
        </li>

        <!-- Attendance -->
        <li class="nav-item">
          <a class="nav-link" href="./viewAttendance.php">My Attendance</a>
        </li>

        <!-- Absence Requests -->
        <li class="nav-item">
          <a class="nav-link" href="./requestAbsence.php">Request Absence</a>
        </li>

        <!-- Reports -->
        <li class="nav-item">
          <a class="nav-link" href="./myReports.php">My Reports</a>
        </li>
      </ul>

      <!-- Profile -->
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="./image/dias.jpg" alt="Profile" width="25" height="25" class="rounded-circle"> User
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="./pages/profile.php">Profile</a></li>
            <li><a class="dropdown-item" href="./login/forgotPassword.php">Change Password</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-danger" href="./admin/config/logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>