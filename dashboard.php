<?php
include './admin/config/connect.php';
include 'session.php';

redirectIfNotLoggedIn()
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
        }
        
        /* Navigation styles */
        .navbar {
            background-color: #343a40;
            padding: 0.75rem 1rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .navbar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .navbar-brand {
            color: #fff;
            text-decoration: none;
            font-size: 1.25rem;
            font-weight: 600;
        }
        
        .navbar-nav {
            display: flex;
            list-style: none;
            gap: 1.5rem;
        }
        
        .nav-link {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            padding: 0.5rem 0.75rem;
            border-radius: 0.25rem;
            transition: all 0.2s ease;
        }
        
        .nav-link:hover {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        /* Profile dropdown styles */
        .profile-dropdown {
            position: relative;
        }
        
        .dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            padding: 0.5rem 0.75rem;
            border-radius: 0.25rem;
            transition: all 0.2s ease;
        }
        
        .dropdown-toggle:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .profile-img {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            object-fit: cover;
        }
        
        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background-color: #fff;
            min-width: 180px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border-radius: 0.375rem;
            padding: 0.5rem 0;
            z-index: 1000;
            display: none;
            list-style: none;
        }
        
        .dropdown-menu.show {
            display: block;
        }
        
        .dropdown-item {
            display: block;
            padding: 0.5rem 1rem;
            color: #212529;
            text-decoration: none;
            transition: background-color 0.15s ease;
        }
        
        .dropdown-item:hover {
            background-color: #f8f9fa;
        }
        
        .dropdown-divider {
            height: 1px;
            margin: 0.5rem 0;
            overflow: hidden;
            background-color: #e9ecef;
        }
        
        .text-danger {
            color: #dc3545;
        }
        
        /* Mobile menu styles */
        .navbar-toggle {
            display: none;
            background: none;
            border: none;
            color: #fff;
            font-size: 1.5rem;
            cursor: pointer;
        }
        
        /* Responsive styles */
        @media (max-width: 992px) {
            .navbar-nav {
                gap: 1rem;
            }
        }
        
        @media (max-width: 768px) {
            .navbar-container {
                flex-wrap: wrap;
            }
            
            .navbar-toggle {
                display: block;
            }
            
            .navbar-collapse {
                width: 100%;
                display: none;
                margin-top: 1rem;
            }
            
            .navbar-collapse.show {
                display: block;
            }
            
            .navbar-nav {
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .profile-dropdown {
                margin-top: 0.5rem;
            }
            
            .dropdown-menu {
                position: static;
                box-shadow: none;
                background-color: transparent;
                border: 1px solid rgba(255, 255, 255, 0.1);
                margin-top: 0.5rem;
            }
            
            .dropdown-item {
                color: rgba(255, 255, 255, 0.8);
                padding-left: 2rem;
            }
            
            .dropdown-item:hover {
                background-color: rgba(255, 255, 255, 0.1);
                color: #fff;
            }
        }
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
                <ul class="navbar-nav">
                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a class="nav-link" href="./dashboard.php">Dashboard</a>
                    </li>

                    <!-- Attendance -->
                    <li class="nav-item">
                        <a class="nav-link" href="./pages/viewAttendance.php">My Attendance</a>
                    </li>

                    <!-- Absence Requests -->
                    <li class="nav-item">
                        <a class="nav-link" href="./pages/requestAbsence.php">Request Absence</a>
                    </li>

                    <!-- Reports -->
                    <li class="nav-item">
                        <a class="nav-link" href="./pages/myReports.php">My Reports</a>
                    </li>

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

                <!-- Profile -->
                <ul >
                    
                </ul>
            </div>
        </div>
    </nav>

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