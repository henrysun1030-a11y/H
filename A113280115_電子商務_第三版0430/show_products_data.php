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

    // ===== 檢查是否有 products 資料表 =====
	$table_check = $connect->query("SHOW TABLES LIKE 'products'");

	if ($table_check->num_rows == 0) {
		echo "<br><br><h2 align='center'>尚未建立 products 資料表</h2>";
		$connect->close();
		exit;
	}
	// =============================
	

    // ====== 表格美化 ============
    echo "<style>
        .product-table{
            width:600px;
            margin:auto;
            border-collapse:collapse;
        }
        .product-table th,
        .product-table td{
            border:1px solid red;
            padding:8px;
            text-align:center;
        }
    </style>";

    // ==== 定義共用的 function
    function showProducts($connect, $brand){

        // 查詢指定品牌產品
        $sql = "SELECT product_id, name, price, outline, image, qty, updated_at 
                FROM products WHERE brand='$brand'";
    
        $result = $connect->query($sql);
        if (!$result) {
            die("查詢錯誤：" . $connect->error);
        }
    
        echo "<br><br><div style='border: 2px solid green; width:50%; margin:auto;'><br><br>";
        echo "<h2 style='text-align:center;'>目前資料庫中, {$brand} 的產品列表</h2>";
        echo "<table class='product-table'>";
        echo "<tr>
                <th>產品編碼</th>
                <th>產品名稱</th>
                <th>產品價格</th>
                <th>產品描述</th>
                <th>產品圖示</th>
                <th>現有庫存</th>
                <th>最後異動時間</th>
              </tr>";
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) { 
                echo "<tr>";
                echo "<td>{$row['product_id']}</td>";
                echo "<td>{$row['name']}</td>";
                echo "<td>NT$ " . number_format($row['price']) . "</td>";
                echo "<td>{$row['outline']}</td>";
                echo "<td><img src='{$row['image']}' width='80'></td>";
                echo "<td>{$row['qty']}</td>";
                echo "<td>{$row['updated_at']}</td>";
                echo "</tr>";
            }   
        } else {  
            echo "<tr><td colspan='7'>尚無{$brand}產品資料</td></tr>"; 
        }    
        echo "</table><br><br>";
    
        // 小計品牌產品數量
        $total = $result->num_rows;
        echo "<h2 style='text-align:center;'>目前共有 {$total} 種 {$brand} 產品</h2>";
        echo "</div>";
    
        // 釋放記憶體資源
        $result->free();
    }

    showProducts($connect, "super");
    showProducts($connect, "drink");
    showProducts($connect, "sweet");
 
    $connect->close();
?>