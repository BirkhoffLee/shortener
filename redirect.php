<?php
/*
 * $json
 * 此為短網址資料庫存放位置
 * 請在開頭加上 /
 * 請一併更改 index.php 的相同一行
*/
require_once "config.php" or die('<h1>Cannot access config file. Did you read the message in index.php?</h1>');
global $json;

//---------------- 請勿更改 ---------------//
if(strlen($_GET['id']) == 0){
	header('Location: /index.php');
	exit;
}
$json = dirname(__FILE__) . $json;
$id = $_GET['id'];

$newURL = '';
$urlJSON = json_decode(file_get_contents($json), true);
if(!isset($urlJSON[$id])){
	header('Location: /index.php');
	exit;
}
header('Location: ' . $urlJSON[$id]);
exit;
?>
