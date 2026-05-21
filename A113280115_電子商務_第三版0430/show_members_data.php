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

	// ===== 檢查是否有 members 資料表 =====
	$table_check = $connect->query("SHOW TABLES LIKE 'members'");

	if ($table_check->num_rows == 0) {
		echo "<br><br><h2 align='center'>尚未建立 members 資料表</h2>";
		$connect->close();
		exit;
	}
	// =============================


    // 查詢會員資料
    $sql = "SELECT id, account, name, phone, created_at FROM members";
    $result = $connect->query($sql); // $result 是 mysqli_result 物件

    if (!$result) {
        die("查詢錯誤：" . $connect->error);
    }

    // 將查詢到的所有會員資料, 都顯示出來
    echo "<style>
            .member-table{
                width:500px;
                margin:auto;
                border-collapse:collapse;
            }
            .member-table th,
            .member-table td{
                border:1px solid red;
                padding:8px;
                text-align:center;
            }
        </style>";
    
    echo "<br><br><div style='border: 2px solid green; width:50%; margin:auto;'><br><br>";
    echo "<h2 align='center'>會員列表</h2>";
    echo "<table class='member-table'>";
    echo "<tr>
            <th>ID</th>
            <th>帳號</th>
            <th>姓名</th>
            <th>電話</th>
            <th>建立時間</th>
          </tr>";
		  
	// fetch_assoc() 取得一行結果, fetch_array() (取得陣列/關聯)、mysqli_fetch_row() (取得索引陣列)、mysqli_fetch_object() (取得物件)
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['account']}</td>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['phone']}</td>";
            echo "<td>{$row['created_at']}</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>尚無會員資料</td></tr>";
    }
    
    echo "</table><br><br>";
	
	$result = $connect->query("SELECT COUNT(*) as total FROM members");
	$row = $result->fetch_assoc();
	echo "<h2 align='center'>目前會員數量：" . $row['total'] . "</h2><br><br>";
    echo "</div>";

	$result->free(); // 釋放記憶體資源
 
    $connect->close();
?>