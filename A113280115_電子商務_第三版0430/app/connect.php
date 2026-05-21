<?php
    $db_host = "shopsql.cgtxo6mi1lhh.us-east-1.rds.amazonaws.com";
    $db_username = "admin";
    $db_password = "12345678";
    $db_name = "shopsql";

    // $connect 是 mysqli 物件
    $connect = new mysqli($db_host, $db_username, $db_password, $db_name);

    if ($connect->connect_errno) {
        die("資料庫連線失敗：" . $connect->connect_error);
    }

    $connect->set_charset("utf8mb4"); // 確保資料庫正確處理中文或特殊符號
?>

	
	
