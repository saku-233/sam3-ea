PHP
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../../../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../../../');
$dotenv->load();

include 'cas_head.php'; // 同資料夾，直接引入

require_once __DIR__ . '/../../vendor/autoload.php';

use Dotenv\Dotenv;
// 載入 .env 檔案（__DIR__ . '/../..' 代表往上跳兩層到專案根目錄，請依實際檔案結構調整）
$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();
// ========================================================

include 'cas_head.php';

// 3. 檢查登入狀態
$currentUser = $_SESSION['student_email'] ?? $_SESSION['staff_email'] ?? '';

if (empty($currentUser)) {
    header('Location: cas_login.php');
    exit();
}

// ========================================================
// ⭐ 關鍵修改點 B：將原本寫死的設定改為從 $_ENV 讀取
// ========================================================
$host    = $_ENV['DB_HOST'];
$db_user = $_ENV['DB_USER'];
$db_pass = $_ENV['DB_PASS'];
$db_name = $_ENV['DB_NAME']; // 完美對接你的 .env 變數！
// ========================================================

// 建立連線
$conn = new mysqli($host, $db_user, $db_pass, $db_name);

// 檢查連線是否失敗
if ($conn->connect_error) {
    die("<h2 style='color:red;'>資料庫連線失敗: " . $conn->connect_error . "</h2>");
}

// 5. 根據你的資料庫設計調整 SQL 查詢
$sql = "SELECT s.subject_id, s.subject_name 
        FROM student_subjects ss
        JOIN subjects s ON ss.subject_id = s.subject_id
        WHERE ss.student_email = ?";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("<h2 style='color:red;'>SQL 語法準備失敗: " . $conn->error . "</h2>");
}

$stmt->bind_param("s", $currentUser);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="zh-Hant">

<head>
    <meta charset="UTF-8">
    <title>Subject - CAS</title>
</head>

<body>
    <h1>Subject</h1>
    <p>這裡是 CAS 的 subject 頁面</p>
    <p>目前登入帳號：<strong><?php echo htmlspecialchars($currentUser, ENT_QUOTES, 'UTF-8'); ?></strong></p>

    <ul>
        <li><a href="cas_index.php">回到首頁</a></li>
    </ul>

    <h2>科目列表</h2>
    <ul>
        <?php
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<li><a href="course.php?id=' . htmlspecialchars($row['subject_id'], ENT_QUOTES, 'UTF-8') . '">'
                    . htmlspecialchars($row['subject_id'], ENT_QUOTES, 'UTF-8') . ' - '
                    . htmlspecialchars($row['subject_name'], ENT_QUOTES, 'UTF-8') .
                    '</a></li>';
            }
        } else {
            echo '<li>目前沒有修讀 any 科目（或查無此帳號的修課紀錄）。</li>';
        }

        $stmt->close();
        $conn->close();
        ?>
    </ul>
</body>

</html>