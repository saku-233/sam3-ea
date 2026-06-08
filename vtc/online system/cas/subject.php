<?php include 'cas_head.php';

$currentUser = $_SESSION['staff_email'] ?? '';
if (empty($currentUser)) {
    header('Location: cas_login.php');
    exit();
}

$host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'your_database_name'; // 改成你的資料庫名稱!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

$conn = new mysqli($host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("資料庫連線失敗: " . $conn->connect_error);
}

$sql = "SELECT s.subject_id, s.subject_name 
        FROM student_subjects ss
        JOIN subjects s ON ss.subject_id = s.subject_id
        WHERE ss.student_email = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $currentUser);
$stmt->execute();
$result = $stmt->get_result();
?>
<body>
    <h1>subject</h1>
    <p>這裡是 CAS 的subject頁面</p>
    <ul>
        <li><a href="cas_index.php">回到首頁</a></li>
    </ul>

    <h2>科目列表</h2>
    <ul>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<li><a href="course.php?id=' . htmlspecialchars($row['subject_id']) . '">' 
                     . htmlspecialchars($row['subject_id']) . ' - ' . htmlspecialchars($row['subject_name']) . 
                     '</a></li>';
            }
        } else {
            echo '<li>目前沒有修讀任何科目。</li>';
        }
        
        $stmt->close();
        $conn->close();
        ?>
    </ul>
</body>
</html>