<?php
/*
*Project:Homely 1.0
*Element:pdo_function
*Program date:2014-05-23
*Author:xiaoxiami
*Method:				
*Remarks:
*
*/
$servername = "localhost";
$username = "root";
$password = "";	
$login_database = "intel_user";//登陆表
$datavalue_database = "intel_values";//数据存数表
$num = 8;
/*
*Name;login_check
*Input:	$name:用户名  $psw:密码
*Output:Success  1,False 0
*Method:从数据库里检查登陆是否合法
*/
function login_check($name,$psw){
	global $servername;
	global $username;
	global $password;
	global $login_database;
	try{
		$dbh  = new  PDO ("mysql:host=localhost;dbname=$login_database",$username,$password );
	} 
	catch ( PDOException $e ) {
		print  "Error!: ".$e->getMessage ()."<br/>" ;
		die();
	}
	$stmt  =  $dbh -> prepare ( "SELECT password FROM login where name LIKE '$name'" );
	$stmt -> execute ();
	$rowsNumber = $stmt->fetchColumn();//存储用户名为$name的密码
	if($rowsNumber == $psw){
		
		return 1;
	}
	else{
		
		return 0;
	}
}
/*
*Name;pdo_insert_sensor
*Input:	$name:用户名  $value1:值1	$value2:值2		$heart_beat:值3
*Output:NONE
*Method:把传感器数据和用户名和时间写入数据库
*/
function pdo_insert_sensor($name,$highpreasure,$lowpreasure,$heart_beat,$weight){
	global $datavalue_database;
	global $username;
	global $password;
	try {
    $dbh  = new  PDO ("mysql:host=localhost;dbname=intel_values",'root','' );
	} 
	catch ( PDOException $e ) {
		print  "Error!: "  .  $e -> getMessage () .  "<br/>" ;
		die();
	}
	$date =time();
	$date = date("y-m-d G:i:s ",$date + 3600*8);//东8区时间
	$stmt  =  $dbh -> prepare ( "INSERT INTO userdata (username,date,highpreasure,lowpreasure,heart_beat,weight) 
												VALUES (:username,:date,:highpreasure,:lowpreasure,:heart_beat,:weight)" );

	$stmt -> bindParam ( ':username' ,  $name );
	$stmt -> bindParam ( ':date' ,  $date);
	$stmt -> bindParam ( ':highpreasure' ,  $highpreasure );
	$stmt -> bindParam ( ':lowpreasure' ,  $lowpreasure );
	$stmt -> bindParam ( ':heart_beat' ,  $heart_beat );
	$stmt -> bindParam ( ':weight' ,  $weight );
	$stmt -> execute ();//执行插入
}
/*
*Name;pdo_read_sensor
*Input:	$start_time:起始时间 $end_time:终止时间  $type:传感器类型
*Output:Success  1,False 0
*Method:从数据库中读取对应数据
*/
function pdo_read_sensor($start_time,$end_time,$type){
	global $username;
	global $password;
	global $datavalue_database;
	
	$dbh  = new  PDO ("mysql:host=localhost;dbname=$datavalue_database",$username,$password );
	/*$stmt  =  $dbh -> prepare ( "SELECT $type,date FROM userdata where date between \"$start_time\" AND \"$end_time\"");
	if ( $stmt -> execute ()) {
	  while ( $row  =  $stmt -> fetch ()) {
	  $row  =  $stmt -> fetch ();
		print_r ( $row );
	  }
	}*/
	$res = $dbh->query("SELECT $type,date FROM userdata where date between \"$start_time\" AND \"$end_time\"",PDO::FETCH_ASSOC);	
	/*foreach ($res as $row) {
		print_r ( $row );
	}*/
	$select_num = $res->rowCount();
	return $res;
}
function pdo_read_ecg($id){
	global $username;
	global $password;
	global $datavalue_database;
	
	$dbh  = new  PDO ("mysql:host=localhost;dbname=$datavalue_database",$username,$password );

	$res = $dbh->query("SELECT ecg FROM ecg where id=\"$id\"");
	foreach ($res as $row) {
		//print_r ( $row );
		return $row['ecg'];
	}

}
function pdo_insert_ecg($data){
	global $datavalue_database;
	global $username;
	global $password;
	$date =time();
	$time = date("Y-m-d G:i:s",$date + 3600 * 8);
	try {
    $dbh  = new  PDO ("mysql:host=localhost;dbname=$datavalue_database",$username,$password );
	} 
	catch ( PDOException $e ) {
		print  "Error!: "  .  $e -> getMessage () .  "<br/>" ;
		die();
	}
	$stmt  =  $dbh -> prepare ( "INSERT INTO ecg (ecg,time) VALUES (:ecg,:time)" );
	$stmt -> bindParam ( ':ecg' ,  $data );
	$stmt -> bindParam ( ':time' ,  $time );
	$stmt -> execute ();//执行插入
}
?>