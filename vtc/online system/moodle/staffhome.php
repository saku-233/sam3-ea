<?php
session_start();

// Check if staff is logged in
if (!isset($_SESSION['staff_logged_in']) || !$_SESSION['staff_logged_in']) {
    header("Location: staff_login.php");
    exit();
}
?>


<body>
    <h1>歡迎來到 VTC@Work 職員內聯網！</h1>
    <p>歡迎您，<?php echo htmlspecialchars($_SESSION['staff_name']); ?> 老師/同工</p>
    <p>您的電郵：<?php echo htmlspecialchars($_SESSION['staff_email']); ?></p>
    <hr>
    <a href="../vtc/online system/staff_logout.php" style="color: red;">安全登出系統</a>
</body>

</html>