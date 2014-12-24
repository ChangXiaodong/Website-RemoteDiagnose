<?php
include_once"API.php";
include_once"../php/file.php";
$name = 'msg.txt';
$file = new file($name);

$highpressure=$_POST['highpressure'];
$lowpressure=$_POST['lowpressure'];
$heart=$_POST['heart_beat'];
$phone=$_POST['phone'];
/*$highpressure=102;
$lowpressure=73;
$heart=69;
$phone='18511693747';*/

$file->WriteChar($highpressure);
$file->WriteChar($lowpressure);
$file->WriteChar($heart);
$file->WriteChar($phone);

$post = new API_POST();
$tpl_temp = urlencode("#highpressure#=$highpressure&#lowpressure#=$lowpressure&#heart#=$heart");
//echo $post->request('http://v.juhe.cn/sms/send',"key=cc0d7238ff63e5c51894fb505f2cbdbd&dtype=json&mobile=$phone&tpl_id=258&tpl_value=$tpl_temp");
?>