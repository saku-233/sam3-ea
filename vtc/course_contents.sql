-- 建立科目章節與內容表
CREATE TABLE `course_contents` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `subject_id` VARCHAR(20) NOT NULL,
    `section_title` VARCHAR(100) NOT NULL, -- 例如: General, Group A - Jan ~ Feb...
    `sort_order` INT DEFAULT 0
);

-- 建立作業/公告項目表
CREATE TABLE `course_items` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `content_id` INT NOT NULL,
    `item_type` ENUM('announcement', 'assignment') NOT NULL,
    `title` VARCHAR(250) NOT NULL,        -- 例如: GROUP A: CA1 - Zentangle Drawing
    `description` TEXT,                   -- 作業要求細項
    `open_date` VARCHAR(100),
    `due_date` VARCHAR(100)
);

-- 🚀 插入迎合你截圖的 Moodle 測試資料
INSERT INTO `course_contents` (`id`, `subject_id`, `section_title`, `sort_order`) VALUES 
(1, 'DCD3303', 'General', 1),
(2, 'DCD3303', 'Group A - Jan ~ Feb (week 20-24) Assignment Submissions', 2);

INSERT INTO `course_items` (`content_id`, `item_type`, `title`, `description`, `open_date`, `due_date`) VALUES 
(1, 'announcement', 'Announcements', 'Please check here for latest class updates.', NULL, NULL),
(1, 'announcement', 'Module Brief and Schedule', 'Please read through the brief carefully!', NULL, NULL),
(2, 'assignment', 'GROUP A: CA1 - Zentangle Drawing', '1. Image in jpeg/gif format\n2. Resolution: FHD - 1920 x 1080 pixels\n3. ONE Image only', 'Sunday, 15 January 2026, 9:00 AM', 'Saturday, 24 January 2026, 9:00 AM'),
(2, 'assignment', 'GROUP A: CA2 - Stencil Art', '1. Image in jpeg/gif format\n2. At least THREE kinds of stencil...', 'Sunday, 15 January 2026, 9:00 AM', 'Saturday, 31 January 2026, 9:00 AM');