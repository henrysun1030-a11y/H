<?php
    include 'connect.php';
    $sql = "SELECT product_id, name, price, outline, image FROM products WHERE brand='super'";
    $result = $connect->query($sql);
    if (!$result) { die("讀取失敗：" . $connect->error); }
?>

<style>
    /* 使用非常特殊的名稱，確保不被舊的 style.css 覆蓋 */
    #coffee-section-final .coffee-item-card {
        border: 1px solid #ddd !important;
        border-radius: 15px !important;
        background: #fff !important;
        height: 100% !important;
        display: flex !important;
        flex-direction: column !important;
        overflow: hidden !important;
        margin-bottom: 20px !important; /* 強制上下分開 */
        transition: transform 0.3s ease !important;
    }

    #coffee-section-final .coffee-item-card:hover {
        transform: translateY(-10px) !important;
        box-shadow: 0 10px 20px rgba(0,0,0,0.15) !important;
    }

    #coffee-section-final .img-box {
        width: 100% !important;
        aspect-ratio: 4 / 3 !important; /* 統一照片比例 */
        overflow: hidden !important;
    }

    #coffee-section-final .img-box img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
    }

    #coffee-section-final .content-box {
        padding: 20px !important;
        display: flex !important;
        flex-direction: column !important;
        flex-grow: 1 !important; /* 撐開中間空間 */
    }

    /* 底部區域：絕對不會重疊 */
    #coffee-section-final .footer-box {
        margin-top: auto !important; /* 把價格按鈕推到底部 */
        padding-top: 15px !important;
        border-top: 1px solid #eee !important;
        display: flex !important;
        justify-content: space-between !important;
        align-items: center !important;
    }

    #coffee-section-final .price-text {
        color: #00704A !important;
        font-weight: bold !important;
        font-size: 1.25rem !important;
    }

    #coffee-section-final .buy-btn {
        background-color: #00704A !important;
        color: white !important;
        border-radius: 50px !important;
        padding: 5px 20px !important;
        text-decoration: none !important;
        font-weight: bold !important;
    }
</style>

<div class="container my-5" id="coffee-section-final">
    <div class="text-center mb-5">
        <h3 class="fw-bold" style="color: #1E3932;">精選咖啡 | SELECTED COFFEE</h3>
        <p class="text-muted">探索來自世界各地的頂級咖啡豆風味</p>
        <div style="width: 80px; height: 4px; background: #00704A; margin: 0 auto; border-radius: 2px;"></div>
    </div>

    <div class="row" style="margin-left: -15px; margin-right: -15px;">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3" style="padding: 15px;">
                <div class="coffee-item-card shadow-sm">
                    <div class="img-box">
                        <img src="<?= $row['image'] ?>" onerror="this.src='https://via.placeholder.com/400x300/1E3932/ffffff?text=Coffee'">
                    </div>
                    <div class="content-box">
                        <h5 class="text-center fw-bold" style="color:#1E3932;"><?= $row['name'] ?></h5>
                        <p class="text-muted small text-center" style="height: 45px; overflow: hidden;">
                            <?= $row['outline'] ?>
                        </p>
                        
                        <div class="footer-box">
                            <span class="price-text">$<?= number_format($row['price']) ?></span>
                            <a href="add_cart.php?id=<?= $row['product_id'] ?>" class="buy-btn">選購</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>