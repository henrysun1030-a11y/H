<?php
    // 1. 移除 session_start(); 
    // 因為這支檔案是透過 index.php 引入的，主程式已經執行過 session_start 了

    // 2. 清空所有 Session 變數
    session_unset();

    // 3. 徹底銷毀伺服器端的 Session 檔案
    session_destroy();

    // 4. 清除瀏覽器端的 Session Cookie (選用，這能讓登出更徹底)
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // 5. 重新導向回首頁的路由
    header("Location: index.php?route=home");
    exit();
?>