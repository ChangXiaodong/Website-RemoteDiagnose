<?php
class API_POST
{
	function request($remote_server,$post_string){
	$context = array(
	'http'=>array(
	'method'=>'POST',
	'header'=>'Content-type: application/x-www-form-urlencoded'."\r\n",
	'User-Agent :xiaoxiami'."\r\n",
	'Content-length: '.strlen($post_string),
	'content'=>$post_string)
	);
	$stream_context = stream_context_create($context);
	$data = file_get_contents($remote_server,FALSE,$stream_context);
	return $data;
	}
}

?>