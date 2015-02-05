<?php

/*  必讀
 *	第一次使用，請務必訪問一次
 *  http://站點網址/index.php?action=regenerate_config
 *  來生成資料庫檔案，然後將 config.sample.php 的 $regenerate_config = true;
 *  改成 $regenerate_config = false;
 *  並且完成其他設定後，改名成 config.php
*/

//---------------- 設定 ---------------//
/*
 * $newURL
 * 此為本程式所在站點的網址
 * 請在開頭加上 http:// 字串尾巴要有 /
*/
define("newURL",'http://site/');

/*
 * $json
 * 此為短網址資料庫存放位置
 * 請在開頭加上 /
 * 請一併更改 redirect.php 的相同一行
*/
define("json",'/k8agJa1__.json');

/*
 * $regenerate_config
 * true : 可以透過 http://site/index.php?action=regenerate_config 來重置設定
 * false : 不可以重置設定（建議值）
*/
define("regenerate_config",true);

