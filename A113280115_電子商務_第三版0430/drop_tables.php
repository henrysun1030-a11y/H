<?php
	// 資料庫主機 相關資訊 port 3306
   	$db_host = "shopsql.cgtxo6mi1lhh.us-east-1.rds.amazonaws.com"; // ip address 或 host name
    $db_username= "admin";
    $db_password = "12345678";
    $db_name = "shopsql"; 

    $connect = new mysqli($db_host, $db_username, $db_password, $db_name);

    if ($connect->connect_errno) {
        die("資料庫連線失敗：" . $connect->connect_error);
    }

    $connect->set_charset("utf8mb4");

    $sql = "
        DROP TABLE IF EXISTS order_items;
        DROP TABLE IF EXISTS orders;
        DROP TABLE IF EXISTS cart_items;
        DROP TABLE IF EXISTS carts;
        DROP TABLE IF EXISTS products;
        DROP TABLE IF EXISTS members;
    ";

    if ($connect->multi_query($sql)) {
        while ($connect->more_results() && $connect->next_result()) {;}
        echo "<br><br><h2 align='center'>All tables dropped successfully. </h2><br><br>";
    } else {
        echo "Error: " . $connect->error;
    }

    $connect->close();

?>