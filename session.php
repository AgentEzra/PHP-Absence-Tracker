<?php
session_start();

function isLoggedIn() {
    return 
    isset($_SESSION['user_id']);
    isset($_SESSION['username']);
}

function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function isUser() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'user';
}

function redirectIfNotLoggedIn() {
    if (!isLoggedIn()) {
        header("Location: index.php"); //this is login pages
        exit();
    }
}

function redirectIfNotAdmin() {
    if (!isAdmin()) {
        header("Location: dashboard.php");
        exit();
    }
}

function redirectAfterLogin() {
    header("Location: dashboard.php");
    exit();
}
?>