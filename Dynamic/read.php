<?php
include_once"../php/pdo_function.php";
//$id = 2238;
//$id = $_GET['id'];
//$time = $_GET['time'];
//$time = '00:00';
// $date =time();
// if($time==''){
	// $time = date("Y-m-d G:i:s",$date + 3600 * 8-120);
// }
// else{
	// $time = date("Y-m-d ",$date + 3600 * 8).$time.date(":s",$date + 3600 * 8);
// }

$username='root';
$password='';
$datavalue_database='intel_values';

$dbh  = new  PDO ("mysql:host=localhost;dbname=$datavalue_database",$username,$password );

//$res = $dbh->query("SELECT ecg FROM ecg where time between \"$time\" AND \"2020-01-01 00:00:00\"");
$res = $dbh->query("SELECT count(*) FROM ecg");
$rs = $res->fetchAll();
$totalRow = $rs[0][0];//总记录数
$res = $dbh->query("SELECT ecg FROM ecg where id=$totalRow");
foreach ($res as $row) {
	 $ecg=$row['ecg'];
}
echo $ecg;
/*
$node_num = $res->rowCount();

foreach ($res as $row) {
	 $ecg=$row['ecg'];
}
echo $ecg;
$node_num = $res->rowCount();*/
/*
$data = explode(";", $ecg);
sort($data,SORT_NUMERIC);
print_r($data);*/
?>