
<script>
//PHP向JS传参数，需提前声明
var highpreasure=[],date=[],time=[],data_num,lowpreasure=[];
var heart_beat = ['0'],weight=['0'];
var start_datevalue,start_timevalue,end_datevalue,end_timevalue;
</script>


<div id='draw'></div>
<html lang="en" class="no-js">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>数据查看</title>
		<link rel="stylesheet" type="text/css" href="../page/css/default.css" />
		<link rel="stylesheet" type="text/css" href="../page/css/component.css" />
		<script src="../page/js/modernizr.custom.js"></script>
	</head>
	<body>
		<div class="container">	
			<div class="main">
				<nav id="" class="nav">					
					<ul>
					<font face=黑体>
						<li>
							<a href="../index.html">
								<span class="icon">
									<i aria-hidden="true" class="icon-home"></i>
								</span>
								<span>主页</span>
							</a>
						</li>
						<li>
							<a href="../abstract.html">
								<span class="icon">
									<i aria-hidden="true" class="icon-blog"></i>
								</span>
								<span>产品简介</span>
							</a>
						</li>
						<li>
							<a href="onehour.php">
								<span class="icon">
									<i aria-hidden="true" class="icon-portfolio"></i>
								</span>
								<span>数据查看</span>
							</a>
						</li>
						<li>
							<a href="../dynamic/dynamic.php">
								<span class="icon"> 
									<i aria-hidden="true" class="icon-services"></i>
								</span>
								<span>诊断信息</span>
							</a>
						</li>
						
						<li>
							<a href="../about.html">
								<span class="icon">
									<i aria-hidden="true" class="icon-team"></i>
								</span>
								<span>关于我们</span>
							</a>
						</li>
					</font>
					</ul>
				</nav>
			</div>
		</div><!-- /container -->
	</body>
