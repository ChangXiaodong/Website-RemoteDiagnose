<?php
/*
*Project:Homely 1.0
*Element:sigma_draw
*Program date:2014-06-01
*Author:xiaoxiami
*Method:				
*Remarks:需要加传参数的
*
*/
?>

<script>
//PHP向JS传参数，需提前声明
var highpreasure=[],date=[],time=[],data_num,lowpreasure=[];
var heart_beat = ['0'],weight=['0'];
var highpreasure_checked,lowpreasure_checked,heart_beat_checked,weight_checked,ecg_checked;
</script>

<?php
	header('Content-type: text/html;charset=UTF-8');
	$servername = "localhost";
	$username = "root";
	$password = "";	
	$start_time="2000-05-27 02:30:00";
	$end_time="2214-05-27 04:30:00";
	$type1="highpreasure";
	$type2="lowpreasure";
	$type3="heart_beat";
	$type4="weight";
	$type4="ecg";
	$select_type = "";
	$a = 0;
	if($_POST)
	{
		echo $startdate = $_POST['startdate'];
		echo $starttime = $_POST['starttime'];
		$start_time = $startdate." ".$starttime;
		echo $enddate = $_POST['enddate'];
		echo $endtime = $_POST['endtime'];	
		$end_time = $enddate." ".$endtime;

		if(!empty($_POST['highpreasure']))
		{
			echo "<script>highpreasure_checked = 1;</script>";
			$select_type = $select_type.$type1.',';
		}
		if(!empty($_POST['lowpreasure']))
		{
			echo "<script>lowpreasure_checked = 1;</script>";
			$select_type = $select_type.$type2.',';
		}
		if(!empty($_POST['heart_beat']))
		{
			echo "<script>heart_beat_checked = 1;</script>";
			$select_type = $select_type.$type3.',';
		}
		if(!empty($_POST['weight']))
		{
			echo "<script>weight_checked = 1;</script>";
			$select_type = $select_type.$type4.',';
		}
		if(!empty($_POST['ecg']))
		{
			echo "<script>ecg_checked = 1;</script>";
			//$select_type = $select_type.$type5.',';
		}
		$select_type = $select_type.'date';

		//$typevalue = $_POST['typevalue'];
		//print_r($typevalue);
		//echo count($typevalue);
	}
	$dbh  = new  PDO ("mysql:host=localhost;dbname=intel_values",$username,$password );
	/****************查询数据库***********************/
		$res = $dbh->query("SELECT $select_type FROM userdata where date between \"$start_time\" AND \"$end_time\"",PDO::FETCH_ASSOC);	
		$i=0;
		$result_arr = $res->fetchAll();
		
		foreach($result_arr as $r){		
			//print_r($b);
			//echo "<br>";
			$date = substr($r['date'],0,10);
			$date_buf = "\"$date\"";
			echo "<script>date[$a] = $date_buf;</script>";
			
			$time = substr($r['date'],10);
			$date_buf = "\"$time\"";
			echo "<script>time[$a] = $date_buf;</script>";
			if(!empty($r['highpreasure'])){
				$buffer = $r['highpreasure'];
				echo "<script>highpreasure[$a] = $buffer;</script>";
			}
			else
				echo "<script>highpreasure[$a] = 0;</script>";
			if(!empty($r['lowpreasure'])){
				$buffer = $r['lowpreasure'];
				echo "<script>lowpreasure[$a] = $buffer;</script>";
			}
			else
				echo "<script>lowpreasure[$a] = 0;</script>";
			if(!empty($r['heart_beat'])){
				$buffer = $r['heart_beat'];
				echo "<script>heart_beat[$a] = $buffer;</script>";
			}
			else
				echo "<script>heart_beat[$a] = 0;</script>";
			if(!empty($r['weight'])){
				$buffer = $r['weight'];
				echo "<script>weight[$a] = $buffer;</script>";
			}
			else
				echo "<script>weight[$a] = 0;</script>";
			$a++;
		}
		$node_num = $res->rowCount();
		echo "<script>data_num = $node_num;</script>";
		/*****************************************/
	

	/*echo "<br>";
	print_r($r);
	echo "<br>";*/
?>

