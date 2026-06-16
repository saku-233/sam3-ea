<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
include 'studenthome_header.php';

$currentUser = $_SESSION['student_user'] ?? '';

try {
$conn = @new mysqli('127.0.0.1', 'root', '', 'my_online_system_db');
    if ($conn && $conn->connect_error) {
        $conn = null;
    } else {
        $conn->set_charset('utf8mb4');
    }
} catch (Exception $e) {
    $conn = null;
}
?>

<body>

    <div class="wrapper">

        <aside class="sidebar">
            <a class="sidebar-item">🕒</a>
            <a class="sidebar-item">🎓</a>
            <a class="sidebar-item">📊</a>
            <a class="sidebar-item">📅</a>
        </aside>

        <main>
            <div class="content-container">

                <div class="announcement-box">
                    <h2>Moodle AY2025/26 Updates:</h2>
                    <div class="announcement-meta">by Admin User - Thursday, 4 September 2025, 2:58 PM</div>

                    <table class="announcement-table">
                        <thead>
                            <tr>
                                <th>Moodle Plugins / Integration</th>
                                <th>Moodle Plugins in AY2024/25</th>
                                <th>Substitute Solution for AY2025/26</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Anti-plagiarism Detection</td>
                                <td>Turnitin</td>
                                <td>VeriGuide</td>
                            </tr>
                            <tr>
                                <td>Learning Analytics</td>
                                <td>IntelliBoard</td>
                                <td>Moodle's built-in analytics features</td>
                            </tr>
                            <tr>
                                <td>MS Teams Integration</td>
                                <td>MS Teams Classroom and MS Teams Notification</td>
                                <td>Create MS Teams Classrooms directly in MS Teams</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="search-section">
                    <div class="search-box">
                        <input type="text" placeholder="Search courses">
                        <button>🔍</button>
                    </div>
                </div>

                <h1 class="section-title">My courses</h1>

                <div class="course-list">

                    <?php
                    // 1. 撰寫 SQL 查詢：撈取當前登入學生的所有選修科目
                    // 💡 註：請確保在此程式碼之前，頁面頂端已建立了 $conn 連線，且 $currentUser 變數已取得 $_SESSION['student_user']
                    $sql = "SELECT s.subject_id, s.subject_name, s.teacher_name, s.bg_color, s.short_name 
            FROM student_subjects ss
            JOIN subjects s ON ss.subject_id = s.subject_id
            WHERE ss.student_email = ?";

                    // If DB connection is available, query; otherwise show a friendly message
                    if ($conn) {
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("s", $currentUser);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        // 2. 檢查是否有撈到課程資料
                        if ($result->num_rows > 0):
                            while ($row = $result->fetch_assoc()):
                                // 🔗 完全動態化連結：將該科目的 ID (如 DCD3303 或 ITE4103) 綁定到網址參數
                                $course_url = "course.php?id=" . urlencode($row['subject_id']);
                    ?>
                                <div class="course-card">
                                    <div class="course-image">
                                        <?php if (!empty($row['bg_color']) && !empty($row['short_name'])): ?>
                                            <div style="width:100%; height:100%; background:<?php echo htmlspecialchars($row['bg_color']); ?>; display:flex; align-items:center; justify-content:center; color:white; font-weight:bold; font-size:24px; text-align:center; box-sizing:border-box; padding:10px;">
                                                <?php echo htmlspecialchars($row['short_name']); ?>
                                            </div>
                                        <?php else: ?>
                                            <span class="placeholder-icon">🎓</span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="course-info">
                                        <div>
                                            <a href="<?php echo $course_url; ?>" class="course-name">
                                                <?php echo htmlspecialchars($row['subject_id'] . '( ' . $row['subject_name'] . ' ) by ' . $row['teacher_name']); ?>
                                            </a>
                                            <br>
                                            <span class="course-teacher">Teacher: <?php echo htmlspecialchars($row['teacher_name']); ?></span>
                                        </div>
                                        <a href="<?php echo $course_url; ?>" class="btn-enter">Enter this course</a>
                                    </div>
                                </div>
                            <?php
                            endwhile;
                        else:
                            ?>
                            <p style="padding: 20px; color: #7f8c8d; font-size: 14px;">目前沒有選修任何科目。</p>
                        <?php
                        endif;
                        $stmt->close();
                    } else {
                        // DB not connected — show placeholder message
                        ?>
                        <p style="padding: 20px; color: #7f8c8d; font-size: 14px;">無法連接資料庫，暫時無法顯示課程清單。</p>
                    <?php
                    }
                    ?>

                </div>
            </div>
        </main>
    </div>

    <?php include 'footer.php'; ?>

</body>

</html>
