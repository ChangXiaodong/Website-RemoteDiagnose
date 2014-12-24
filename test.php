<?php
	$select_type = "highpreasure,lowpreasure,heart_beat,weight,date";
		$date =time();
	$end_time = date("Y-m-d G:i:s",$date + 3600 * 8);
	$enddatevalue=substr($end_time,0,10);
	$endtimevalue = date("H:i",$date + 3600 * 8);
	
	$starttime = date("G:i:s",$date + 3600 * 8-3600*8*20);
	$startdate = date("Y-m-d",$date + 3600 * 8-3600*8*20);
	 $start_time = $startdate." ".$starttime;
	$startdatevalue=$startdate;
	$starttimevalue = date("H:i",$date + 3600 * 8-3600*8*20);
$dbh  = new  PDO ("mysql:host=localhost;dbname=intel_values","root","");
 $res = $dbh->query("SELECT $select_type FROM userdata where username='tommycxd' and date between \"$start_time\" AND \"$end_time\"",PDO::FETCH_ASSOC);	
		 $result_arr = $res->fetchAll();
		
		 foreach($result_arr as $r){
		 print_r($r);
		 }
?>