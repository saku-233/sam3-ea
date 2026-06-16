-- 1. 建立職員基本資料表
CREATE TABLE IF NOT EXISTS `staffs` (
  `staff_id` VARCHAR(20) NOT NULL COMMENT '職員編號(主鍵)',
  `name` VARCHAR(100) NOT NULL COMMENT '職員姓名',
  `email` VARCHAR(100) NOT NULL UNIQUE COMMENT '職員電郵',
  `salary` DECIMAL(10, 2) NOT NULL DEFAULT 0.00 COMMENT '薪水(支援小數點後兩位)',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT '帳號建立時間',
  PRIMARY KEY (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. 建立職員考勤紀錄表（與 staffs 關聯）
CREATE TABLE IF NOT EXISTS `staff_attendance` (
  `id` INT AUTO_INCREMENT COMMENT '考勤紀錄流水號',
  `staff_id` VARCHAR(20) NOT NULL COMMENT '職員編號(外鍵)',
  `attendance_date` DATE NOT NULL COMMENT '考勤日期',
  `clock_in` TIME DEFAULT NULL COMMENT '上班打卡時間',
  `clock_out` TIME DEFAULT NULL COMMENT '下班打卡時間',
  `status` ENUM('Present', 'Absent', 'Late', 'Leave') DEFAULT 'Present' COMMENT '考勤狀態',
  PRIMARY KEY (`id`),
  -- 建立外鍵約束：如果 staffs 表裡的職員被刪除，考勤紀錄也自動刪除
  FOREIGN KEY (`staff_id`) REFERENCES `staffs`(`staff_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;