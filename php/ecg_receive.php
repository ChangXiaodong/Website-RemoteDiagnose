<?php
include_once"file.php";
include_once"pdo_function.php";
$date = time();
$time = date("Y-m-d_G-i-s",$date + 3600 * 8);
$name = "../data/ecg/".$time.".txt";
$file = new file($name);
if($_POST){
	$file->WriteChar($_POST['ecg']);
	pdo_insert_ecg($_POST['ecg']);
}
?>