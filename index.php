<?php
/*
 * # Description
 * 請將本程式放在站點根目錄，否則將無法正確運作
 * 必須開啟 apache 的 mod_rewrite，否則將無法運作
 * 作者: Birkhoff Lee (site: b.irkhoff.com)
 * 作者 E-mail: b@irkhoff.com  (有問題歡迎詢問)
 *
 * # Thanks to
 * 感謝 Pc Chou 的熱心協助(雖然他的版本的超級多BUG讓我改了好久www
 * 感謝 Allen Chou 協助前端 AJAX
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
$pattern = "/^(([a-z]+[0-9]+)|([0-9]+[a-z]+))[a-z0-9]*$/i";

function __($text){
	global $lang;
	return $lang[$text];
}

$json = dirname(__FILE__) . DIRECTORY_SEPARATOR . $json;
if($newURL == 'http://site/'){
	die(__('DEFAULT_SITEURL'));
}

if(isset($_POST['action']) and $_POST['action'] == 'generate'){
	if (isset($_POST['url']) and
		stripos($_POST['url'], 'http') !== FALSE and
		stripos($_POST['url'], ':') !== FALSE and
		stripos($_POST['url'], '//') !== FALSE and
		stripos($_POST['url'], '.') !== FALSE and
		stripos($_POST['url'], '\r') === FALSE and
		stripos($_POST['url'], '\n') === FALSE and
		stripos($_POST['url'], '%00') === FALSE and
		stripos($_POST['url'], '"') === FALSE and
		stripos($_POST['url'], '\'') === FALSE and
		stripos($_POST['url'], '{') === FALSE and
		stripos($_POST['url'], '}') === FALSE){

		$done = false;
		$url = $_POST['url'];
		$valueADD = ' value="' . $_POST['url'] . '"';
		$urlJSON = json_decode(file_get_contents($json), true);
		foreach ($urlJSON as $key => $value) {
			if($value == $url and $done == false and !isset($_POST['id'])){
				$newURL .= $key;
				echo str_replace('{url}', '<a href="' . $newURL . '">' . $newURL . '</a>', __('SHORTENED'));
				$done = true;
			}
		}
		$urlJSON = json_decode(file_get_contents($json), true);
		$PID = $_POST['id'];
		if(isset($urlJSON[$PID])){
			$newURL .= $id;
			echo __('CODE_USED');
			$done = true;
		}
		unset($PID);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$urlHeader = curl_exec($ch);
		$uurl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
		if($url != $uurl){
			$url = $uurl;
			unset($uurl);
		}

		if(!$done){
			if(!isset($_POST['id']) or strlen($_POST['id'])==0){
				$x = sprintf("%u", crc32($url));
				$id = '';
				while($x > 0){
					$s = $x % 62;
					if ($s > 35){
						$s = chr($s + 61);
					} elseif ($s > 9 && $s <= 35){
						$s = chr($s + 55);
					}
					$id .= $s;
					$x = floor($x/62);
				}
				$urlJSON[$id] = $url;
				$fn = fopen($json, "w");
				foreach ($urlJSON as $key => $value) {
				    $ukey = urlencode($key);
				    $uvalue = urlencode($value);
				    $new_urlJSON[$ukey] = $uvalue;
				}
				fwrite($fn, urldecode(json_encode($new_urlJSON)));
				fclose($fn);

				$newURL .= $id;
				echo str_replace('{url}', '<a href="' . $newURL . '">' . $newURL . '</a>', __('SHORTENED'));
			} elseif(strlen($_POST['id'])!==5 and strlen($_POST['id'])!==0){
				echo __('ERR_CODE_LENGTH');
			} elseif(!preg_match($pattern, $_POST['id']) and strlen($_POST['id'])!==0){
				echo __('ERR_CODE_TEXT');
			} else {
				$id = $_POST['id'];
				$urlJSON[$id] = $url;
				$fn = fopen($json, "w");
				foreach ($urlJSON as $key => $value) {
				    $ukey = urlencode($key);
				    $uvalue = urlencode($value);
				    $new_urlJSON[$ukey] = $uvalue;
				}
				fwrite($fn, urldecode(json_encode($new_urlJSON)));
				fclose($fn);

				$newURL .= $id;
				echo str_replace('{url}', '<a href="' . $newURL . '">' . $newURL . '</a>', __('SHORTENED'));
			}
		}
	} else {
		echo __('ERR_URL_FORMAT');
		$valueADD = ' value="' . $_POST['url'] . '"';
	}
	exit;
}
?>
<html>
  <head>
    <meta charset="utf-8">
    <title>URL Shortener - Powered by Birkhoff</title>
    <link rel="stylesheet" href="css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="<?php echo $newURL;?>form.js"></script>
  </head>
  <body>
    <form action="#" method="post" name="Shortener">
      <div class="header"></div>
      <div class="description">
        <p><?php
if(isset($_GET['action']) and $_GET['action'] == 'regenerate_config' and $regenerate_config) {
	$urlJSON = array('http://goo.gl' => 'googl');
	$fn = fopen($json, "w");
	fwrite($fn, json_encode($urlJSON));
	fclose($fn);

	echo __('DATABASE_GENERATED');
} else {
	echo str_replace('{here}', __('HERE'), __('WELCOME_MESSAGE'));
}
?></p>
      </div>
      <div class="input">
        <input type="text" class="button" id="url" name="url" placeholder="http://www.google.com">
        <input type="text" class="button" id="id" name="id" placeholder="<?php echo __('CODE_PLACEHOLDER');?>" maxlength="5">
        <input type="submit" class="button" id="submit" value="SHORTEN!">
      </div>
      <input type="hidden" id="action" name="action" value="generate">
    </form>
  </body>
</html>