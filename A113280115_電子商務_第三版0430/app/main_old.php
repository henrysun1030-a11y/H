<?php
    // 價格資料
    $price = [90,100,90,90,150,150,160,170,130,120,100,130];
?>

<style>
    :root {
        --sb-green: #00704A;
        --sb-dark: #1E3932;
        --sb-cream: #fdfaf7; /* 高級米白 */
        --sb-light-brown: #d4a373; /* 淺咖 */
    }

    body { background-color: #fcfcfc; }

    /* --- 1. 輪播區域 (高級字幕優化) --- */
    #demo {
        border-radius: 20px;
        overflow: hidden;
        margin-top: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    }
    .carousel-item img {
        height: 550px;
        object-fit: cover;
    }

    /* 修正原本太大的灰色區塊：改為精緻米白磨砂盒 */
    .carousel-caption {
        background: rgba(253, 250, 247, 0.85); /* 米白色透明 */
        backdrop-filter: blur(8px); /* 磨砂效果 */
        -webkit-backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        border-bottom: 5px solid var(--sb-green); /* 底部綠線裝飾 */
        border-radius: 15px;
        color: var(--sb-dark) !important;
        padding: 15px 30px;
        max-width: 450px; /* 寬度縮小，變高級的關鍵 */
        left: 50%;
        transform: translateX(-50%);
        bottom: 50px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.1);
    }
    .carousel-caption h3 { 
        font-weight: 800; 
        font-size: 1.8rem; 
        margin-bottom: 5px; 
        color: var(--sb-dark) !important;
    }
    .carousel-caption p { 
        font-weight: 500; 
        margin-bottom: 0; 
        color: #444 !important;
    }

    /* --- 2. 標題與分隔樣式 --- */
    .section-header {
        text-align: center;
        margin: 60px 0 40px;
    }
    .header-line {
        width: 50px;
        height: 4px;
        background: var(--sb-green);
        margin: 12px auto;
        border-radius: 2px;
    }

    /* --- 3. 產品卡片樣式 (與聯名系列一致) --- */
    .product-card {
        border: 1px solid #eee;
        border-radius: 16px;
        background: #fff;
        height: 100%;
        display: flex;
        flex-direction: column;
        transition: all 0.3s ease;
        overflow: hidden;
    }
    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.1);
        border-bottom: 5px solid var(--sb-green);
    }
    .img-wrapper {
        width: 100%;
        aspect-ratio: 1 / 1;
        overflow: hidden;
    }
    .img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* 內容與按鈕永遠靠底，解決重疊 */
    .card-body-custom {
        padding: 1.25rem;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }
    .footer-action {
        margin-top: auto; /* 重點：推到底部 */
        padding-top: 15px;
        border-top: 1px solid #f2f2f2;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .btn-buy {
        background-color: var(--sb-green);
        color: white;
        border-radius: 50px;
        padding: 6px 20px;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none;
    }
</style>

<div class="container pb-5">
    
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
                <img src="image/封面1.jpg" class="d-block w-100">
                <div class="carousel-caption">
                    <h3>限定聯名款</h3>
                    <p>米飛兔 Miffy 暖心登場</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="image/封面2.jpg" class="d-block w-100">
                <div class="carousel-caption">
                    <h3>星禮程慶典</h3>
                    <p>端午節活動限時開跑</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="image/封面3.jpg" class="d-block w-100">
                <div class="carousel-caption">
                    <h3>季節甜點</h3>
                    <p>夏日專屬的甜蜜滋味</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="image/封面4.jpg" class="d-block w-100">
                <div class="carousel-caption">
                    <h3>支付優惠</h3>
                    <p>iCash Pay 享點數回饋</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="image/封面5.jpg" class="d-block w-100">
                <div class="carousel-caption">
                    <h3>美好生活</h3>
                    <p>米飛兔全系列聯名商品開賣</p>
                </div>
            </div>
        </div>
    </div>

    <div class="section-header">
        <h3 class="fw-bold" style="color: var(--sb-green);">聯名限量禮盒系列</h3>
    </div>
    <div class="row g-4 justify-content-center">
        <div class="col-12 col-md-4">
            <div class="product-card">
                <div class="img-wrapper"><img src="image/禮盒1.jpg"></div>
                <div class="card-body-custom">
                    <h5 class="fw-bold">夏日miffy風格禮盒 ☀️</h5>
                    <p class="text-muted small">相機包造型側背包，具備實用活動隔板。</p>
                    <div class="footer-action">
                        <span class="fw-bold" style="color: var(--sb-green);">$1,200</span>
                        <a href="#" class="btn-buy">了解更多</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="product-card">
                <div class="img-wrapper"><img src="image/禮盒2.jpg"></div>
                <div class="card-body-custom">
                    <h5 class="fw-bold">夏日miffy沁爽禮盒 🍃</h5>
                    <p class="text-muted small">大容量保冷側背包，手提採買質感兼具。</p>
                    <div class="footer-action">
                        <span class="fw-bold" style="color: var(--sb-green);">$1,350</span>
                        <a href="#" class="btn-buy">了解更多</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="product-card">
                <div class="img-wrapper"><img src="image/禮盒3.jpg"></div>
                <div class="card-body-custom">
                    <h5 class="fw-bold">草莓可可杏仁捲 🍓</h5>
                    <p class="text-muted small">草莓淋醬與可可內餡，層次分明的甜蜜享受。</p>
                    <div class="footer-action">
                        <span class="fw-bold" style="color: var(--sb-green);">$450</span>
                        <a href="#" class="btn-buy">立即購買</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section-header">
        <h3 class="fw-bold" style="color: var(--sb-dark);">常態輕食 | CLASSIC FOOD</h3>
        <div class="header-line"></div>
    </div>
    <div class="row g-4">
        <?php for($i=1;$i<=4;$i++): ?>
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="product-card">
                <div class="img-wrapper"><img src="image/food/<?php echo $i; ?>.jpg"></div>
                <div class="card-body-custom">
                    <h5 class="fw-bold">美味輕食 <?php echo $i; ?></h5>
                    <p class="text-muted small">經典手作，開啟你活力的一天。</p>
                    <div class="footer-action">
                        <span class="fw-bold">$<?php echo $price[$i-1]; ?></span>
                        <a href="#" class="btn-buy">加入預點</a>
                    </div>
                </div>
            </div>
        </div>
        <?php endfor; ?>
    </div>
</div>