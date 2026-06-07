<?php
// 獲取當前請求的網址路徑
$uri = $_SERVER['REQUEST_URI'];

// 如果使用者直接訪問根目錄 ( / )，自動幫他導向到學生登入頁面
if ($uri === '/' || $uri === '/studenthome.php') {
    header("Location: /vtc/online system/moodle/studenthome.php");
    exit();
}
?>