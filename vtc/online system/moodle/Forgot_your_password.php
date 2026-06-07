<?php
// Forgot_your_password.php
session_start();

// 如果使用者還沒勾選過同意書，預設維持在步驟 1 (agreement)
if (!isset($_SESSION['reset_step'])) {
    $_SESSION['reset_step'] = 1;
}

$error_message = "";
$success_message = "";

// 處理所有表單提交
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 處理步驟 1 的 Accept 按鈕提交
    if (isset($_POST['action_step1'])) {
        if (isset($_POST['agree_terms'])) {
            $_SESSION['reset_step'] = 2; // 通過，前往步驟 2
        } else {
            $error_message = "請先勾選同意上述使用守則條款。";
        }
    }

    // 處理步驟 2 的 Next 按鈕提交
    elseif (isset($_POST['action_step2'])) {
        $cna = trim($_POST['cna'] ?? '');
        $validation_code = trim($_POST['validation_code'] ?? '');

        if (empty($cna)) {
            $error_message = "請輸入您的 CNA 帳號 / 學號。";
        } elseif (strtolower($validation_code) !== 'g$jk!') { // 比對圖片中的驗證碼
            $error_message = "驗證碼輸入錯誤，請再試一次。(注意大小寫)";
        } else {
            // 驗證成功，前往步驟 3
            $_SESSION['reset_step'] = 3;
            $_SESSION['reset_cna'] = $cna;
        }
    }

    // 處理步驟 3 的 Submit Change 按鈕提交（新增後端邏輯）
    elseif (isset($_POST['action_step3'])) {
        $new_password = $_POST['new_password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';

        if (empty($new_password) || empty($confirm_password)) {
            $error_message = "請填寫新密碼與確認密碼。";
        } elseif ($new_password !== $confirm_password) {
            $error_message = "兩次輸入的密碼不一致，請重新輸入。";
        } else {
            // 💡 這裡可以加入更新資料庫 (Database Update) 的程式碼
            // 例如: UPDATE users SET password = ... WHERE cna = $_SESSION['reset_cna']

            $success_message = "密碼重設成功！即將前往學生登入頁面。";

            // 清除重設密碼專用的暫存 Session
            unset($_SESSION['reset_step']);
            unset($_SESSION['reset_cna']);

            // 設定網頁定時跳轉
            header("refresh:3;url=student_login.php");
        }
    }
}

