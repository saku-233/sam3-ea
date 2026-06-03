<?php
// staffhome.php
session_start();

// 安全檢查：如果不是教職員登入，直接踢回 staff_login.php
if (!isset($_SESSION['staff_logged_in']) || $_SESSION['staff_logged_in'] !== true) {
    header("Location: staff_login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="zh-Hant">

<head>
    <meta charset="UTF-8">
    <title>VTC@Work - 職員內聯網主頁</title>
</head>

<body>
    <h1>歡迎來到 VTC@Work 職員內聯網！</h1>
    <p>歡迎您，<?php echo htmlspecialchars($_SESSION['staff_name']); ?> 老師/同工</p>
    <p>您的電郵：<?php echo htmlspecialchars($_SESSION['staff_email']); ?></p>
    <hr>
    <a href="student_logout.php" style="color: red;">安全登出系統</a>
</body>

</html>