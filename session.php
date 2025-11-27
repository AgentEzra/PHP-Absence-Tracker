<?php
session_start();

function isLoggedIn() {
    return isset($_SESSION['username']) && // check if session already exist
        isset($_SESSION['credsId']);
}

function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function isUser() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'user';
}

function redirectIfNotLoggedIn() {
    if (!isLoggedIn()) {
        header("Location: index.php"); // this is login pages
        exit();
    }
}

function redirectIfNotAdmin() {
    if (!isAdmin()) {
        header("Location: dashboard.php"); // protect admin pages
        exit();
    }
}

function redirectAfterLogin() {
    header("Location: dashboard.php"); // i have no idea when this will be used
    exit();
}
?>