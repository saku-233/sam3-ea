<?php
// 1. 引入 Composer 的自動載入器
require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;
use Aws\S3\S3Client; // 如果需要連線 AWS S3

// 2. 載入 .env 檔案中的變數
// 假設 .env 放在目前目錄的上一層或最外層根目錄，可用 __DIR__ . '/..' 調整路徑
$dotenv = Dotenv::createImmutable(__DIR__ . '/../'); 
$dotenv->load();

// ==========================================
# 連結 Local MySQL 資料庫
# ==========================================
$db_host = $_ENV['DB_HOST'];
$db_user = $_ENV['DB_USER'];
$db_pass = $_ENV['DB_PASS'];
$db_name = $_ENV['DB_NAME'];

// 啟用 MySQLi 擴充功能連線
$conn = @mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("❌ 串接 Local 資料庫失敗: " . mysqli_connect_error());
}

// ==========================================
# 初始化 AWS 服務連線 (以 S3 為例)
# ==========================================
// 必須先經由 composer require aws/aws-sdk-php 安裝 SDK 才能使用此類別
try {
    $s3Client = new S3Client([
        'version'     => 'latest',
        'region'      => $_ENV['AWS_REGION'],
        'credentials' => [
            'key'    => $_ENV['AWS_ACCESS_KEY_ID'],
            'secret' => $_ENV['AWS_SECRET_ACCESS_KEY'],
        ],
    ]);
} catch (Exception $e) {
    // 即使 AWS 連線失敗，地端網頁仍能運作的防錯提示
    error_log("AWS SDK 初始化失敗: " . $e->getMessage());
}
?>