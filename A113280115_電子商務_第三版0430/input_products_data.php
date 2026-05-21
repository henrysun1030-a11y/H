<?php

    $db_host = "shopsql.cgtxo6mi1lhh.us-east-1.rds.amazonaws.com";
    $db_username = "admin";
    $db_password = "12345678";

	$connect = new mysqli($db_host, $db_username, $db_password);

    echo "<br><br><div style='border:2px solid green; width:50%; margin:auto; padding:20px;'>";

	if ($connect->connect_errno) {
		die("RDS 伺服器連線失敗：" . $connect->connect_error);
	} else {
       echo "<p style='text-align:center;color:green;'>成功連線到 RDS 伺服器</p><br>";
    }

	// 建立資料庫
	$sql_db = "CREATE DATABASE IF NOT EXISTS shopsql CHARACTER SET utf8mb4";

	if (!$connect->query($sql_db)) {
		die("建立資料庫錯誤：" . $connect->error);
	} else {
       echo "<br><center><font color='blue'>資料庫 shopsql 建立成功</font></center>\n";
    }
	
	$connect->select_db("shopsql");
	$connect->set_charset("utf8mb4");
	
    // 建立產品資料表
    $sql_create = "
            CREATE TABLE IF NOT EXISTS products (
            id INT AUTO_INCREMENT PRIMARY KEY,
            product_id VARCHAR(20) NOT NULL UNIQUE,
            name VARCHAR(100),
            price DECIMAL(10,2) NOT NULL DEFAULT 0,
            outline VARCHAR(255),
            image VARCHAR(255),
            qty int,
            brand VARCHAR(50),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        );    
    ";

    if (!$connect->query($sql_create)) {
        die("建立資料表錯誤：" . $connect->error);
    } else {
       echo "<br><center>產品資料表 products, 新增成功</center>\n";
    }

    // --- 1. 輸入 Food 產品資料 ---
	$stmt = $connect->prepare("INSERT INTO products (product_id, name, price, outline, image, qty, brand) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdssis", $p_id, $name, $price, $outline, $image, $qty, $brand);

	$p_id_array = ["2026021001", "2026021002", "2026021003", "2026021004", 
                   "2026022001", "2026022002", "2026022003", "2026022004",
                   "2026023001", "2026023002", "2026023003", "2026023004"];
                   
	$name_array = ["food 起司里肌可頌", "food 起司牛肉可頌", "food 黑松露嫩蛋", "food 烤雞生吐司", "food 舒肥雞肉蔬菜盅", "food 總匯三明治", "food 松露烤雞麵", "food 舒肥肌肉帕昵尼", "food 牛肉長堡", "food 焗烤里肌厚片", "food 抹茶起司麵", "food 煎蛋可頌"];
	$price_array = [85, 95, 95, 110, 145, 110, 185, 125, 145, 120, 160, 90];
	$outline_array = ["外酥內軟的可頌夾入里肌火腿與起司", "美味牛肉片搭配香濃起司與酥香可頌", "豐富香氣黑松露醬配上滑嫩炒蛋", "鮮嫩烤雞與人氣生吐司的完美結合", 
                    "低溫烹調嫩雞胸搭配多樣新鮮時蔬", "經典三層配料豐富的總匯三明治", "香濃松露奶油醬汁與嫩烤雞腿排", "義式壓烤帕里尼夾入鮮嫩雞肉與起司",
                    "鮮嫩牛肉片搭配韓式辣醬風味長堡", "法式風情焗烤里肌與厚片土司組合", "獨特抹茶風味醬與香濃起司義大利麵", "香酥可頌麵包夾入鮮嫩煎蛋與起司"];
    $image_array = ["image/super/1.jpg", "image/super/2.jpg", "image/super/3.jpg", "image/super/4.jpg", "image/super/5.jpg", "image/super/6.jpg",
                    "image/super/7.jpg", "image/super/8.jpg", "image/super/9.jpg", "image/super/10.jpg", "image/super/11.jpg", "image/super/12.jpg"];
    $qty_array = [120, 115, 100, 95, 80, 75, 60, 55, 40, 35, 20, 15];
    
    $brand = "super";
    for($i=0; $i<count($p_id_array); $i++){
        $p_id = $p_id_array[$i];
        $name = $name_array[$i];
        $price = $price_array[$i];
        $outline = $outline_array[$i];
        $image = $image_array[$i]; 
        $qty = $qty_array[$i]; 
        $stmt->execute();
    }
	echo "<br><h2 align='center'>成功輸入 super 產品</h2>";

    // --- 2. 輸入 New 產品資料 (星巴克飲料) ---
	$p_id_array = ["2026031001", "2026031002", "2026031003", "2026031004", "2026032001", "2026032002", "2026032003", "2026032004",
                   "2026033001", "2026033002", "2026033003", "2026033004"];
	$name_array = ["冰太妃核果那堤", "太妃核果那堤", "冰薄荷摩卡", "薄荷摩卡", "冰義式濃萃厚那堤", "義式濃萃厚那堤", "冰蘋果山茶花風味青茶", "蘋果山茶花美式", "蘋果山茶花氣泡美式", "蘋果山茶花風味青茶", "紅心芭樂冷萃咖啡", "蘋果山茶花美式"];
	$price_array = [175, 175, 160, 160, 145, 145, 135, 125, 125, 135, 145, 125];
    $outline_array = ["經典冬日限定，絲滑牛奶與甜美太妃核果香氣", "節慶必喝，濃郁咖啡與香甜核果風味完美結合", "巧克力摩卡融入清爽薄荷", "暖心薄荷風味與巧克力", "較一般那堤更濃厚的義式濃縮", "溫潤鮮奶與重烘焙濃縮咖啡", "蘋果酸甜結合山茶花清新", "迷人花香與蘋果甜潤", "清爽氣泡與花果香氣交織", "山茶花優雅香氣與甜美蘋果", "在地紅心芭樂汁與冷萃咖啡驚艷碰撞", "蘋果與山茶花的優雅演繹"];
    $image_array = ["image/drink/1.jpg", "image/drink/2.jpg", "image/drink/3.jpg", "image/drink/4.jpg", "image/drink/5.jpg", "image/drink/6.jpg",
                    "image/drink/7.jpg", "image/drink/8.jpg", "image/drink/9.jpg", "image/drink/10.jpg", "image/drink/11.jpg", "image/drink/12.jpg"];
    $qty_array = [88, 76, 95, 63, 120, 110, 45, 52, 33, 28, 15, 10];
    
    $brand = "drink";
    for($i=0; $i<count($p_id_array); $i++){
        $p_id = $p_id_array[$i];
        $name = $name_array[$i];
        $price = $price_array[$i];
        $outline = $outline_array[$i];
        $image = $image_array[$i]; 
        $qty = $qty_array[$i]; 
        $stmt->execute();
    }
	echo "<br><h2 align='center'>成功輸入 drink 產品</h2>";

    // --- 3. 輸入 Coffee 促銷產品資料 ---
    $p_id_array = ["2026025001", "2026025002", "2026025003", "2026025004", "2026035001", "2026035002", "2026035003", "2026035004",
                    "2026065001", "2026065002", "2026065003", "2026065004"];
    $name_array = ["拿鐵", "美式", "焦糖瑪奇朵", "濃縮咖啡", "卡布奇諾", "摩卡", "特選拿鐵", "復列白", "可可瑪奇朵", "冰那堤", "冷翠咖啡", "冰焦糖瑪奇朵"];
    $price_array = [120, 95, 140, 80, 120, 135, 135, 135, 140, 120, 120, 140];
    $outline_array = ["經典義式咖啡與細緻熱鮮奶的完美結合", "經典濃縮咖啡加入熱水", "融合香草風味糖漿、鮮奶與濃縮咖啡", "小杯濃厚、帶有豐富油沫的義式核心", "綿密奶泡與濃縮咖啡的優雅平衡", "濃縮咖啡結合巧克力醬與熱鮮奶", "選用特選咖啡豆調製", "精選濃縮咖啡與細緻奶泡", "巧克力與奶香交織", "清涼鮮乳與濃縮咖啡的冰飲組合", "長時間低溫萃取，口感滑順", "冰涼香甜的焦糖與鮮奶"];
    $image_array = ["image/sweet/1.jpg", "image/sweet/2.jpg", "image/sweet/3.jpg", "image/sweet/4.jpg", "image/sweet/5.jpg", "image/sweet/6.jpg",
                    "image/sweet/7.jpg", "image/sweet/8.jpg", "image/sweet/9.jpg", "image/sweet/10.jpg", "image/sweet/11.jpg", "image/sweet/12.jpg"];
    $qty_array = [45, 60, 15, 30, 25, 20, 18, 12, 22, 55, 40, 28];

    $brand = "sweet"; // 統一歸類為 coffee，避免跑去 food 類別
    for($i=0; $i<count($p_id_array); $i++){
        $p_id = $p_id_array[$i];
        $name = $name_array[$i];
        $price = $price_array[$i];
        $outline = $outline_array[$i];
        $image = $image_array[$i];
        $qty = $qty_array[$i];
        $stmt->execute();
    }
	echo "<br><h2 align='center'>成功輸入 sweet 產品</h2>";

    // --- 4. 輸入 LV 精品資料 ---
	$p_id_array = ["2026061001", "2026061002", "2026061003", "2026061004", 
                   "2026062001", "2026062002", "2026062003", "2026062004",
                   "2026063001", "2026063002", "2026063003", "2026063004"];
	$name_array = ["LV 皮革包", "LV 達芙妮包", "LV 豌豆包", "LV 化妝包", "LV 斜背包", "LV 口蓋包", "LV 提包", "LV 雙折包", "LV 斜背包", "LV 口蓋包", "LV 提包", "LV 雙折包"];
	$price_array = [16900, 74500, 15700, 35400, 27322, 17600, 9500, 8300, 23600, 22450, 15700, 7600];
	$outline_array = ["Dauphine LV", "LV Coussin", "Vanity LV", "LV Loop", "Side Trunk時髦款", "Monogram 長青款", "Damier 棋格款", "Azur 耐用款", "Pochette 精緻款", "Dutto個性款", "Damier經典款", "Neverfull 通勤款"];
    
    // 修正圖片路徑：從 images/ 改為 image/
    $image_array = ["image/LV/1.jpg", "image/LV/2.jpg", "image/LV/3.jpg", "image/LV/4.jpg", "image/LV/5.jpg", "image/LV/6.jpg",
                    "image/LV/7.jpg", "image/LV/8.jpg", "image/LV/9.jpg", "image/LV/10.jpg", "image/LV/11.jpg", "image/LV/12.jpg"];
    $qty_array = [126, 116, 106, 96, 86, 76, 66, 56, 36, 26, 16, 6];
    
    $brand = "luxury"; // 修正分類，不要讓它出現在 coffee 列表
    for($i=0; $i<count($p_id_array); $i++){
        $p_id = $p_id_array[$i];
        $name = $name_array[$i];
        $price = $price_array[$i];
        $outline = $outline_array[$i];
        $image = $image_array[$i]; 
        $qty = $qty_array[$i]; 
        $stmt->execute();
    }
    echo "<br><h2 align='center'>成功輸入 tea 茶品 </h2>";

    $stmt->close();
    echo "</div>";
    $connect->close();
?>