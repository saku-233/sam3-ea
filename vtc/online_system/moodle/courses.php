<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

// 1. 安全檢查：確保學生已登入
if (!isset($_SESSION['student_user'])) {
    header("Location: index.php");
    exit();
}

// 2. 獲取網址傳過來的課程 ID (例如: course.php?id=DCD3303)
$subject_id = $_GET['id'] ?? '';

if (empty($subject_id)) {
    die("未指定的課程 ID。");
}

// 3. 資料庫連線
$conn = new mysqli('localhost', 'root', '', 'your_database_name'); // 👈 請修改為你的資料庫名稱
if ($conn->connect_error) { die("連線失敗: " . $conn->connect_error); }
$conn->set_charset("utf8mb4");

--撈取該科目的名稱與講師
$sub_sql = "SELECT * FROM subjects WHERE subject_id = ?";
$stmt = $conn->prepare($sub_sql);
$stmt->bind_param("s", $subject_id);
$stmt->execute();
$subject = $stmt->get_result()->fetch_assoc();

if (!$subject) {
    die("找不到該課程資料。");
}
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($subject['subject_id']); ?> - Moodle</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; }
        body { display: flex; background-color: #f8f9fa; min-height: 100vh; color: #333; }

        /* 左側導覽列 Sidebar */
        .sidebar { width: 240px; background-color: #ffffff; border-right: 1px solid #e2e8f0; padding: 20px 15px; flex-shrink: 0; }
        .sidebar h3 { font-size: 14px; color: #718096; margin-bottom: 15px; text-transform: uppercase; letter-spacing: 0.5px; }
        .sidebar ul { list-style: none; }
        .sidebar ul li { margin-bottom: 8px; }
        .sidebar ul li a { display: block; padding: 10px 12px; color: #4a5568; text-decoration: none; font-size: 13px; border-radius: 6px; transition: 0.2s; }
        .sidebar ul li a:hover { background-color: #edf2f7; color: #1a0dab; }
        .sidebar ul li a.active { background-color: #ebf8ff; color: #2b6cb0; font-weight: bold; }

        /* 右側主要內容包裝盒 */
        .main-wrapper { flex-grow: 1; display: flex; flex-direction: column; overflow-x: hidden; }

        /* 頂部 Moodle 藍色漸層 Banner */
        .course-banner {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
            padding: 40px 50px;
            position: relative;
        }
        .course-banner h1 { font-size: 26px; font-weight: 500; margin-bottom: 15px; }
        .breadcrumbs { font-size: 13px; color: #bfdbfe; }
        .breadcrumbs a { color: #ffffff; text-decoration: none; }
        .breadcrumbs a:hover { text-decoration: underline; }

        /* 主內容排版區 */
        .content-container { padding: 30px 50px; max-width: 1100px; width: 100%; }

        /* 大章節區塊 (General, Group A...) */
        .section-block { background: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; margin-bottom: 25px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        .section-header { background-color: #f8fafc; padding: 15px 20px; font-size: 15px; font-weight: bold; color: #1e293b; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; gap: 10px; }
        .section-header::before { content: "▼"; font-size: 10px; color: #94a3b8; }
        .section-body { padding: 20px; }

        /* 課程項目列 (作業、公告) */
        .item-row { display: flex; align-items: flex-start; gap: 15px; padding: 15px 0; border-bottom: 1px solid #f1f5f9; }
        .item-row:last-child { border-bottom: none; }
        .item-icon { font-size: 20px; margin-top: 2px; }
        .item-details { flex-grow: 1; }
        .item-title { font-size: 14px; font-weight: 600; color: #2563eb; cursor: pointer; text-decoration: none; }
        .item-title:hover { text-decoration: underline; }
        .item-desc { font-size: 13px; color: #64748b; margin-top: 5px; white-space: pre-line; line-height: 1.6; }
        .item-dates { font-size: 11px; color: #94a3b8; margin-top: 8px; background: #f8fafc; padding: 6px 10px; border-radius: 4px; display: inline-block; }

        /* 狀態標籤 */
        .icon-announcement { color: #f59e0b; }
        .icon-assignment { color: #ef4444; }
    </style>
</head>
<body>

    <div class="sidebar">
        <h3>Navigation</h3>
        <ul>
            <li><a href="studenthome.php">🏠 Dashboard</a></li>
            <li><a href="studenthome.php">📅 Site pages</a></li>
            <li><a href="#" class="active">📚 My courses</a></li>
            <li style="padding-left: 15px;"><a href="#" style="font-size:12px; color:#2563eb;">👉 <?php echo htmlspecialchars($subject['subject_id']); ?></a></li>
        </ul>
    </div>

    <div class="main-wrapper">
        
        <div class="course-banner">
            <h1><?php echo htmlspecialchars($subject['subject_id'] . ' - ' . $subject['subject_name']); ?></h1>
            <div class="breadcrumbs">
                <a href="studenthome.php">Home</a> ＞ <a href="#">My courses</a> ＞ <?php echo htmlspecialchars($subject['subject_id']); ?>
            </div>
        </div>

        <div class="content-container">
            <?php
            // 撈取該科目的所有章節
            $sec_sql = "SELECT * FROM course_contents WHERE subject_id = ? ORDER BY sort_order ASC";
            $sec_stmt = $conn->prepare($sec_sql);
            $sec_stmt->bind_param("s", $subject_id);
            $sec_stmt->execute();
            $sections = $sec_stmt->get_result();

            if ($sections->num_rows > 0):
                while ($section = $sections->fetch_assoc()):
            ?>
                <div class="section-block">
                    <div class="section-header">
                        <?php echo htmlspecialchars($section['section_title']); ?>
                    </div>
                    <div class="section-body">
                        <?php
                        // 撈取該章節內部的所有項目 (公告或作業)
                        $item_sql = "SELECT * FROM course_items WHERE content_id = ?";
                        $item_stmt = $conn->prepare($item_sql);
                        $item_stmt->bind_param("i", $section['id']);
                        $item_stmt->execute();
                        $items = $item_stmt->get_result();

                        if ($items->num_rows > 0):
                            while ($item = $items->fetch_assoc()):
                                $is_assign = ($item['item_type'] === 'assignment');
                        ?>
                            <div class="item-row">
                                <span class="item-icon <?php echo $is_assign ? 'icon-assignment' : 'icon-announcement'; ?>">
                                    <?php echo $is_assign ? '📄' : '📢'; ?>
                                </span>
                                <div class="item-details">
                                    <a href="#" class="item-title"><?php echo htmlspecialchars($item['title']); ?></a>
                                    <?php if (!empty($item['description'])): ?>
                                        <div class="item-desc"><?php echo htmlspecialchars($item['description']); ?></div>
                                    <?php 
                                    endif; 
                                    if ($is_assign && !empty($item['open_date'])):
                                    ?>
                                        <div class="item-dates">
                                            🟢 <strong>Opened:</strong> <?php echo htmlspecialchars($item['open_date']); ?> <br>
                                            🔴 <strong>Due:</strong> <?php echo htmlspecialchars($item['due_date']); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php 
                            endwhile;
                        else:
                            echo '<p style="color:#aaa; font-size:13px;">此章節目前尚無內容。</p>';
                        endif;
                        $item_stmt->close();
                        ?>
                    </div>
                </div>
            <?php 
                endwhile;
            else:
                echo '<div class="section-block" style="padding:20px; text-align:center; color:#94a3b8;">此課程尚未建立任何教學章節。</div>';
            endif;
            
            $sec_stmt->close();
            $conn->close();
            ?>
        </div>
    </div>

</body>
</html>