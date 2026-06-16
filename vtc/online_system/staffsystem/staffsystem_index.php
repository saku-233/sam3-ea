<?php include 'vtc_staffsystem_header.php';
include 'functions2.php';
session_start();
?>

<body>

    <h2>Today is <?php echo date('d-m-Y'); ?>, welcome back <?php echo htmlspecialchars($user_name); ?></h2>

    <a href="staffattendance.php">查看考勤紀錄</a>

    <a href="../cas/cas_index.php">go to CAS</a>

    <a href="vtc_staff_login.php" style="color: red;">安全登出系統</a>
</body>

</html>

</html>