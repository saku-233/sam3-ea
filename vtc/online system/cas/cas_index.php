<?php include 'cas_head.php';
include 'functions.php';
?>

<body>
    <p>這裡是 CAS 的首頁，請選擇左側的功能。</p>
    <h2>Today is <?php echo date('d-m-Y'); ?>, welcome back <?php echo htmlspecialchars($user_name); ?></h2>
    <ul>    
        <li><a href="attendance.php">考勤管理</a></li>
        <li><a href="functions.php?op=logout">登出</a></li>
    </ul>
</body>
</html>

