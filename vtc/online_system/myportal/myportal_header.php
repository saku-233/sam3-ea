<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

$student_name = $_SESSION['student_name'] ?? 'Kit Fai';
$current_date = date('d M Y (D)');
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyPortal - VTC</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        body {
            background-color: #f4f7f9;
            display: flex;
            min-height: 100vh;
        }

        /* 1. 左側導覽列樣式 */
        .sidebar {
            width: 240px;
            background-color: #fff;
            border-right: 1px solid #e1e8ed;
            padding: 15px 0;
            flex-shrink: 0;
        }
        .sidebar-brand {
            padding: 0 20px 15px 20px;
            font-size: 20px;
            font-weight: bold;
            color: #004098;
            border-bottom: 1px solid #f0f4f7;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .sidebar-menu {
            list-style: none;
            margin-top: 10px;
        }
        .sidebar-menu li a {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            color: #555;
            text-decoration: none;
            font-size: 13px;
            transition: background 0.2s;
        }
        .sidebar-menu li a:hover {
            background-color: #f0f4f7;
            color: #004098;
        }
        .sidebar-menu li a .icon {
            margin-right: 10px;
            font-size: 16px;
        }

        /* 主區域排版 */
        .main-wrapper {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        /* 2. 頂部導覽列 */
        .top-header {
            background-color: #fff;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            border-bottom: 1px solid #e1e8ed;
        }
        .top-header .logo-text {
            color: #004098;
            font-size: 22px;
            font-weight: bold;
        }
        .header-right {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 13px;
            color: #666;
        }
        .btn-logout {
            border: 1px solid #ccc;
            padding: 4px 10px;
            border-radius: 4px;
            text-decoration: none;
            color: #666;
        }
        .btn-logout:hover {
            background: #f5f5f5;
        }

        /* 主內容容器 */
        .main-body {
            padding: 25px 30px;
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
            flex-grow: 1;
        }

        /* 3. 歡迎 Banner 區 */
        .welcome-banner {
            background: linear-gradient(135deg, #ffffff 0%, #f1f6fa 100%);
            border: 1px solid #e1e8ed;
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }
        .welcome-banner h1 {
            font-size: 22px;
            color: #333;
            margin-bottom: 5px;
        }
        .welcome-banner p {
            font-size: 13px;
            color: #777;
        }

        /* 4. 五個圓形快速按鈕 */
        .quick-links {
            display: grid;
            grid-template-columns: repeat(5, 100px);
            gap: 20px;
            margin-bottom: 30px;
        }
        .quick-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            text-decoration: none;
            color: #333;
        }
        .quick-icon {
            width: 60px;
            height: 60px;
            background-color: #e8f2fe;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: #004098;
            margin-bottom: 8px;
            transition: transform 0.2s, background-color 0.2s;
            border: 1px solid #d0e3fa;
        }
        .quick-item:hover .quick-icon {
            transform: translateY(-3px);
            background-color: #004098;
            color: #fff;
        }
        .quick-label {
            font-size: 12px;
            line-height: 1.3;
        }

        /* 5. 重要公告 */
        .notice-card {
            background: #fff;
            border: 1px solid #e1e8ed;
            border-radius: 6px;
            padding: 20px;
            margin-bottom: 30px;
            max-width: 500px;
        }
        .notice-title {
            font-size: 14px;
            font-weight: bold;
            color: #333;
            text-decoration: underline;
            margin-bottom: 10px;
        }
        .notice-body {
            font-size: 12px;
            color: #555;
            line-height: 1.6;
            margin-bottom: 15px;
        }
        .btn-viewmore {
            font-size: 12px;
            color: #004098;
            text-decoration: none;
            font-weight: bold;
        }

        /* 6. 線上學生服務表格 */
        .service-section h2 {
            font-size: 18px;
            color: #004098;
            margin-bottom: 15px;
            border-bottom: 2px solid #004098;
            padding-bottom: 5px;
        }
        .service-table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border: 1px solid #e1e8ed;
            border-radius: 4px;
            overflow: hidden;
        }
        .service-table td {
            padding: 15px 20px;
            border-bottom: 1px solid #e1e8ed;
            font-size: 13px;
            vertical-align: top;
        }
        .service-table tr:last-child td {
            border-bottom: none;
        }
        .category-name {
            font-weight: bold;
            color: #333;
            width: 200px;
            background-color: #fafbfc;
            border-right: 1px solid #e1e8ed;
        }
        .link-group {
            display: flex;
            flex-wrap: wrap;
            gap: 15px 25px;
        }
        .link-group a {
            color: #004098;
            text-decoration: none;
        }
        .link-group a:hover {
            text-decoration: underline;
        }

        /* 7. 頁尾專屬樣式 */
        .portal-footer {
            background-color: #1a252f;
            color: #95a5a6;
            padding: 20px 30px;
            font-size: 12px;
            text-align: left;
            border-top: 1px solid #111;
        }
        .portal-footer a {
            color: #3498db;
            text-decoration: none;
            margin-right: 15px;
        }
        .portal-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="sidebar-brand">🔑 MyPortal</div>
        <ul class="sidebar-menu">
            <li><a href="myindex.php"><span class="icon">🏠</span> Home</a></li>
            <li><a href="#"><span class="icon">📅</span> Timetable</a></li>
            <li><a href="#"><span class="icon">👤</span> Profile</a></li>
            <li><a href="#"><span class="icon">🔒</span> Locker</a></li>
            <li><a href="#"><span class="icon">📂</span> Document Download</a></li>
            <li><a href="../moodle/studenthome.php"><span class="icon">🎓</span> Moodle Platform</a></li>
        </ul>
    </aside>

    <div class="main-wrapper">
        
        <header class="top-header">
            <div class="logo-text">VTC</div>
            <div class="header-right">
                <span>Log out 繁 | 简 | EN</span>
                <a href="logout.php" class="btn-logout">Log out</a>
            </div>
        </header>

        <div class="main-body">