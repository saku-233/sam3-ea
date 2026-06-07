<!DOCTYPE html>
<html lang="zh-Hant">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Moodle</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        body {
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: #ffffff;
            border-bottom: 1px solid #e5e5e5;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 60px;
            z-index: 1000;
        }

        .header-container {
            max-width: 1400px;
            margin: 0 auto;
            height: 100%;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .logo img {
            height: 32px;
            display: block;
        }

        .main-nav {
            display: flex;
            gap: 20px;
            list-style: none;
            font-size: 14px;
        }

        .main-nav a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
        }

        .badge-orange {
            background-color: #e67e22;
            color: white;
            font-size: 11px;
            padding: 2px 6px;
            border-radius: 10px;
            margin-left: 4px;
            font-weight: bold;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
            font-size: 14px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: #ddd;
            overflow: hidden;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .logout-btn {
            color: #d35400;
            text-decoration: none;
            font-size: 12px;
            border: 1px solid #d35400;
            padding: 4px 8px;
            border-radius: 4px;
            transition: all 0.2s;
        }

        .logout-btn:hover {
            background-color: #d35400;
            color: white;
        }

        .wrapper {
            display: flex;
            margin-top: 60px;
            /* 留出 Header 的空間 */
            flex: 1;
        }

        /* 左側細長橘色選單 */
        .sidebar {
            width: 50px;
            background-color: #d35400;
            position: fixed;
            top: 60px;
            left: 0;
            bottom: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 20px;
            gap: 25px;
            z-index: 999;
        }

        .sidebar-item {
            color: white;
            font-size: 20px;
            text-decoration: none;
            cursor: pointer;
            opacity: 0.8;
            transition: opacity 0.2s;
        }

        .sidebar-item:hover {
            opacity: 1;
        }

        /* 右側主要內容區 */
        main {
            margin-left: 50px;
            flex: 1;
            padding: 30px;
            display: flex;
            justify-content: center;
        }

        .content-container {
            width: 100%;
            max-width: 1100px;
        }

        /* 公告欄 */
        .announcement-box {
            background: white;
            border: 1px solid #e5e5e5;
            border-radius: 4px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .announcement-box h2 {
            font-size: 16px;
            color: #333;
            margin-bottom: 5px;
        }

        .announcement-meta {
            font-size: 12px;
            color: #777;
            margin-bottom: 15px;
        }

        .announcement-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            margin-top: 10px;
        }

        .announcement-table th,
        .announcement-table td {
            border: 1px solid #e5e5e5;
            padding: 10px;
            text-align: left;
        }

        .announcement-table th {
            background-color: #f8f9fa;
            font-weight: 600;
        }

        /* 搜尋框 */
        .search-section {
            display: flex;
            justify-content: center;
            margin: 30px 0;
        }

        .search-box {
            display: flex;
            width: 100%;
            max-width: 400px;
        }

        .search-box input {
            flex: 1;
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-right: none;
            border-radius: 4px 0 0 4px;
            outline: none;
        }

        .search-box button {
            background-color: #e67e22;
            color: white;
            border: none;
            padding: 0 15px;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
        }

        /* 課程列表區 */
        .section-title {
            font-size: 22px;
            font-weight: 500;
            margin-bottom: 20px;
            color: #333;
        }

        .course-list {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        /* 橫向課程卡片 */
        .course-card {
            background: white;
            border: 1px solid #e5e5e5;
            border-radius: 4px;
            display: flex;
            overflow: hidden;
            background-color: #fff;
        }

        .course-image {
            width: 280px;
            height: 160px;
            background-color: #bdc3c7;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .course-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .course-image .placeholder-icon {
            font-size: 60px;
            color: white;
        }

        .course-info {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .course-name {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            text-decoration: none;
        }

        .course-name:hover {
            color: #e67e22;
        }

        .course-teacher {
            font-size: 12px;
            color: #777;
            background: #f1f2f6;
            padding: 3px 8px;
            border-radius: 3px;
            display: inline-block;
            margin-top: 8px;
        }

        .btn-enter {
            background-color: #e67e22;
            color: white;
            text-decoration: none;
            padding: 8px 16px;
            font-size: 13px;
            border-radius: 4px;
            font-weight: bold;
            align-self: flex-start;
            transition: background 0.2s;
        }

        .btn-enter:hover {
            background-color: #d35400;
        }
    </style>
</head>

<body>

    <header>
        <div class="header-container">
            <div class="header-left">
                <a href="index.php">
                    <img src="/vtc/image/logo-default.png" alt="VTC logo">
                </a>
                <ul class="main-nav">
                    <li><a href="#" style="color:#333;">My courses <span class="badge-orange">23</span></a></li>
                    <li><a href="#">eLearning Resources ▾</a></li>
                    <li><a href="#">IT Resources ▾</a></li>
                    <li><a href="#">Support ▾</a></li>
                    <li><a href="#">VTC Search</a></li>
                    <li><a href="#">ENGLISH ▾</a></li>
                </ul>
            </div>
            <div class="header-right">
                <span>🔔</span>
                <span>💬</span>
                <div class="user-profile">
                    <strong style="color: #333;"><?php echo htmlspecialchars($_SESSION['student_user']); ?></strong>
                    <div class="avatar">
                        <div style="width:100%; height:100%; background:#7f8c8d;"></div>
                    </div>
                    <a href="student_logout.php" class="logout-btn">Log out</a>
                </div>
            </div>
    </header>