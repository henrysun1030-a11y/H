<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$route = $_GET['route'] ?? 'home';

// --- 🔥 修正點：登出邏輯必須在 header.php 出現之前執行 ---
if ($route === 'logout') {
    require 'app/logout.php'; // 執行清空與跳轉
    exit(); // 確保後面的 HTML 不會被執行
}
// ---------------------------------------------------

// 載入畫面部分
require 'app/header.php';

switch ($route) {
    case 'login':    require 'app/login.php';    break;
    case 'register': require 'app/register.php'; break;
    case 'drink':   require 'app/drink.php';   break;
    case 'super':     require 'app/super.php';     break;
    case 'sweet':      require 'app/sweet.php';      break;
    default:         require 'app/main.php';
}

require 'app/footer.php';
?>