<?php 
include '../cas/cas_head.php';

// 1. 安全檢查：確保是已登入的職員，否則踢回 CAS 登入頁
if (!isset($_SESSION['staff_logged_in']) || $_SESSION['staff_logged_in'] !== true) {
    header("Location: ../cas/cas_login.php");
    exit();
}

$currentStaff = $_SESSION['staff_email'] ?? '';
if ($currentStaff === '') {
    header("Location: ../cas/cas_login.php");
    exit();
}

$host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'your_database_name';

$conn = new mysqli($host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("資料庫連線失敗: " . $conn->connect_error);
}

$sql = "SELECT date, status FROM attendance WHERE staff_email = ? ORDER BY date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $currentStaff);
$stmt->execute();
$result = $stmt->get_result();

$total_salary = 0; 
?>
<body> 
    <h1>staff attendance</h1>

    <a href="../cas/cas_index.php">回到首頁</a>
    <a href="../cas/attendance.php">考勤管理頁面</a>
    <p>這裡是員工考勤頁面</p>
    <p>這裡會顯示員工的考勤記錄，並提供相關功能，如打卡、請假等。</p>
    
    <h2>考勤記錄 (帳號: <?php echo htmlspecialchars($currentStaff); ?>)</h2>
    <table border="1" cellpadding="8" style="border-collapse: collapse; text-align: center;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th>日期</th>
                <th>狀態</th>
                <th>人工變動</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if ($result->num_rows > 0): 
                while ($record = $result->fetch_assoc()): 
                    switch ($record['status']) {
                        case '出勤':
                            $salary_text = '+100';
                            $salary_value = 100;
                            $color = 'green';
                            break;
                        case '請假':
                            $salary_text = '+0';
                            $salary_value = 0;
                            $color = 'gray';
                            break;
                        case '遲到':
                            $salary_text = '-100';
                            $salary_value = -100;
                            $color = 'red';
                            break;
                        default:
                            $salary_text = '無';
                            $salary_value = 0;
                            $color = 'black';
                    }
                    
                    $total_salary += $salary_value;
            ?>
                <tr>
                    <td><?php echo htmlspecialchars($record['date']); ?></td>
                    <td><?php echo htmlspecialchars($record['status']); ?></td>
                    <td style="color: <?php echo $color; ?>; font-weight: bold;">
                        <?php echo $salary_text; ?>
                    </td> 
                </tr>
            <?php 
                endwhile; 
            else: 
            ?>
                <tr>
                    <td colspan="3">目前沒有任何考勤紀錄。</td>
                </tr>
            <?php endif; ?>
        </tbody>
        
        <?php if ($result->num_rows > 0): ?>
        <tfoot>
            <tr style="background-color: #e6f7ff; font-weight: bold;">
                <td colspan="2" style="text-align: right;">當月人工總計：</td>
                <td style="color: <?php echo $total_salary >= 0 ? 'green' : 'red'; ?>;">
                    <?php echo ($total_salary >= 0 ? '+' : '') . $total_salary; ?>
                </td>
            </tr>
        </tfoot>
        <?php endif; ?>
    </table>

    <?php
    $stmt->close();
    $conn->close();
    ?>
</body>
</html>