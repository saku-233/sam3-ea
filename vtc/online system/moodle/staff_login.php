<?php
// staff_login.php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

$error_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    if ($email === "staff@vtc.edu.hk" && $password === "Staffpassword123") {
        $_SESSION['staff_logged_in'] = true;
        $_SESSION['staff_email'] = $email;

        echo "<h1 style='color:green; text-align:center; margin-top:50px;'>🎉 職員登入成功！</h1>";
        echo "<p style='text-align:center;'>您的帳號為: " . htmlspecialchars($email) . "</p>";
        exit;
    } else {
        $error_message = "不正確的帳號或密碼，請重新輸入。";
    }
}
?>
<!DOCTYPE html>
<html lang="zh-Hant">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VTC@Work (General Zone)</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: -apple-system, sans-serif;
        }

        body,
        html {
            height: 100%;
            background-color: #ffffff;
        }

        .wrapper {
            display: table;
            width: 100%;
            height: 100%;
            table-layout: fixed;
        }

        .row {
            display: table-row;
        }

        .visual-side {
            display: table-cell;
            width: 75%;
            position: relative;
            background-color: #eaedd5;
            background-image: linear-gradient(to bottom right, rgba(122, 179, 100, 0.2), rgba(255, 255, 255, 0.1));
        }

        .general-zone-ribbon {
            position: absolute;
            top: 0;
            left: 0;
            width: 350px;
            height: 350px;
            background: #7ab364;
            transform: rotate(-45deg) translate(-170px, -70px);
            display: flex;
            align-items: flex-end;
            justify-content: center;
            padding-bottom: 20px;
        }

        .ribbon-text {
            transform: rotate(45deg);
            color: white;
            font-size: 32px;
            font-weight: 500;
            margin-bottom: 40px;
            margin-left: 40px;
        }

        .login-side {
            display: table-cell;
            width: 25%;
            background-color: #ffffff;
            vertical-align: top;
            padding: 50px 35px;
            position: relative;
            box-shadow: -5px 0 15px rgba(0, 0, 0, 0.03);
        }

        .logo img {
            display: block;
            height: auto;
            max-height: 45px;
            margin-bottom: 10px;
        }

        .logo-text span {
            color: #ff9100;
        }

        .zone-title {
            margin-bottom: 25px;
        }

        .zone-title h3 {
            font-size: 14px;
            color: #333;
        }

        .zone-title h3 span {
            color: #7ab364;
        }

        .zone-title p {
            font-size: 13px;
            color: #666;
        }

        .instruction-text {
            font-size: 11px;
            color: #444;
            margin-bottom: 15px;
            line-height: 1.5;
        }

        .form-group {
            margin-bottom: 10px;
        }

        .input-field {
            width: 100%;
            padding: 6px 10px;
            font-size: 11px;
            border: 1px solid #c0c0c0;
            outline: none;
        }

        .btn-signin {
            background-color: #0066cc;
            color: white;
            border: none;
            padding: 6px 18px;
            font-size: 11px;
            cursor: pointer;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .warning-text {
            font-size: 11px;
            color: #cc0000;
            font-weight: bold;
            line-height: 1.5;
        }

        @media (max-width: 1024px) {

            .wrapper,
            .row {
                display: block;
            }

            .visual-side {
                display: none;
            }

            .login-side {
                display: block;
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="row">
            <div class="visual-side">
                <div class="general-zone-ribbon">
                    <div class="ribbon-text">General Zone</div>
                </div>
            </div>
            <div class="login-side">

                <div class="zone-title">
                    <div class="logo" style="margin-bottom: 15px;">
                        <img src="../../image/logo-default.png" alt="VTC logo" style="max-height: 45px;">
                    </div>
                    <h3>VTC@Work <span>(General Zone)</span></h3>
                    <p>職員內聯網</p>
                </div>

                <?php if (!empty($error_message)): ?>
                    <div style="color: #cc0000; font-size: 11px; margin-bottom: 12px; font-weight: bold;">⚠️ <?php echo $error_message; ?></div>
                <?php endif; ?>

                <div class="instruction-text">
                    Please logon by your CNA email address and Password<br>請輸入你的 CNA 電郵地址及密碼登入
                </div>

                <form action="staff_login.php" method="POST">
                    <div class="form-group"><input type="text" name="email" class="input-field" placeholder="someone@vtc.edu.hk" required></div>
                    <div class="form-group"><input type="password" name="password" class="input-field" placeholder="Password" required></div>
                    <button type="submit" class="btn-signin">Sign in</button>
                </form>

                <div class="warning-text">
                    ** Remember to Logout - It is important to Logout or close all of your web browser windows when you finish using IT services. **
                </div>
            </div>
        </div>
    </div>
</body>

</html>