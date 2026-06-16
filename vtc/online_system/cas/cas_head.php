<?php
session_start();

if (!isset($_SESSION['staff_logged_in']) || !$_SESSION['staff_logged_in']) {
    header("Location: cas_login.php");
    exit();
}

$user_name = $_SESSION['staff_email'] ?? 'Staff';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>歡迎來到 CAS 系統！</title>
</head>