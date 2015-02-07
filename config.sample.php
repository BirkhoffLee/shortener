<?php
/*
 * 說明內容參見 index.php
*/

//---------------- 設定 ---------------//
/*
 * $newURL
 * 此為本程式所在站點的網址
 * 請在開頭加上 http:// 字串尾巴要有 /
*/
$newURL = 'http://site/';

/*
 * $json
 * 此為短網址資料庫存放位置
 * 請不要在開頭加上 /
*/
$json = 'k8agJa1__.json';

/*
 * $regenerate_config
 * true : 可以透過 http://site/index.php?action=regenerate_config 來重置設定
 * false : 不可以重置設定（建議值）
*/
$regenerate_config = true;

/*
 * $lang
 * 語言設定
*/
$lang = array(
	'DEFAULT_SITEURL' => '請更改 index.php 中的站點網址！',
	'RELOAD_PAGE' => '請重新整理頁面！',
	'SHORTENED' => '完成！短網址：{url}',
	'CODE_USED' => '這個代碼已經被別人使用過了，請使用另外一個代碼！',
	'ERR_CODE_LENGTH' => '發生錯誤！請確認您的 自定代碼 長度為 5 個字元。',
	'ERR_CODE_TEXT' => '發生錯誤！請確認您的 自定代碼 同時包含英文、數字，且不包含其他字元。',
	'ERR_URL_FORMAT' => '發生錯誤！請確認您的 URL 符合正確格式：http(s)://*.*(/*)',
	'DATABASE_GENERATED' => '資料庫生成成功，請務必將 $regenerate_config 的值改為 false 以保資料庫安全!',
	'WELCOME_MESSAGE' => '本服務開放給每個人使用，如果有不懂的地方或建議，煩請在<a href=https://github.com/BirkhoffLee/shortener>{here}</a>提出 Issue，感謝您。',
	'HERE' => '這裡',
	'CODE_PLACEHOLDER' => '自定代碼 (可空)'
	);