<div id='canvasDiv'></div>
<script type="text/javascript" src="ichart.1.2.min.js"></script>
<script type="text/javascript">
/*var highpreasure_form = document.getElementByName('highpreasure');
document.select.highpreasure;
document.getElementById('show').innerHTML = "a";*/
if(ecg_checked == 1&&highpreasure_checked!=1&&lowpreasure_checked!=1&&heart_beat_checked!=1&&weight_checked!=1){
	window.location.href="../Dynamic/dynamic.html";
	
}
else{
		$(function(){
			var highpreasure_data=[],lowpreasure_data=[],heart_beat_data=[],weight_data=[],t;
			var data=[];
			var data1={name : '收缩压',value:highpreasure_data,color:'#aad0db',line_width:2};
			var data2={name : '舒张压',value:lowpreasure_data,color:'#f68f70',line_width:2};
			var data3={name : '心电',value:heart_beat_data,color:'#00EE76',line_width:2};
			var data4={name : '心率',value:weight_data,color:'#8470FF',line_width:2};
			//根据选项传入数组
			for(var i=0;i<data_num;i++){
				t = highpreasure[i];
				highpreasure_data.push(t);
				t = lowpreasure[i];
				lowpreasure_data.push(t);
				t = heart_beat[i];
				heart_beat_data.push(t);
				t = weight[i];
				weight_data.push(t);
			}
			if(highpreasure_checked == 1){
				data.push(data1);
			}
			if(lowpreasure_checked == 1){
				data.push(data2);
			}
			if(heart_beat_checked == 1){
				data.push(data3);
			}
			if(weight_checked == 1){
				data.push(data4);	
			}
			
					/*var data = [
									{
										name : '温度',
										value:wendu,
										color:'#aad0db',
										line_width:2
									},
									{
										name : '湿度',
										value:shidu,
										color:'#f68f70',
										line_width:2
									},
									{
										name : 'heart_beat',
										value:heart_beat,
										color:'#00EE76',
										line_width:2
									},
									{
										name : 'weight',
										value:weight,
										color:'#8470FF',
										line_width:2
									},
								 ];*/
			//创建x轴标签文本   
			//时间
			//var date = new Date()
			//date.setDate(date.getDate()-6);
			var labels = [];
			/*for(var i=0;i<6;i++){
				date.setDate(date.getDate()+1);
				labels.push(date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate());
			}*/
			for(var i=0;i<data_num;i++){
				//labels.push(date[i]);
				if(i%5 == 0)
				labels.push(i);
			}
			
			var chart = new iChart.LineBasic2D({
				//sub_option:{smooth:true,point_size:8,},
				animation: true,
				render : 'canvasDiv',
				data: data,
				align:'center',
				title : '数据采集',
				subtitle : '小虾米 V1.0.0',
				footnote : '数据来源：模拟数据',
				width : 800,
				height : 400,
				background_color:'#FEFEFE',
				tip:{
					enable:true,
					shadow:true,
					move_duration:400,
					border:{
						 enable:true,
						 radius : 5,
						 width:2,
						 //color:'#3f8695'
					},
					listeners:{
						 //tip:提示框对象、name:数据名称、value:数据值、text:当前文本、i:数据点的索引
						parseText:function(tip,name,value,text,i){
							//return name+value;
							var backvalue = "时间 "+time[i];
							/*if(document.select.highpreasure.checked){
								backvalue = backvalue + "<br>"+"温度 " + highpreasure[i]
							}
							if(document.select.lowpreasure.checked){
								backvalue = backvalue + "<br>"+"湿度 " + lowpreasure[i]
							}*/
								return backvalue;
						}
					}

				},
				tipMocker:function(tips,i){
					//return "<div style='font-weight:1000'>"+
							//labels[i]+" "+//日期
							//(((i%12)*2<10?"0":"")+(i%12)*2)+":00"+//时间
							//time[i]+
							//"</div>"+tips.join("<br/>");
							//return "时间 "+time[i]+"<br>"+"温度 "+highpreasure[i]+"<br>"+"湿度 "+lowpreasure[i];
							 var backvalue = "日期:"+date[i]+"<br>"+"时间:"+time[i];
							 if(highpreasure_checked == 1){
								 backvalue = backvalue + "<br>"+"收缩压:" + highpreasure[i] + "mmHg";
							 }
							 if(lowpreasure_checked == 1){
								 backvalue = backvalue + "<br>"+"舒张压：" + lowpreasure[i]+ "mmHg"
							 }
							 if(heart_beat_checked == 1){
								 backvalue = backvalue + "<br>"+"心率:" + heart_beat[i]+"/min"
							 }
							 if(weight_checked == 1){
								 backvalue = backvalue + "<br>"+"体重:" + weight[i]+"Kg"
							 }
								 return backvalue;
				},
				
				legend : {
					enable : true,
					row:1,//设置在一行上显示，与column配合使用
					column : 'max',
					valign:'top',
					sign:'bar',
					background_color:null,//设置透明背景
					offsetx:-80,//设置x轴偏移，满足位置需要
					border : true
				},
				crosshair:{
					enable:true,
					line_color:'#62bce9'//十字线的颜色
				},
				sub_option : {		//平滑曲线
					label:false,
					smooth:true,
					point_size:10
				},
				coordinate:{
					width:640,
					height:240,
					axis:{
						color:'#dcdcdc',
						width:1
					},
					//Y轴刻度设置
					scale:[{
						 position:'left',	
						 start_scale:50,			//起始刻度
						 end_scale:150,			//终止刻度
						 scale_space:20,			//每格长度
						 scale_size:2,			
						 scale_color:'#9f9f9f'
					},{
						 position:'bottom',	
						 labels:labels
					}]
				}
			});

		//开始画图
		chart.draw();

		//return false;
		});
}
</script>