// 供前端高亮標籤狀態的變數
$current_step = $_SESSION['reset_step'] ?? 1;
?>
<!DOCTYPE html>
<html lang="zh-Hant">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email & CNA Services Portal - Reset Password</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        body,
        html {
            height: 100%;
            background-color: #ffffff;
            color: #002244;
        }

        /* 頂部導覽列 */
        header {
            width: 100%;
            height: 60px;
            background-color: #ffffff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 0 0 20px;

            .logo img {
                height: 45px;
                display: block;
            }

            .portal-title {
                font-size: 30px;
                font-weight: 500;
                color: #003366;
            }

            header {
                width: 100%;
                height: 60px;
                /* 假設你的導覽列高度是 60px */
                background-color: #ffffff;
                display: flex;
                justify-content: space-between;
                align-items: center;
                /* 依然保持垂直置中，以便對齊 Logo 與文字 */
                padding: 0 0 0 20px;
                /* ⚠️ 注意：右邊設為 0，這樣按鈕才能完全貼死最右邊，不留白邊 */
            }

            /* 🎯 控制「中文」按鈕：完全填滿、直角、無邊框 */
            .lang-btn {
                background-color: #00bcd4;
                color: white;
                border: none;
                font-size: 14px;
                font-weight: bold;
                cursor: pointer;
                height: 100%;
                border-radius: 0;
                margin: 0;
                padding: 0 20px;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: none;
            }

            .lang-btn:hover {
                background-color: #009cb1;
            }

            /* 主要內容佈局 */
            .container {
                max-width: 1200px;
                margin: 40px auto;
                padding: 0 20px;
                display: flex;
                gap: 40px;
                min-height: 400px;
            }

            /* 左側步驟導覽選單 */
            .sidebar-steps {
                width: 200px;
                display: flex;
                flex-direction: column;
                gap: 12px;
            }

            .step-item {
                width: 100%;
                padding: 14px 12px;
                border-radius: 4px;
                font-size: 14px;
                font-weight: 500;
                text-align: left;
                background-color: #a4cbd9;
                color: #ffffff;
                border: none;
                transition: all 0.2s ease;
            }

            /* 當前處於活動狀態的步驟 */
            .step-item.active {
                background-color: #00bcd4;
                color: #ffffff;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
            }

            /* 右側核心操作內容區塊 */
            .main-content {
                flex: 1;
                padding-top: 10px;
            }

            .section-title {
                font-size: 18px;
                color: #003366;
                font-weight: 600;
                margin-bottom: 25px;
            }

            /* 錯誤提示 */
            .error-alert {
                background-color: #fde8e8;
                color: #e74c3c;
                border: 1px solid #f5c6cb;
                padding: 10px;
                font-size: 13px;
                margin-bottom: 20px;
                border-radius: 4px;
                max-width: 600px;
            }

            /* 成功提示 */
            .success-alert {
                background-color: #d4edda;
                color: #155724;
                border: 1px solid #c3e6cb;
                padding: 10px;
                font-size: 13px;
                margin-bottom: 20px;
                border-radius: 4px;
                max-width: 600px;
            }

            /* 步驟一：條款容器 */
            .terms-textarea {
                width: 100%;
                max-width: 750px;
                height: 220px;
                border: 1px solid #ccc;
                padding: 15px;
                font-size: 13px;
                line-height: 1.6;
                overflow-y: scroll;
                background-color: #fafafa;
                margin-bottom: 15px;
            }

            .checkbox-group {
                margin-bottom: 25px;
                font-size: 13px;
                color: #555555;
                display: flex;
                align-items: flex-start;
                gap: 8px;
                max-width: 750px;
                line-height: 1.4;
            }

            .checkbox-group label {
                cursor: pointer;
            }

            /* 步驟二與三：表單欄位樣式 */
            .form-group {
                margin-bottom: 20px;
                max-width: 600px;
            }

            .form-group label {
                display: block;
                font-size: 13px;
                color: #333333;
                margin-bottom: 6px;
            }

            .input-wrapper {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .input-ctrl {
                flex: 1;
                padding: 8px 12px;
                border: 1px solid #ababab;
                font-size: 14px;
                outline: none;
            }

            .input-ctrl:focus {
                border-color: #00bcd4;
            }

            .domain-hint {
                font-size: 14px;
                color: #666666;
            }

            /* 驗證碼控制區塊 */
            .captcha-container {
                display: flex;
                align-items: center;
                gap: 20px;
                margin-top: 10px;
            }

            .captcha-img {
                height: 45px;
                border: 1px dashed #ccc;
                display: block;
            }

            /* 共用按鈕樣式 */
            .btn-action {
                background-color: #00bcd4;
                color: #ffffff;
                border: none;
                padding: 8px 24px;
                font-size: 14px;
                font-weight: 500;
                cursor: pointer;
                border-radius: 2px;
            }

            .btn-action:hover {
                background-color: #009cb1;
            }

            .btn-secondary {
                background-color: #00bcd4;
                color: #ffffff;
                border: none;
                padding: 8px 15px;
                font-size: 13px;
                cursor: pointer;
            }

            /* 底部頁尾欄 */
            footer {
                background-color: #1a2332;
                color: #ffffff;
                padding: 15px 40px;
                position: fixed;
                bottom: 0;
                left: 0;
                width: 100%;
                display: flex;
                justify-content: space-between;
                font-size: 12px;
            }

            .footer-links a {
                color: #ffffff;
                text-decoration: none;
                margin-left: 15px;
            }

            .footer-links a:hover {
                text-decoration: underline;
            }
    </style>
</head>

<body>

    <header>
        <div class="logo">
            <img src="/vtc/image/logo-default.png" alt="VTC Logo">
        </div>
        <div class="portal-title">Email & CNA Services Portal</div>
        <button class="lang-btn">中文</button>
    </header>

    <div class="container">
        <div class="sidebar-steps">
