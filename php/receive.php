<?php
include_once"pdo_function.php";
include_once"file.php";
include_once"../api/api.php";
$date =time();
$date = date("G_i_s",$date + 3600 * 8);//东8区时间

$name = '../data.//'.$date.'.txt';
$file = new file($name);
//if($_POST){

$highpressure = $_POST['highpressure'];
$lowpressure = $_POST['lowpressure'];
$heart_beat = $_POST['heart_beat'];
$weight = $_POST['weight'];
$username = $_POST['name'];
// $highpressure=rand(100,120);
// $lowpressure=rand(60,80);
// $heart_beat=rand(60,100);
// $weight=rand(60,80);
// $username = 2;
if($username == 1){
	$realname = 'xiaoxiami';
}
else if($username == 2){
	$realname = 'Father';
}
else if($username == 3){
	$realname = 'Monther';
}
else if($username == 4){
	$realname = 'Me';
}
else if($username == 5){
	$realname = 'Grandfather';
}
else if($username == 6){
	$realname = 'Grandmother';
}

pdo_insert_sensor($realname,$highpressure,$lowpressure,$heart_beat,$weight);
if($highpressure>120||$highpressure<100||$lowpressure<60||$lowpressure>80){
$post = new API_POST();
$tpl_temp = urlencode("#highpressure#=$highpressure&#lowpressure#=$lowpressure&#heart#=$heart_beat");
$post->request('http://v.juhe.cn/sms/send',"key=cc0d7238ff63e5c51894fb505f2cbdbd&dtype=json&mobile=18511693747&tpl_id=258&tpl_value=$tpl_temp");
}
//}
// $highpressure=107;
// $lowpressure=74;
// $heart_beat=80;
// $weight=70;
// $file->WriteChar($highpressure);
// $file->WriteChar($lowpressure);
// $file->WriteChar($heart_beat);
// $file->WriteChar($weight);
/*
$username = 'xiaoxiami';
pdo_insert_sensor($username,$highpressure,$lowpressure,$heart_beat,$weight);
echo 'ok';*/



/*
if(!empty($_POST['highpressure'])){
	$highpressure = $_POST['highpressure'];
	$file->WriteChar($highpressure);
}
if(!empty($_POST['lowpressure'])){
	$lowpressure = $_POST['lowpressure'];
	$file->WriteChar($lowpressure);
}
if(!empty($_POST['heart_beat'])){
	$heart_beat = $_POST['heart_beat'];
	$file->WriteChar($heart_beat);
}
if(!empty($_POST['weight'])){
	$weight = $_POST['weight'];
	$file->WriteChar($weight);
}*/



//	pdo_delete_sensor(139);
?>