</html>
<?php
	header('Content-type: text/html;charset=gb2312');
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
	$select_type = "highpreasure,lowpreasure,heart_beat,weight,date";
	$a = 0;
	if($_POST){
		$startdatevalue = $_POST['startdate'];
		$starttimevalue = $_POST['starttime'];
		$enddatevalue = $_POST['enddate'];
		$endtimevalue = $_POST['endtime'];
		$start_time = $startdatevalue.' '.$starttimevalue;
		$end_time = $enddatevalue.' '.$endtimevalue;
	}
	
	
	 $dbh  = new  PDO ("mysql:host=localhost;dbname=intel_values","root","");
	 /****************查询数据库***********************/
		 $res = $dbh->query("SELECT $select_type FROM userdata where date between \"$start_time\" AND \"$end_time\"",PDO::FETCH_ASSOC);	
		 $result_arr = $res->fetchAll();
		
		 foreach($result_arr as $r){		
			//print_r($r);
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
		//echo "<br>";
		$node_num = $res->rowCount();
		echo "<script>data_num = $node_num;</script>";
		/*****************************************/
		

	// /*echo "<br>";
	// print_r($r);
	// echo "<br>";*/
?>



<html>
	<!-- STYLES -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="slip/stylesheets/reset.css">
	<link rel="stylesheet" type="text/css" href="slip/stylesheets/typography.css">
	<link rel="stylesheet" type="text/css" href="slip/stylesheets/styles.css">
	<link rel="stylesheet" type="text/css" href="slip/stylesheets/github.css">
	<link rel="stylesheet" type="text/css" href="css/draw.css">

<!--[if lt IE 7]>  <body class="ie ie6 lte9 lte8 lte7"> <![endif]-->
<!--[if IE 7]>     <body class="ie ie7 lte9 lte8 lte7"> <![endif]-->
<!--[if IE 8]>     <body class="ie ie8 lte9 lte8">      <![endif]-->
<!--[if IE 9]>     <body class="ie ie9 lte9">           <![endif]-->
<!--[if gt IE 9]>  <body class="ie">                    <![endif]-->
<!--[if !IE]><!-->                            <!--<![endif]-->
<div id="wrapper">
	<!-- HEADER ends -->
	<!-- MAIN CONTAINER -->
	<div id="body_wrapper">
		<!-- CONTENT -->
		<!-- CONTENT ends-->
		<section>

			<article>
				<div class='tabs'>
					<ul class='horizontal'>
						<li><a href="onehour.php" >一小时</a></li>
						<li><a href="threehour.php" >三小时</a></li>
						<li><a href="oneday.php" >一天</a></li>
						<li><a href="oneweek.php" >一周</a></li>
						<li><a href="onemonth.php" >一个月</a></li>
						<li><a href="threemonth.php" >三个月</a></li>
						<li><a href="custom.php" >自定义</a></li>
						
					</ul>
			</article>
		</section>	
	</div>
	<!-- MAIN CONTAINER ends -->
</div>

</html>
<div id='center' class="center"></div>
<div class="draw_box">
<div id='canvasDiv' class="canvasDiv" ></div>

<script type="text/javascript" src="ichart.1.2.min.js"></script>
<div class='checktype'>
<input type="checkbox" id="type1" onclick="update()">收缩压
<input type="checkbox" id="type2" onclick="update()">舒张压
<input type="checkbox" id="type3" onclick="update()">心率
<input type="checkbox" id="type4" onclick="update()">体重
</div>

<div class="start">

<form  action="custom.php" method="post"  id="selectdate" name="select" onsubmit="">
开始日期：<input type="date" name="startdate" id ="startdate" required = "required" value = "<?php echo $startdatevalue?>"/>
<input type="time" name="starttime" id="starttime" required = "required" value="<?php echo $starttimevalue?>"/><br>
结束日期：<input type="date" name="enddate" id="enddate" value="<?php echo $enddatevalue?>" />
<input type="time" name="endtime" value="<?php echo $endtimevalue?>" id="endtime"/><br>
<input type="submit" name="set" value="自定义时间查询"/>
</div>
</div>
<script type="text/javascript">
/*var highpreasure_form = document.getElementByName('highpreasure');
document.select.highpreasure;
document.getElementById('show').innerHTML = "a";*/
$(function(){
			var highpreasure_data=[],lowpreasure_data=[],heart_beat_data=[],weight_data=[],t;
			var data=[];
			var data1={name : '收缩压',value:highpreasure_data,color:'#aad0db',line_width:2};
			var data2={name : '舒张压',value:lowpreasure_data,color:'#f68f70',line_width:2};
			var data3={name : '心电',value:heart_beat_data,color:'#00EE76',line_width:2};
			var data4={name : '心率',value:weight_data,color:'#8470FF',line_width:2};
			//根据选项传入数组
			for(var i=0;i<10;i++){
				t = 0;
				highpreasure_data.push(t);
				t = lowpreasure[i];
				lowpreasure_data.push(t);
				t = heart_beat[i];
				heart_beat_data.push(t);
				t = weight[i];
				weight_data.push(t);
			}
				data.push(data1);
		
			
					
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
				title : '自定义时间',
				footnote : '小虾米 V2.0.0',
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
		function update(){
			if(data_num == 0){
				document.getElementById('center').innerHTML = "没有可以显示的数据";
			}
			var highpreasure_data=[],lowpreasure_data=[],heart_beat_data=[],weight_data=[],t;
			var data=[];
			var data1={name : '收缩压',value:highpreasure_data,color:'#aad0db',line_width:2};
			var data2={name : '舒张压',value:lowpreasure_data,color:'#f68f70',line_width:2};
			var data3={name : '心率',value:heart_beat_data,color:'#00EE76',line_width:2};
			var data4={name : '体重',value:weight_data,color:'#8470FF',line_width:2};
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
			if(type1.checked == 1){
				data.push(data1);
			}
			if(type2.checked == 1){
				data.push(data2);
			}
			if(type3.checked == 1){
				data.push(data3);
			}
			if(type4.checked == 1){
				data.push(data4);	
			}

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
				title : '自定义时间',
				footnote : '小虾米 V2.0.0',
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
							 if(type1.checked == 1){
								 backvalue = backvalue + "<br>"+"收缩压:" + highpreasure[i] + "mmHg";
							 }
							 if(type2.checked == 1){
								 backvalue = backvalue + "<br>"+"舒张压：" + lowpreasure[i]+ "mmHg"
							 }
							 if(type3.checked == 1){
								 backvalue = backvalue + "<br>"+"心率:" + heart_beat[i]+"/min"
							 }
							 if(type4.checked == 1){
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
		};

</script>
