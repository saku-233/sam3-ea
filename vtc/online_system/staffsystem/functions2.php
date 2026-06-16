<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ========================================================
// 1. 處理登出 (op = logout)
// ========================================================
if (isset($_GET['op']) && $_GET['op'] == 'logout') {
    $_SESSION = array();
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();

    // 💡 修正：登出頁面就在同一個資料夾，直接寫純檔名！
    header("Location: vtc_staff_login.php");
    exit();
}

// ========================================================
// 2. 處理學生登入 (op = checkLogin)
// ========================================================
if (isset($_GET['op']) && $_GET['op'] == 'checkLogin') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (checkLogin($email, $password)) {
        $_SESSION['student_user'] = $email;
        // 💡 修正：利用 ../moodle/ 跳到隔壁資料夾，拿掉 vtc/ 鬼打牆路徑
        echo "<script>
            alert('student can not login with cas pls fk off');
            window.location.href = '../moodle/staff_login.php';
        </script>";
        exit();
    }
}

// ========================================================
// 3. 處理職員登入 (op = staffLogin)
// ========================================================
if (isset($_GET['op']) && $_GET['op'] == 'staffLogin') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (checkStaffLogin($email, $password)) {
        // ⭐ 核心修正：將這兩行跟 staffattendance.php 的安全檢查完全對齊！
        $_SESSION['staff_logged_in'] = true; 
        $_SESSION['staff_email'] = $email;
        
        header("Location: staffsystem_index.php");
        exit();
    } else {
        // 💡 修正：登入失敗彈窗，直接回同資料夾的純檔名！
        echo "<script>
            alert('帳號密碼都能忘你做什麼老師?');
            window.location.href = 'vtc_staff_login.php';
        </script>";
        exit();
    }
}

function checkStaffLogin($email, $password) {
    $staff = [
        ['email' => 'staff@vtc.edu.hk', 'password' => 'staff123']
    ];
    foreach ($staff as $user) {
        if ($user['email'] === $email && $user['password'] === $password) {
            return true;
        }
    }
    return false;
}

// 💡 修正：確保首頁能抓到名字
$user_name = $_SESSION['staff_email'] ?? 'Staff';
?>