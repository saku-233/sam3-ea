<?php include 'vtc_staffsystem_header.php';
include 'functions.php';
session_start();
?>

<boby>
    <h1>Staff System Index</h1>
    <p>歡迎來到職員系統首頁！</p>
    <h2>Today is <?php echo date('d-m-Y'); ?>, welcome back <?php echo htmlspecialchars($user_name); ?></h2>
    <a href="staffattendance.php">查看考勤紀錄</a>
    <a href="../cas/cas_login.php">go to CAS</a>
    <a href="../vtc/online system/staff_logout.php" style="color: red;">安全登出系統</a>
    </body>

    </html>