<?php //date_default_timezone_set("PRC");
/*
*Project:Homely 1.0
*Element:pdo_access
*Program date:2014-05-23
*Author:xiaoxiami
*Method:PDO������
*	
*Remarks:
*
*/
session_start();
include_once"pdo_function.php";

$servername = "localhost";
$username = "root";
$password = "";
$login_database = "intel_user";//��½��
$datavalue_database = "intel_values";//���ݴ�����


if(!empty($_POST['username'])){
	
	$name = $_POST['username'];
	$psw = $_POST['password'];
	$_SESSION['loginname'] = $name;
	if(login_check($name,$psw)){
		echo "��½�ɹ�";
		header("Location: http://localhost/intel/ichart/draw.html");
	}
	else{
		echo "��¼ʧ��";
	}
}

?>
