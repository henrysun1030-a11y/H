//全域變數 紀錄驗證碼
var code = "";
var checkCode = document.getElementById("code");

//顏色組設定
var fontColor = ["blue", "white", "yellow", "black"];

var color01 = "linear-gradient(90deg, rgba(42, 123, 155, 1) 30%, rgba(173, 199, 87, 1) 70%, rgba(237, 221, 83, 1) 87%)";
var color02 = "radial-gradient(circle, rgba(238, 174, 202, 1) 32%, rgba(148, 233, 223, 0.85) 84%)";
var color03 = "linear-gradient(0deg, rgba(34, 193, 195, 1) 0%, rgba(253, 187, 45, 1) 84%)";
var color04 = "radial-gradient(circle, rgba(238, 174, 202, 1) 0%, rgba(148, 187, 233, 1) 100%)";

var bgColor = [color01, color02, color03, color04];
var ls = ["2px", "8px", "-2px", "4px"];
var iColor;

//隨機設定顏色組合
function randColor() {
  return Math.floor(Math.random() * fontColor.length);
}

function createCode() {
  var ci = randColor();
  checkCode.style.color = fontColor[ci];
  checkCode.style.background = bgColor[ci];
  checkCode.style.letterSpacing = ls[ci];

  code = "";
  var random = [0,1,2,3,4,5,6,7,8,9,
                  'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P',
                  'Q','R','S','T','U','V','W','X','Y','Z'];

  for (var i = 0; i < 6; i++) {   //驗證碼長度 = 6
    var index = Math.floor(Math.random() * random.length);  //取得隨機數的索引（0~35）
    code += random[index];  //將取得的隨機數值或字母 放進code
  }

  checkCode.innerHTML = code; //把code值 指定為此次的 驗證碼
}

//更新驗證碼
var recode = document.getElementById('recode');
recode.addEventListener("click", function (e) {
  createCode();
  document.getElementById("input").value = "";  // 清空
  e.preventDefault();
});

//點擊更新驗證碼
checkCode.addEventListener("click", function (e) {
  createCode();
  document.getElementById("input").value = "";  // 清空
  e.preventDefault();
});


//驗證
var validate = document.getElementById('validate');
validate.addEventListener("click", function (e) {
  var inputCode = document.getElementById("input").value.toUpperCase(); //取得輸入的驗證碼, 並都轉成為 大寫 

  if (inputCode.length === 0) {  //若輸入的驗證碼長度為0
    alert("請輸入驗證碼！");     //則彈出請輸入驗證碼
  } else if (inputCode !== code) {      //若輸入的驗證碼與產生的驗證碼不一致時
    alert("驗證碼輸入錯誤！");          //則彈出驗證碼輸入錯誤 
    createCode();                       //重新整理驗證碼 
    document.getElementById("input").value = "";   // 清空
  } else {                       // 若都輸入正確 
    alert("驗證碼輸入正確！");   // 秀出 驗證碼輸入正確
    createCode();                // 重新整理驗證碼
    document.getElementById("input").value = "";  // 清空
  }
});

createCode();
