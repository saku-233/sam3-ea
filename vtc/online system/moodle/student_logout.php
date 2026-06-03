<?php
session_start();

// 清空所有 Session 變數
$_SESSION = array();

// 銷毀 Cookie 中的 Session ID
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 銷毀 Session
session_destroy();

// 導向回登入首頁
header("Location: index.php");
exit;