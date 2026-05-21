<?php
    include 'connect.php';

    // 取得食物資料
    $sql = "SELECT product_id, name, price, outline, image FROM products WHERE brand='sweet'";
    $result = $connect->query($sql);

    if (!$result) {
        die("讀取食物資料錯誤：" . $connect->error);
    }
?>

<style>
    /* 強制拉開卡片間距與美化 */
    .my-food-card {
        border: 1px solid #ddd !important;
        border-radius: 15px !important;
        background: #fff !important;
        height: 100% !important;
        display: flex !important;
        flex-direction: column !important; /* 讓內容垂直排列 */
        overflow: hidden !important;
        transition: transform 0.3s ease !important;
    }

    .my-food-card:hover {
        transform: translateY(-10px) !important;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }

    /* 圖片比例固定 4:3 */
    .my-img-wrapper {
        width: 100% !important;
        aspect-ratio: 4 / 3 !important;
        overflow: hidden !important;
    }

    .my-img-wrapper img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
    }

    /* 內容區塊 */
    .my-card-body {
        padding: 15px !important;
        display: flex !important;
        flex-direction: column !important;
        flex-grow: 1 !important; /* 佔滿空間 */
    }

    /* 底部區域：價格與按鈕強制靠底，絕不重疊 */
    .my-card-footer {
        margin-top: auto !important; /* 重要：把這區推到最下面 */
        padding-top: 15px !important;
        border-top: 1px solid #eee !important;
        display: flex !important;
        justify-content: space-between !important;
        align-items: center !important;
    }

    .my-price {
        color: #00704A !important;
        font-weight: bold !important;
        font-size: 1.2rem !important;
    }

    .my-btn {
        background-color: #00704A !important;
        color: white !important;
        border-radius: 50px !important;
        padding: 5px 20px !important;
        font-weight: 600 !important;
        text-decoration: none !important;
    }
</style>

<div class="container my-5">
    <div class="text-center mb-5">
        <h3 class="fw-bold" style="color: #1E3932;">常態輕食 | CLASSIC FOOD</h3>
        <p class="text-muted">搭配美味咖啡，享受多層次的午茶食光</p>
        <div style="width: 80px; height: 4px; background: #00704A; margin: 0 auto; border-radius: 2px;"></div>
    </div>

    <div class="row g-4">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
        ?>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="my-food-card">
                <div class="my-img-wrapper">
                    <img src="<?php echo $row['image']; ?>" onerror="this.src='https://via.placeholder.com/400x300/f2f2f2/00704A?text=Starbucks'">
                </div>

                <div class="my-card-body">
                    <h5 class="text-center fw-bold" style="color:#1E3932;"><?php echo $row['name']; ?></h5>
                    <p class="text-muted small text-center" style="height: 40px; overflow: hidden;">
                        <?php echo $row['outline']; ?>
                    </p>

                    <div class="my-card-footer">
                        <span class="my-price">$<?php echo number_format($row['price']); ?></span>
                        <a href="add_cart.php?id=<?php echo $row['product_id']; ?>" class="my-btn">點購</a>
                    </div>
                </div>
            </div>
        </div>
        <?php
            }
        }
        ?>
    </div>
</div>