<?php
    // 價格陣列
    $price = [90,100,90,90,150,150,160,170,130,120,100,130];
?>

<style>
    :root {
        --sb-green: #00704A;
        --sb-dark: #1E3932;
        --sb-light: #f8f9fa;
    }

    /* 1. 輪播區域美化 */
    .carousel-item img {
        object-fit: cover;
        filter: brightness(0.9); /* 稍微調暗，讓文字更明顯 */
    }
    .carousel-caption {
        background: rgba(0, 0, 0, 0.4); /* 文字背後淡淡遮罩 */
        border-radius: 15px;
        padding: 20px;
        bottom: 10%;
    }

    /* 2. 標題樣式統一 */
    .section-header {
        text-align: center;
        margin-top: 4rem;
        margin-bottom: 3rem;
    }
    .header-line {
        width: 60px;
        height: 4px;
        background: var(--sb-green);
        margin: 10px auto;
        border-radius: 2px;
    }

    /* 3. 產品卡片終極樣式 */
    .product-card {
        border: 1px solid #eee;
        border-radius: 16px;
        background: #fff;
        height: 100%;
        display: flex;
        flex-direction: column;
        transition: all 0.3s ease-in-out;
        overflow: hidden;
    }
    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        border-bottom: 4px solid var(--sb-green);
    }

    /* 固定 1:1 比例 */
    .img-wrapper {
        width: 100%;
        aspect-ratio: 1 / 1;
        overflow: hidden;
        background: var(--sb-light);
    }
    .img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .product-card:hover .img-wrapper img {
        transform: scale(1.1);
    }

    /* 內容與按鈕排列 */
    .card-body-fixed {
        padding: 1.25rem;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
        text-align: center;
    }
    .product-info-text {
        color: #666;
        font-size: 0.9rem;
        margin-bottom: 15px;
        height: 40px; /* 固定高度，防止長短不一 */
        overflow: hidden;
    }

    /* 底部功能區：絕不重疊 */
    .product-footer {
        margin-top: auto;
        padding-top: 15px;
        border-top: 1px solid #f2f2f2;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .price-tag {
        color: #d9534f; /* 價格用明顯的紅色 */
        font-weight: 700;
        font-size: 1.1rem;
    }
    .btn-sb-order {
        background-color: var(--sb-green);
        color: white;
        border-radius: 50px;
        padding: 6px 15px;
        font-size: 0.85rem;
        font-weight: 600;
        border: none;
        text-decoration: none;
        transition: 0.3s;
    }
    .btn-sb-order:hover {
        background-color: var(--sb-dark);
        color: white;
    }
</style>

<div class="container-fluid px-0">
    <div id="demo" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="3"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="4"></button>
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="image/封面1.jpg" class="d-block w-100" style="height:550px;">
                <div class="carousel-caption">
                    <h3 class="display-4 fw-bold">限定聯名款</h3>
                    <p class="fs-4">Miffy 米飛兔帶給你暖心時刻</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="image/封面2.jpg" class="d-block w-100" style="height:550px;">
                <div class="carousel-caption">
                    <h3 class="display-4 fw-bold">星禮程限定</h3>
                    <p class="fs-4">端午節仲夏活動開跑</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="image/封面3.jpg" class="d-block w-100" style="height:550px;">
                <div class="carousel-caption">
                    <h3 class="display-4 fw-bold">季節甜點</h3>
                    <p class="fs-4">不可錯過的夏日限定滋味</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="image/封面4.jpg" class="d-block w-100" style="height:550px;">
                <div class="carousel-caption">
                    <h3 class="display-4 fw-bold">回饋加碼</h3>
                    <p class="fs-4">iCash Pay 專屬優惠進行中</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="image/封面5.jpg" class="d-block w-100" style="height:550px;">
                <div class="carousel-caption">
                    <h3 class="display-4 fw-bold">美好生活</h3>
                    <p class="fs-4">米飛兔玩偶、包包系列正式開賣</p>
                </div>
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
</div>

<main class="pb-5">
    <div class="container">
        
        <div class="section-header">
            <h3 class="fw-bold" style="color: var(--sb-dark);">常態輕食 | CLASSIC FOOD</h3>
            <div class="header-line"></div>
        </div>
        <div class="row g-4">
            <?php for($i=1;$i<=4;$i++): ?>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="product-card">
                    <div class="img-wrapper">
                        <img src="image/food/<?php echo $i; ?>.jpg" onerror="this.src='https://via.placeholder.com/400x400?text=Food'">
                    </div>
                    <div class="card-body-fixed">
                        <h5 class="fw-bold">美味輕食 <?php echo $i; ?></h5>
                        <p class="product-info-text">嚴選食材，為您的一天注入美好能量</p>
                        <div class="product-footer">
                            <span class="price-tag">$<?php echo number_format($price[$i-1]); ?></span>
                            <a href="#" class="btn-sb-order">加入預點</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endfor; ?>
        </div>

        <div class="section-header">
            <h3 class="fw-bold" style="color: var(--sb-dark);">季節限定 | SEASONAL SPECIAL</h3>
            <div class="header-line"></div>
        </div>
        <div class="row g-4">
            <?php for($i=5;$i<=8;$i++): ?>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="product-card">
                    <div class="img-wrapper">
                        <img src="image/new/<?php echo $i; ?>.png" onerror="this.src='https://via.placeholder.com/400x400?text=New+Arrival'">
                    </div>
                    <div class="card-body-fixed">
                        <h5 class="fw-bold">限定飲品 <?php echo $i; ?></h5>
                        <p class="product-info-text">季節限定風味，錯過就要等明年囉</p>
                        <div class="product-footer">
                            <span class="price-tag">$<?php echo number_format($price[$i-1]); ?></span>
                            <a href="#" class="btn-sb-order">加入預點</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endfor; ?>
        </div>

        <div class="section-header">
            <h3 class="fw-bold" style="color: var(--sb-dark);">精選咖啡 | SELECTED COFFEE</h3>
            <div class="header-line"></div>
        </div>
        <div class="row g-4">
            <?php for($i=9;$i<=12;$i++): ?>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="product-card">
                    <div class="img-wrapper">
                        <img src="image/coffee/<?php echo $i; ?>.jpg" onerror="this.src='https://via.placeholder.com/400x400?text=Coffee'">
                    </div>
                    <div class="card-body-fixed">
                        <h5 class="fw-bold">精選咖啡 <?php echo $i; ?></h5>
                        <p class="product-info-text">一天一杯高品質咖啡，開啟美好早晨</p>
                        <div class="product-footer">
                            <span class="price-tag">$<?php echo number_format($price[$i-1]); ?></span>
                            <a href="#" class="btn-sb-order">加入預點</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endfor; ?>
        </div>

    </div>
</main>