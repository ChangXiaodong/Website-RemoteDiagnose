<?php
include_once"pdo_function.php";
$res = pdo_read_ecg("2014-07-07 17:41:29","2014-07-08 17:41:29",'ecg');
foreach ($res as $row) {
		 $ecg=$row['ecg'];
	}
	$data = explode(";", $ecg);
?>