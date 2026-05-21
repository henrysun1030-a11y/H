<?php

include('connect.php');

$msg1 = "";
$msg2 = "";
$register_success = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $useraccount = trim($_POST["user_email"] ?? '');
    $userpasswd  = $_POST["user_passwd"] ?? '';
    $confirm_pw  = $_POST["confirm_password"] ?? '';
    $username    = trim($_POST["user_name"] ?? '');
    $userphone   = trim($_POST["user_phone"] ?? '');

    if ($userpasswd !== $confirm_pw) {
        $msg1 = "兩次密碼不一致!";
        $msg2 = "請重新輸入!";
    } else {
        // 檢查帳號是否存在
        $stmt = $connect->prepare("SELECT account FROM members WHERE account = ?");
        $stmt->bind_param("s", $useraccount);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $msg1 = "此帳號已存在";
            $msg2 = "請更換 Email 重新註冊";
        } else {
            // 新增會員
            $stmt_ins = $connect->prepare("INSERT INTO members (account, passwd, name, phone) VALUES (?, ?, ?, ?)");
            $stmt_ins->bind_param("ssss", $useraccount, $userpasswd, $username, $userphone);
            
            if ($stmt_ins->execute()) {
                $msg1 = "會員註冊成功";
                $msg2 = "歡迎 $username 加入星巴克！";
                $register_success = true;
            } else {
                $msg1 = "註冊失敗";
                $msg2 = "系統忙碌中，請稍後再試";
            }
            $stmt_ins->close();
        }
        $stmt->close();
    }
}
$connect->close();
?>

<style>
    :root {
        --sb-green: #00704A;
        --sb-dark: #1E3932;
        --bg-gray: #f7f7f7;
    }
    body { background-color: var(--bg-gray); }
    .register-container {
        max-width: 500px;
        margin: 40px auto;
        background: #ffffff;
        padding: 40px 35px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    }
    .title-area h2 { color: var(--sb-green); font-weight: 800; }
    .title-line { width: 60px; height: 4px; background-color: var(--sb-green); margin: 0 auto 30px; border-radius: 2px; }
    .form-group { text-align: left; margin-bottom: 20px; }
    .form-group label { display: block; font-weight: 600; color: var(--sb-dark); margin-bottom: 8px; }
    .form-control-custom { width: 100%; padding: 12px 15px; border: 1px solid #ddd; border-radius: 10px; }
    .btn-sb-primary {
        background-color: var(--sb-green); color: white; width: 100%; padding: 14px;
        border-radius: 30px; font-weight: bold; border: none; font-size: 1.1rem; transition: 0.3s; margin-top: 15px;
    }
    .btn-sb-primary:hover { background-color: var(--sb-dark); transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,112,74,0.3); }
    .btn-sb-outline {
        background-color: transparent; color: var(--sb-green); border: 2px solid var(--sb-green);
        border-radius: 30px; padding: 10px 25px; font-weight: bold; text-decoration: none; display: inline-block; transition: 0.3s;
    }
    .btn-sb-outline:hover { background-color: var(--sb-green); color: white; }
    .success-icon { font-size: 4rem; color: var(--sb-green); margin-bottom: 20px; }
</style>

<div class="container">
    <div class="register-container text-center">

        <?php if ($register_success): ?>
            <div class="py-4">
                <div class="success-icon"><i class="fas fa-check-circle"></i></div>
                <h2 style="color: var(--sb-green); font-weight: 800;"><?= $msg1 ?></h2>
                <p class="text-muted mb-5"><?= $msg2 ?></p>
                <div class="d-grid gap-3">
                    <a href="index.php?route=login" class="btn-sb-primary text-decoration-none">立即登入會員</a>
                    <a href="index.php?route=home" class="btn-sb-outline">先回首頁看看</a>
                </div>
            </div>

        <?php else: ?>
            <div class="title-area">
                <h2>填寫註冊資料</h2>
                <div class="title-line"></div>
            </div>

            <?php if (!empty($msg1)): ?>
                <div class="alert alert-danger py-2 mb-4" style="border-radius: 10px;">
                    <strong><?= $msg1 ?></strong><br><?= $msg2 ?>
                </div>
            <?php endif; ?>

            <form method="post" action="index.php?route=register">
                <div class="form-group">
                    <label>姓名</label>
                    <input type="text" name="user_name" class="form-control-custom" placeholder="請填寫真實姓名" required autofocus>
                </div>

                <div class="form-group">
                    <label>帳號 (Email)</label>
                    <input type="email" name="user_email" class="form-control-custom" placeholder="example@mail.com" required>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>設定密碼</label>
                            <input type="password" name="user_passwd" class="form-control-custom" placeholder="8-12位英數" minlength="8" maxlength="12" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>確認密碼</label>
                            <input type="password" name="confirm_password" class="form-control-custom" placeholder="再次輸入密碼" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>手機號碼</label>
                    <input type="tel" name="user_phone" class="form-control-custom" pattern="09[0-9]{2}-[0-9]{3}-[0-9]{3}" placeholder="格式: 0912-345-678" required>
                </div>

                <div class="mb-4">
                    <input type="checkbox" id="consent" required checked>
                    <label for="consent" class="small text-muted">我同意星巴克隱私權條款與會員規範</label>
                </div>

                <button type="submit" class="btn-sb-primary">註 冊 成 員</button>
            </form>
        <?php endif; ?>

    </div>
</div>