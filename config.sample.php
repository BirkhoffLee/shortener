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
 * 請在開頭加上 /
 * 請一併更改 redirect.php 的相同一行
*/
$json = '/k8agJa1__.json';

/*
 * $regenerate_config
 * true : 可以透過 http://site/index.php?action=regenerate_config 來重置設定
 * false : 不可以重置設定（建議值）
*/
$regenerate_config = true;

