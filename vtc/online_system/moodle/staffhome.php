<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

// Check if staff is logged in
if (!isset($_SESSION['staff_logged_in']) || !$_SESSION['staff_logged_in']) {
    header("Location: staff_login.php");
    exit();
}
?>


<body>
    <h1>歡迎來到 VTC@Work 職員內聯網！</h1>
    <?php
    $staffName = $_SESSION['staff_name'] ?? '';
    $staffEmail = $_SESSION['staff_email'] ?? '';
    ?>
    <p>歡迎您，<?php echo htmlspecialchars($staffName, ENT_QUOTES, 'UTF-8'); ?> </p>
    <p>您的電郵：<?php echo htmlspecialchars($staffEmail, ENT_QUOTES, 'UTF-8'); ?></p>
    <hr>
    <a href="../vtc/online system/staff_logout.php" style="color: red;">安全登出系統</a>
</body>

</html>