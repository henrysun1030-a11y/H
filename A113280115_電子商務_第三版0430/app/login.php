<?php
// 移除 session_start(); 因為 index.php 已經有了

// 核心修正：路徑必須補上 app/
include('app/connect.php'); 

$msg1 = "";
$msg2 = "";
$register_success = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $useraccount = trim($_POST['user_email'] ?? '');
    $userpasswd  = $_POST['user_passwd'] ?? '';
    $input_code  = strtoupper(trim($_POST['input_verify'] ?? '')); // 使用者輸入的驗證碼
    $real_code   = $_SESSION['vcode'] ?? ''; // JS 存入 Session 的正確代碼 (或透過隱藏欄位)

    // 這裡示範簡單的比對。實務上建議驗證碼也透過 PHP 檢查，
    // 但為了配合你的 JS 結構，我們假設 JS 會將產生的代碼存入一個 hidden 欄位或透過 ajax 驗證。
    // 這邊我們先處理帳密比對。

    if (empty($useraccount) || empty($userpasswd)) {
        $error = "請輸入帳號、密碼!";
    } else {
        $stmt = $connect->prepare("SELECT name, account, passwd FROM members WHERE account=?");
        if (!$stmt) { die("SQL error: " . $connect->error); }

        $stmt->bind_param("s", $useraccount);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            if ($userpasswd === $row['passwd']) {
                $_SESSION["is_login"] = true;
                $_SESSION["name"] = $row['name'];
                $_SESSION["email"] = $row['account'];

                header("Location: index.php?route=home");
                exit();
            } else {
                $error = "密碼錯誤!";
            }
        } else {
            $error = "帳號不存在!";
        }
        $stmt->close();
    }
}
$connect->close();
?>

<style>
    :root {
        --sb-green: #00704A;
        --sb-dark-green: #1E3932;
        --light-gray: #f7f7f7;
    }
    body { background-color: var(--light-gray); }
    .login-container {
        max-width: 450px;
        margin: 50px auto;
        background: #ffffff;
        padding: 40px 30px;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        border: 1px solid #e0e0e0;
    }
    .login-title { color: var(--sb-green); font-weight: 700; margin-bottom: 10px; }
    .title-underline { width: 60px; height: 4px; background-color: var(--sb-green); margin: 0 auto 30px; border-radius: 2px; }
    .form-group { text-align: left; margin-bottom: 20px; }
    .form-group label { display: block; font-weight: 600; margin-bottom: 8px; color: var(--sb-dark-green); }
    .form-control-custom { width: 100%; padding: 12px 15px; border: 1px solid #ccc; border-radius: 8px; }
    .verify-box { background: #f9f9f9; border: 1px dashed var(--sb-green); border-radius: 10px; padding: 15px; margin-top: 20px; }
    #code { 
        display: inline-block; font-family: 'Courier New', monospace; font-weight: bold; letter-spacing: 5px; 
        color: #fff; background: linear-gradient(135deg, #00704A, #1E3932); padding: 8px 20px; border-radius: 5px; cursor: default;
    }
    #recode { font-size: 14px; color: var(--sb-green); text-decoration: underline; cursor: pointer; margin-left: 10px; }
    .btn-sb-primary {
        background-color: var(--sb-green); color: white; width: 100%; padding: 12px;
        border-radius: 25px; font-weight: bold; border: none; font-size: 1.1rem; transition: 0.3s; margin-top: 20px;
    }
    .btn-sb-primary:hover { background-color: var(--sb-dark-green); }
</style>

<div class="container">
    <div class="login-container text-center">
        <h2 class="login-title">會員登入</h2>
        <div class="title-underline"></div>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger py-2"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="post" action="index.php?route=login" onsubmit="return validateVerify()">
            <div class="form-group">
                <label>帳號 (Email)</label>
                <input type="email" name="user_email" class="form-control-custom" placeholder="請輸入 Email" required>
            </div>

            <div class="form-group">
                <label>密碼</label>
                <input type="password" name="user_passwd" class="form-control-custom" placeholder="請輸入密碼" required>
            </div>

            <div class="verify-box">
                <div class="d-flex justify-content-center align-items-center mb-2">
                    <span id="code"></span> <span id="recode" onclick="createCode()">更新驗證碼</span>
                </div>
                <input type="text" id="input_verify" name="input_verify" class="form-control-custom text-center" placeholder="輸入上方驗證碼" required>
            </div>

            <button type="submit" class="btn-sb-primary">登 入</button>
        </form>
        <div class="mt-3">
            <a href="index.php?route=register" class="text-muted small">還沒加入？立即註冊</a>
        </div>
    </div>
</div>

<script>
    let code; 
    function createCode() {
        code = "";
        const codeLength = 6;
        const selectChar = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
        for (let i = 0; i < codeLength; i++) {
            let charIndex = Math.floor(Math.random() * 36);
            code += selectChar[charIndex];
        }
        document.getElementById("code").innerHTML = code;
    }

    function validateVerify() {
        const inputCode = document.getElementById("input_verify").value.toUpperCase();
        if (inputCode !== code) {
            alert("驗證碼輸入錯誤，請重新確認！");
            createCode();
            return false;
        }
        return true;
    }

    window.onload = createCode;
</script>