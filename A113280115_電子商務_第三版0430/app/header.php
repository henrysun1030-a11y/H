<?php
    // 必須放在檔案最上方，否則登入狀態會抓不到


    $username = null;
    if (isset($_SESSION["name"])) {
        $username = $_SESSION["name"];
    }
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A113280039_期末作業</title>
  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <link rel="stylesheet" href="css/style.css">

    <style>
        /* 讓頂部標題更精緻一點 */
        .top-header {
            background-color: #ffffff;
            padding: 10px 0;
            position: relative;
            border-bottom: 1px solid #eee;
        }
        .member-info {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 14px;
            color: #00704A; /* 改用星巴克綠，比紅色專業 */
            font-weight: bold;
        }
        .navbar-brand img {
            transition: transform 0.3s;
        }
        .navbar-brand img:hover {
            transform: scale(1.1);
        }
    </style>
</head>  
<body>
  
  <div class="top-header text-center">
    <strong class="display-6" style="font-size: 1.5rem; color: #1E3932;">星巴克 Starbucks Taiwan</strong>
    <?php if ($username): ?>
        <div class="member-info">
            <i class="fas fa-user-circle"></i> 會員: <?= htmlspecialchars($username) ?>
        </div>
    <?php endif; ?>    
  </div>

<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
        <img src="image/Starbucks_Coffee.jpg" height="40px" alt="Logo" onerror="this.src='https://www.starbucks.com.tw/common/img/logo.png'">
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="collapseNavbar">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php"><i class="fas fa-home"></i> 首頁</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?route=food"><i class="fas fa-utensils"></i> 精選食物</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?route=new"><i class="fas fa-star"></i> 新品推薦</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?route=coffee"><i class="fas fa-coffee"></i> 咖啡飲品</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><i class="fas fa-map-marker-alt"></i> 門市資訊</a>
        </li>

        <?php if (isset($_SESSION["is_login"]) && $_SESSION["is_login"] == true): ?>
            <li class="nav-item">
              <a class="nav-link text-danger" href="?route=logout"><i class="fas fa-sign-out-alt"></i> 登出</a>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a class="nav-link" href="?route=login"><i class="fas fa-user"></i> 登入</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?route=register"><i class="fas fa-user-plus"></i> 註冊</a>
            </li>
          <?php endif; ?>
      </ul>

      <form class="d-flex align-items-center">
        <input class="form-control me-2 form-control-sm" type="text" placeholder="搜尋商品...">
        <button class="btn btn-outline-success btn-sm" type="button">Search</button>
        <a href="#" class="ms-3 text-dark">
            <i class="far fa-comment-dots fa-lg"></i>
        </a>
      </form>
    </div>
  </div>
</nav>