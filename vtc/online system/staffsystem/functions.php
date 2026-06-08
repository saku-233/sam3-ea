<?php
session_start();

if (isset($_GET['op']) && $_GET['op'] == 'logout') {

    $_SESSION = array();

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }


    session_destroy();


    header("Location: index.php");
    exit();
}


if (isset($_GET['op']) && $_GET['op'] == 'checkLogin') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (checkLogin($email, $password)) {

        $_SESSION['student_user'] = $email;
        echo "<script>
            alert('student can not login with cas pls use moodle login');
            window.location.href = 'moodle.php';
        </script>";
        exit();
    }
}

if (isset($_GET['op']) && $_GET['op'] == 'staffLogin') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (checkStaffLogin($email, $password)) {
        $_SESSION['staff_logged_in'] = true;
        $_SESSION['staff_email'] = $email;
        header("Location: cas_index.php");
        exit();
    } else {
        echo "<script>
            alert('帳號密碼都能忘你做什麼老師?');
            window.location.href = 'cas_login.php';
        </script>";
        exit();
    }
}

function checkStaffLogin($email, $password)
{
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

$user_name = $_SESSION['staff_email'] ?? 'Staff';