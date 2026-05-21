<?php

    $db_host = "shopsql.cgtxo6mi1lhh.us-east-1.rds.amazonaws.com";
    $db_username = "admin";
    $db_password = "12345678";

	$connect = new mysqli($db_host, $db_username, $db_password);

    echo "<br><br><div style='border:2px solid green; width:50%; margin:auto; padding:20px;'>";

	if ($connect->connect_errno) {
		die("RDS 伺服器連線失敗：" . $connect->connect_error);
	} else {
       echo "<br><br><center>成功連線到 RDS 伺服器</center>\n";
    }

	// 建立資料庫, CHARACTER SET utf8mb4 是 預設字元集為 utf8mb4
	$sql_db = "CREATE DATABASE IF NOT EXISTS shopsql 
	           CHARACTER SET utf8mb4";

	if (!$connect->query($sql_db)) {
		die("建立資料庫錯誤：" . $connect->error);
	} else {
       echo "<br><center><font color='blue'>資料庫 shopsql 建立成功</font></center>\n";
    }
	
	$connect->select_db("shopsql");
	$connect->set_charset("utf8mb4"); // 確保資料庫正確處理中文或特殊符號
	
    // 建立表格
    $sql_create = "
            CREATE TABLE IF NOT EXISTS members (
            id INT AUTO_INCREMENT PRIMARY KEY,
            account VARCHAR(50) NOT NULL UNIQUE,
            passwd VARCHAR(255) NOT NULL,
            name VARCHAR(50),
            phone VARCHAR(20),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        );    
    ";

    if (!$connect->query($sql_create)) {
        die("建立資料表錯誤：" . $connect->error);
    } else {
       echo "<br><center>會員資料表 members, 新增成功</center>\n";
    }

    // 輸入會員資料 for 登入測試用	
	$stmt = $connect->prepare("INSERT INTO members (account, passwd, name, phone) VALUES (?, ?, ?, ?)");

	$stmt->bind_param("ssss", $account, $passwd, $name, $phone);

	// 第一筆會員資料 
	$account = "wang@gmail.com";
	$passwd = "wang1234";
	$name = "王大明";
	$phone = "0922-123-456";

	if (!$stmt->execute()) {
		echo "新增王大明資料錯誤：" . $stmt->error;
	} else {
		echo "<br><center><font color='green'>新增會員資料 王大明成功</font></center>";
	}

	// 第二筆會員資料 
	$account = "lin@gmail.com";
    $passwd = "lin12345";
    $name = "林小真";
    $phone = "0933-123-456";
	
	if (!$stmt->execute()) {
        echo "新增林小真資料錯誤：" . $stmt->error;
    } else {
         echo "<br><center><font color='red'>新增會員資料 林小真成功</font></center>";
    }
	  
    $stmt->close();
	
	$result = $connect->query("SELECT COUNT(*) as total FROM members");
	$row = $result->fetch_assoc();
	echo "<br><h2 align='center'>目前會員數量：" . $row['total'] . "</h2><br><br>";
    echo "</div>";

    $connect->close();
?>