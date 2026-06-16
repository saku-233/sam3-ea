<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['staff_logged_in']) || $_SESSION['staff_logged_in'] !== true) {
    header("Location: vtc_staff_login.php");
    exit();
}

// 💡 修正 2：從 Session 精準拿到當前登入的職員帳號
$currentStaff = $_SESSION['staff_email']; 

include 'satffhome_header.php';

// 💡 修正 3：設定正確的本地資料庫連線資訊
$host = '127.0.0.1'; // 改用 127.0.0.1 避開 Socket 權限錯誤
$db_user = 'root';
$db_pass = '';
$db_name = 'vtc_db'; // 修正為你真正的資料庫名稱

$conn = new mysqli($host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("資料庫連線失敗，請確認 MySQL 是否啟動: " . $conn->connect_error);
}

// 💡 修正 4：對齊你在 vtc_db 裡面建立的 staffs 資料表欄位 (staff_id / staffs)
$sql = "SELECT attendance_date AS date, status FROM staff_attendance WHERE staff_id = (SELECT staff_id FROM staffs WHERE email = ?) ORDER BY attendance_date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $currentStaff);
$stmt->execute();
$result = $stmt->get_result();

$total_salary = 0; 
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <title>Staff Attendance</title>
</head>
<body> 
    <h1>Staff Attendance</h1>

    <a href="staffsystem_index.php">回到首頁</a> | 
    <a href="staffattendance.php">重新整理考勤</a>
    <hr>
    
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
                    // 支援英文與中文的狀態判定
                    switch ($record['status']) {
                        case 'Present':
                        case '出勤':
                            $salary_text = '+100';
                            $salary_value = 100;
                            $color = 'green';
                            break;
                        case 'Leave':
                        case '請假':
                            $salary_text = '+0';
                            $salary_value = 0;
                            $color = 'gray';
                            break;
                        case 'Late':
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