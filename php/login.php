<?php
session_start();
include_once"pdo_function.php";


if(!empty($_GET['username'])){
	
	$name = $_GET['username'];
	$psw = $_GET['password'];
	
	if(login_check($name,$psw)){
		$_SESSION['loginname'] = $name;
		echo "欢迎您,".$name;
	}
	else{
		echo "登录失败";
	}
}
?>