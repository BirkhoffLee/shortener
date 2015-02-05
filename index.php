<?php
/*
 * 請將本程式放在站點根目錄，否則將無法正確運作
 * 必須開啟 apache 的 mod_rewrite，否則將無法運作
 * 作者: Birkhoff Lee (site: b.irkhoff.com)
 * 作者 E-mail: b@irkhoff.com  (有問題歡迎詢問)
 * 感謝 Pc Chou 的熱心協助(雖然他的版本的超級多BUG讓我改了好久www
 * 感謝 Allen Chou 提供 AJAX 版本（臉上貼金中）
 * -
 * 尊重著作權，請保留作者資訊
*/
header("Content-type: text/html; charset=utf-8");

/*  第一次使用必讀
 *  先將 config.sample.php 改名成 config.php
 *  然後訪問一次
 *  http://站點網址/index.php?action=regenerate_config
 *  來生成資料庫檔案，接著將 config.php 的 $regenerate_config = true;
 *  改成 $regenerate_config = false;
 *  即可完成安裝過程
*/
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "config.php";
global $json;
global $newURL;
global $regenerate_config;

$json = dirname(__FILE__) . $json;
if($newURL == 'http://site/'){
	die('請更改 index.php 中的站點網址!');
}
?>
<html>
  <head>
    <meta charset="utf-8">
    <title>URL Shortener - Powered by Birkhoff</title>
    <link rel="stylesheet" href="css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>
        $(document).ready(function(){ 
            $("#submit").on("click",function(e){
                e.preventDefault();
                $.ajax({
                    url: "generateurl.php",
                    type: "POST",
                    data: {
                        url: $("#url").val(),
                        id: $("#id").val(),
                        action: $("#action").val()
                    },
                    dataType:"html",
                    success: function(data){
                        $(".description").html(data);
                    }
                });
            });
        });
    </script>

  </head>
  <body>
    <form action="#" method="post" name="Shortener">
      <div class="header">
         <p>URL SHORTENER</p>
      </div>
      <div class="description">
        <p><?php
if(isset($_GET['action']) and $_GET['action'] == 'regenerate_config' and $regenerate_config) {
	$urlJSON = array('' => '');
	$fn = fopen($json, "w");
	fwrite($fn, json_encode($urlJSON));
	fclose($fn);

	echo '資料庫生成成功，請務必將 $regenerate_config 的值改為 false 以保資料庫安全!';
} else {
	echo '本服務開放給每個人使用，如果有不懂的地方或建議，煩請來信至 b[at]irkhoff.com 告知。感謝您。';
}
$valueADD = (isset($valueADD)) ? $valueADD : '';
?></p>
      </div>
      <div class="input">
        <input type="text" class="button" id="url" name="url" placeholder="http://www.google.com">
        <input type="text" class="button" id="id" name="id" placeholder="自定代碼 (可空)" maxlength="5">
        <input type="submit" class="button" id="submit" value="SHORTEN!">
      </div>
      <input type="hidden" id="action" name="action" value="generate">
    </form>
  </body>
</html>
