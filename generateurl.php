<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "config.php";
if(isset($_POST['action']) and $_POST['action'] == 'generate'){
	$json = dirname(__FILE__) . $json;
	if(isset($_POST['url']) and
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
				echo '完成！短網址：<a href="' . $newURL . '">' . $newURL . '</a>';
				$done = true;
			}
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
				echo '完成！短網址：<a href="' . $newURL . '">' . $newURL . '</a>';
			} elseif(strlen($_POST['id'])!==5 and strlen($_POST['id'])!==0){
				echo '發生錯誤！請確認您的 自定代碼 長度為 5 個字元。';
			} elseif(!preg_match("/^(([a-z]+[0-9]+)|([0-9]+[a-z]+))[a-z0-9]*$/i", $_POST['id']) and strlen($_POST['id'])!==0){
				echo '發生錯誤！請確認您的 自定代碼 同時包含英文、數字，且不包含其他字元。';
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
				echo '完成！短網址：<a href="' . $newURL . '">' . $newURL . '</a>';
			}
		}
	} else {
		echo '發生錯誤！請確認您的 URL 符合正確格式：http(s)://*.*(/*)';
		$valueADD = ' value="' . $_POST['url'] . '"';
	}
}