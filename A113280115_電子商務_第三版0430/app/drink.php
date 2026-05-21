<?php
    include 'connect.php';

    // 1. 取得新品資料
    $sql = "SELECT product_id, name, price, outline, image FROM products WHERE brand='drink'";
    $result = $connect->query($sql);

    if (!$result) {
        die("讀取資料錯誤：" . $connect->error);
    }
?>

<style>
    /* 定義顏色變數 */
    :root {
        --sb-green: #00704A;
        --sb-dark: #1E3932;
        --sb-gray: #f8f9fa;
    }

    /* 卡片主體 */
    .product-card {
        border: 1px solid #eee;
        border-radius: 16px;
        background: #fff;
        transition: all 0.3s ease-in-out;
        height: 100%; /* 確保所有卡片高度一致 */
        display: flex;
        flex-direction: column; /* 垂直排列內容 */
        overflow: hidden;
    }

    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0,0,0,0.1);
        border-color: var(--sb-green);
    }

    /* 圖片比例控制：1:1 正方形 */
    .img-wrapper {
        width: 100%;
        aspect-ratio: 1 / 1; 
        overflow: hidden;
        background-color: var(--sb-gray);
    }

    .img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* 縮放圖片以填滿容器且不變形 */
        transition: transform 0.5s ease;
    }

    .product-card:hover .img-wrapper img {
        transform: scale(1.1);
    }

    /* 內容區塊 */
    .card-content {
        padding: 1.25rem;
        display: flex;
        flex-direction: column;
        flex-grow: 1; /* 讓內容區自動撐開 */
    }

    .item-name {
        font-weight: 800;
        color: var(--sb-dark);
        font-size: 1.1rem;
        margin-bottom: 8px;
        text-align: center;
    }

    .item-desc {
        color: #666;
        font-size: 0.85rem;
        text-align: center;
        line-height: 1.5;
        /* 限制文字顯示 2 行，避免撐開卡片 */
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        height: 2.6rem; 
        margin-bottom: 1rem;
    }

    /* 底部區域：價格與按鈕 */
    .item-footer {
        margin-top: auto; /* 重點！將這一塊推到卡片最底部，防止與描述重疊 */
        padding-top: 15px;
        border-top: 1px solid #f2f2f2;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .item-price {
        color: var(--sb-green);
        font-weight: 700;
        font-size: 1.2rem;
    }

    .btn-buy {
        background-color: var(--sb-green);
        color: white;
        border-radius: 50px;
        padding: 6px 18px;
        font-size: 0.9rem;
        font-weight: 600;
        border: none;
        text-decoration: none;
        transition: 0.3s;
    }

    .btn-buy:hover {
        background-color: var(--sb-dark);
        color: white;
    }

    /* 標題裝飾 */
    .section-title {
        text-align: center;
        margin-bottom: 3rem;
    }
    .green-line {
        width: 60px;
        height: 4px;
        background: var(--sb-green);
        margin: 10px auto;
        border-radius: 2px;
    }
</style>

<div class="container my-5">
    <div class="section-title">
        <h3 class="fw-bold" style="color: var(--sb-dark);">新品飲料 | NEW ARRIVALS</h3>
        <p class="text-muted">探索本季最新限時風味</p>
        <div class="green-line"></div>
    </div>

    <div class="row g-4">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
        ?>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="product-card shadow-sm">
                <div class="img-wrapper">
                    <img src="<?php echo $row['image']; ?>" 
                         onerror="this.src='https://via.placeholder.com/400x400/f2f2f2/00704A?text=Starbucks'"
                         alt="<?php echo $row['name']; ?>">
                </div>

                <div class="card-content">
                    <h5 class="item-name"><?php echo $row['name']; ?></h5>
                    <p class="item-desc"><?php echo $row['outline']; ?></p>

                    <div class="item-footer">
                        <span class="item-price">
                            $<?php echo number_format($row['price']); ?>
                        </span>
                        <a href="add_cart.php?id=<?php echo $row['product_id']; ?>" class="btn-buy">
                            選購
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php
            }
        } else {
            echo "<div class='col-12 text-center py-5'><h3>目前暫無新品。</h3></div>";
        }
        ?>
    </div>
</div>