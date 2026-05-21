<?php
	include 'connect.php'; // 已連線資料庫

	// 促銷產品 product_id 陣列
	$p_id_array = [
		"2026025001","2026025002","2026025003","2026025004",
		"2026035001","2026035002","2026035003","2026035004",
		"2026065001","2026065002","2026065003","2026065004"
	];

	// 將陣列轉成 SQL 可用字串
	$p_id_str = "'" . implode("','", $p_id_array) . "'";

	// 分品牌抓取促銷產品
	$brands = ["food", "new", "coffee"];
	$products_by_brand = [];

	foreach($brands as $brand){
		$sql = "SELECT product_id, name, price, outline, image, qty, brand 
				FROM products 
				WHERE product_id IN ($p_id_str) AND brand='$brand'";
		$result = $connect->query($sql);
		if(!$result){
			die("取得 $brand 促銷產品錯誤：" . $connect->error);
		}

		$products_by_brand[$brand] = [];
		while($row = $result->fetch_assoc()){
			$products_by_brand[$brand][] = $row;
		}
	}
?>

<main>

    <!-- 首頁輪播區 -->
    

    <!-- 首頁產品促銷區 -->
    <div class="container">
        <?php foreach($brands as $brand): ?>
            <div class="col-12 mt-4">
                <div class="alert alert-success text-center">
                    <strong>本月 <?php echo $brand; ?> 精選!</strong>
                </div>
            </div>

            <div class="row">
                <?php foreach($products_by_brand[$brand] as $prod): ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                        <div class="card mx-auto" style="max-width:400px;">
                            <img class="card-img-top product-img" src="<?php echo $prod['image']; ?>" style="height:250px; object-fit:cover;">
                            <div class="card-body">
                                
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="fw-bold"><?php echo $prod['name']; ?></span>
                                    <span class="text-muted">現存數量: <?php echo $prod['qty']; ?></span>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="text-danger fw-bold mb-0">
                                        $<?php echo number_format($prod['price']); ?>
                                    </h5>
                                    <a href="#" class="btn btn-danger btn-sm">加入購物車</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
</main>