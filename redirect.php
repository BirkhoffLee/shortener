<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "config.php";
global $json;

if(strlen(@$_GET['id']) == 0){
	header('Location: /index.php');
	exit;
}
$json = dirname(__FILE__) . DIRECTORY_SEPARATOR . $json;
$id = $_GET['id'];

$newURL = '';
$urlJSON = json_decode(file_get_contents($json), true);
if(!isset($urlJSON[$id])){
	header('Location: /index.php');
	exit;
} else {
	header('Location: ' . $urlJSON[$id]);
	exit;
}