<?php
// index.php
session_start();
?>
<!DOCTYPE html>
<html lang="zh-Hant">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moodle - Log in to the site</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }

        body {
            background-color: #ffffff;
            color: #333333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            width: 100%;
            background: #fff;
            border-bottom: 1px solid #e5e5e5;
            padding: 12px 0;
        }

        .header-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo img {
            height: 35px;
            display: block;
        }

        .top-nav {
            display: flex;
            gap: 24px;
            font-size: 13px;
            align-items: center;
        }

        .top-nav a {
            color: #333333;
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            transition: color 0.2s ease;
        }

        .top-nav a:hover {
            color: #0066cc;
        }

        .hero-banner {
            background: linear-gradient(135deg, #d35400 0%, #e67e22 40%, #f39c12 100%);
            padding: 30px 0;
            color: white;
            width: 100%;
        }

        .hero-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        .hero-banner h1 {
            font-size: 24px;
            font-weight: 400;
            margin-bottom: 10px;
        }

        .breadcrumb {
            font-size: 13px;
        }

        .breadcrumb a {
            color: #fff;
            text-decoration: none;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        .container {
            max-width: 1200px;
            width: 100%;
            margin: 40px auto;
            padding: 0 24px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            flex: 1;
        }

        @media (max-width: 768px) {
            .container {
                grid-template-columns: 1fr;
                gap: 40px;
            }
        }

        /* --- 左側：登入按鈕區 --- */
        .login-section h2 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #333;
        }

        .btn-cna {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            max-width: 350px;
            padding: 12px;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            margin-bottom: 12px;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: opacity 0.2s ease;
        }

        .btn-cna:hover {
            opacity: 0.9;
        }

        .btn-staff {
            background-color: #a86b5c;
        }

        .btn-student {
            background-color: #e67e22;
        }

        .login-section .links {
            margin-top: 15px;
            font-size: 13px;
        }

        .login-section .links a {
            color: #0066cc;
            text-decoration: none;
        }

        .login-section .links a:hover {
            text-decoration: underline;
        }

        .divider {
            margin: 20px 0;
            color: #999;
            font-size: 13px;
            position: relative;
            max-width: 350px;
            text-align: center;
        }

        .non-cna {
            font-size: 14px;
            color: #333;
            margin-top: 15px;
        }

        /* --- 右側：資訊說明區 --- */
        .info-section h3 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .info-section p {
            font-size: 13px;
            line-height: 1.6;
            margin-bottom: 15px;
            color: #444;
        }

        .info-section ul {
            margin-left: 20px;
            margin-bottom: 20px;
            font-size: 13px;
            line-height: 1.8;
            color: #444;
        }

        .info-section a {
            color: #0066cc;
            text-decoration: none;
        }

        .info-section a:hover {
            text-decoration: underline;
        }

        /* 指引按鈕 */
        .btn-guide {
            display: inline-block;
            background-color: #e67e22;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 13px;
            font-weight: bold;
            margin-top: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        footer {
            background-color: #1a252f;
            color: #95a5a6;
            padding: 25px 0;
            font-size: 12px;
            line-height: 1.8;
            width: 100%;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        .footer-links {
            margin-top: 10px;
        }

        .footer-links a {
            color: #3498db;
            text-decoration: none;
            margin-right: 15px;
        }

        .footer-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <header>
        <div class="header-container">
            <div class="logo">
                <img src="/vtc/image/logo-default.png" alt="VTC logo">
            </div>
            <div class="top-nav">
                <a href="#">eLearning Resources ▾</a>
                <a href="#">IT Resources ▾</a>
                <a href="#">Support ▾</a>
                <a href="#">VTC Search</a>
                <a href="#">ENGLISH ▾</a>
            </div>
        </div>
    </header>

    <div class="hero-banner">
        <div class="hero-container">
            <h1>Log in to the site</h1>
            <div class="breadcrumb">
                🏠 <a href="vtc/online system/moodle/index.php">Home</a> &gt; Log in to the site
            </div>
        </div>
    </div>

    <div class="container">

        <div class="login-section">
            <h2>Login with CNA</h2>

            <a href="staff_login.php" class="btn-cna btn-staff">👤 Staff Sign On</a>
            <a href="student_login.php" class="btn-cna btn-student">👥 Student / IT Account Sign On</a>

            <div class="links">
                <a href="#">Forgot CNA password?</a>
            </div>

            <div class="divider">or</div>

            <div class="non-cna">
                ▶ <a href="#" style="color: #333; text-decoration: none; font-weight: bold;">For non-CNA account only</a>
            </div>

            <p style="font-size: 12px; color: #666; margin-top: 25px;">
                Cookies must be enabled in your browser. <a href="#" style="color: #0066cc; text-decoration: none;">Cookies notice</a>
            </p>
        </div>

        <div class="info-section">
            <h3>Information</h3>
            <p>如在校外登入 Moodle 發生問題，可以嘗試連接 VTC 的 <strong>VPN 服務</strong>，後再登入。</p>
            <p>為提高網上服務的安全性，於非職訓局網絡下，需以雙重認證方式登入 Moodle AY 2526 平台。</p>

            <ul>
                <li>學生如欲了解詳細指引及詳情，請登入<strong>學生雙重認證網址</strong>：<br><a href="https://2fa.vtc.edu.hk">https://2fa.vtc.edu.hk</a></li>
                <li>老師如欲了解詳細指引及詳情，請登入<strong>老師雙重認證網址</strong>：<br><a href="https://2fa.vtc.edu.hk">https://2fa.vtc.edu.hk</a></li>
            </ul>

            <p><strong>Two Factor Authentication (2FA) was enforced in Moodle for AY 2526. 2FA is required when login into this system outside the campus network.</strong></p>

            <ul>
                <li>For student 2FA, please click <a href="#">here</a> for the detail.<br><a href="https://2fa.vtc.edu.hk">https://2fa.vtc.edu.hk</a></li>
                <li>For staff 2FA, please click <a href="#">here</a> for the detail.<br><a href="https://2fa.vtc.edu.hk">https://2fa.vtc.edu.hk</a></li>
            </ul>

            <p><strong>Teachers should log in to Moodle with staff CNA instead of "Teaching account(t-CNA)".</strong></p>

            <ul>
                <li>For AY2024/25 programme, please click <a href="#">here</a>.</li>
                <li>For Degree programme, THEi staff and students please visit Moodle THEi site (<a href="https://moodle.thei.edu.hk">https://moodle.thei.edu.hk</a>).</li>
            </ul>

            <a href="#" class="btn-guide">Moodle Guidelines For Teacher</a>
        </div>

    </div>

    <footer>
        <div class="footer-container">
            <p>Copyright (c) Vocational Training Council. All rights reserved.</p>
            <div class="footer-links">
                <a href="#">Data retention summary</a>
                <a href="#">Get the mobile app</a>
            </div>
        </div>
    </footer>

</body>

</html>