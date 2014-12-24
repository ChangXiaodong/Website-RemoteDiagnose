<?php
include_once"../API/API.php";
$remote_server = "http://v.juhe.cn/sms/send";
$app_key = "cc0d7238ff63e5c51894fb505f2cbdbd";
$mobile = '18511693747';
$model_id = 258;
if($_POST)
{
	$highpressure = $_POST['highpressure'];
	$lowpressure = $_POST['lowpressure'];
	$heart = $_POST['heart_beat'];
}
echo "ÒÑ·¢ËÍ";
$tpl_value=urlencode("#highpressure#=$highpressure&#lowpressure#=$lowpressure&#heart#=$heart");
$post_string = "key=$app_key&dtype=json&mobile=$mobile&tpl_id=$model_id&tpl_value=$tpl_value";
//$post_stream = new API_POST();
//$post_stream->request($remote_server,$post_string);
?>
