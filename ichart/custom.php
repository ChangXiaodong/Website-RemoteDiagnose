
<script>
//PHP��JS������������ǰ����
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
		<title>���ݲ鿴</title>
		<link rel="stylesheet" type="text/css" href="../page/css/default.css" />
		<link rel="stylesheet" type="text/css" href="../page/css/component.css" />
		<script src="../page/js/modernizr.custom.js"></script>
	</head>
	<body>
		<div class="container">	
			<div class="main">
				<nav id="" class="nav">					
					<ul>
					<font face=����>
						<li>
							<a href="../index.html">
								<span class="icon">
									<i aria-hidden="true" class="icon-home"></i>
								</span>
								<span>��ҳ</span>
							</a>
						</li>
						<li>
							<a href="../abstract.html">
								<span class="icon">
									<i aria-hidden="true" class="icon-blog"></i>
								</span>
								<span>��Ʒ���</span>
							</a>
						</li>
						<li>
							<a href="onehour.php">
								<span class="icon">
									<i aria-hidden="true" class="icon-portfolio"></i>
								</span>
								<span>���ݲ鿴</span>
							</a>
						</li>
						<li>
							<a href="../dynamic/dynamic.php">
								<span class="icon"> 
									<i aria-hidden="true" class="icon-services"></i>
								</span>
								<span>�����Ϣ</span>
							</a>
						</li>
						
						<li>
							<a href="../about.html">
								<span class="icon">
									<i aria-hidden="true" class="icon-team"></i>
								</span>
								<span>��������</span>
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
	 /****************��ѯ���ݿ�***********************/
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
						<li><a href="onehour.php" >һСʱ</a></li>
						<li><a href="threehour.php" >��Сʱ</a></li>
						<li><a href="oneday.php" >һ��</a></li>
						<li><a href="oneweek.php" >һ��</a></li>
						<li><a href="onemonth.php" >һ����</a></li>
						<li><a href="threemonth.php" >������</a></li>
						<li><a href="custom.php" >�Զ���</a></li>
						
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
<input type="checkbox" id="type1" onclick="update()">����ѹ
<input type="checkbox" id="type2" onclick="update()">����ѹ
<input type="checkbox" id="type3" onclick="update()">����
<input type="checkbox" id="type4" onclick="update()">����
</div>

<div class="start">

<form  action="custom.php" method="post"  id="selectdate" name="select" onsubmit="">
��ʼ���ڣ�<input type="date" name="startdate" id ="startdate" required = "required" value = "<?php echo $startdatevalue?>"/>
<input type="time" name="starttime" id="starttime" required = "required" value="<?php echo $starttimevalue?>"/><br>
�������ڣ�<input type="date" name="enddate" id="enddate" value="<?php echo $enddatevalue?>" />
<input type="time" name="endtime" value="<?php echo $endtimevalue?>" id="endtime"/><br>
<input type="submit" name="set" value="�Զ���ʱ���ѯ"/>
</div>
</div>
<script type="text/javascript">
/*var highpreasure_form = document.getElementByName('highpreasure');
document.select.highpreasure;
document.getElementById('show').innerHTML = "a";*/
$(function(){
			var highpreasure_data=[],lowpreasure_data=[],heart_beat_data=[],weight_data=[],t;
			var data=[];
			var data1={name : '����ѹ',value:highpreasure_data,color:'#aad0db',line_width:2};
			var data2={name : '����ѹ',value:lowpreasure_data,color:'#f68f70',line_width:2};
			var data3={name : '�ĵ�',value:heart_beat_data,color:'#00EE76',line_width:2};
			var data4={name : '����',value:weight_data,color:'#8470FF',line_width:2};
			//����ѡ�������
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
		
			
					
			//����x���ǩ�ı�   
			//ʱ��
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
				title : '�Զ���ʱ��',
				footnote : 'СϺ�� V2.0.0',
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
						 //tip:��ʾ�����name:�������ơ�value:����ֵ��text:��ǰ�ı���i:���ݵ������
						parseText:function(tip,name,value,text,i){
							//return name+value;
							var backvalue = "ʱ�� "+time[i];
							/*if(document.select.highpreasure.checked){
								backvalue = backvalue + "<br>"+"�¶� " + highpreasure[i]
							}
							if(document.select.lowpreasure.checked){
								backvalue = backvalue + "<br>"+"ʪ�� " + lowpreasure[i]
							}*/
								return backvalue;
						}
					}

				},
				tipMocker:function(tips,i){
					//return "<div style='font-weight:1000'>"+
							//labels[i]+" "+//����
							//(((i%12)*2<10?"0":"")+(i%12)*2)+":00"+//ʱ��
							//time[i]+
							//"</div>"+tips.join("<br/>");
							//return "ʱ�� "+time[i]+"<br>"+"�¶� "+highpreasure[i]+"<br>"+"ʪ�� "+lowpreasure[i];
							 var backvalue = "����:"+date[i]+"<br>"+"ʱ��:"+time[i];
							 if(highpreasure_checked == 1){
								 backvalue = backvalue + "<br>"+"����ѹ:" + highpreasure[i] + "mmHg";
							 }
							 if(lowpreasure_checked == 1){
								 backvalue = backvalue + "<br>"+"����ѹ��" + lowpreasure[i]+ "mmHg"
							 }
							 if(heart_beat_checked == 1){
								 backvalue = backvalue + "<br>"+"����:" + heart_beat[i]+"/min"
							 }
							 if(weight_checked == 1){
								 backvalue = backvalue + "<br>"+"����:" + weight[i]+"Kg"
							 }
								 return backvalue;
				},
				
				legend : {
					enable : true,
					row:1,//������һ������ʾ����column���ʹ��
					column : 'max',
					valign:'top',
					sign:'bar',
					background_color:null,//����͸������
					offsetx:-80,//����x��ƫ�ƣ�����λ����Ҫ
					border : true
				},
				crosshair:{
					enable:true,
					line_color:'#62bce9'//ʮ���ߵ���ɫ
				},
				sub_option : {		//ƽ������
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
					//Y��̶�����
					scale:[{
						 position:'left',	
						 start_scale:50,			//��ʼ�̶�
						 end_scale:150,			//��ֹ�̶�
						 scale_space:20,			//ÿ�񳤶�
						 scale_size:2,			
						 scale_color:'#9f9f9f'
					},{
						 position:'bottom',	
						 labels:labels
					}]
				}
			});

		//��ʼ��ͼ
		chart.draw();

		//return false;
		});
		function update(){
			if(data_num == 0){
				document.getElementById('center').innerHTML = "û�п�����ʾ������";
			}
			var highpreasure_data=[],lowpreasure_data=[],heart_beat_data=[],weight_data=[],t;
			var data=[];
			var data1={name : '����ѹ',value:highpreasure_data,color:'#aad0db',line_width:2};
			var data2={name : '����ѹ',value:lowpreasure_data,color:'#f68f70',line_width:2};
			var data3={name : '����',value:heart_beat_data,color:'#00EE76',line_width:2};
			var data4={name : '����',value:weight_data,color:'#8470FF',line_width:2};
			//����ѡ�������
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

			//����x���ǩ�ı�   
			//ʱ��
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
				title : '�Զ���ʱ��',
				footnote : 'СϺ�� V2.0.0',
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
						 //tip:��ʾ�����name:�������ơ�value:����ֵ��text:��ǰ�ı���i:���ݵ������
						parseText:function(tip,name,value,text,i){
							//return name+value;
							var backvalue = "ʱ�� "+time[i];
							/*if(document.select.highpreasure.checked){
								backvalue = backvalue + "<br>"+"�¶� " + highpreasure[i]
							}
							if(document.select.lowpreasure.checked){
								backvalue = backvalue + "<br>"+"ʪ�� " + lowpreasure[i]
							}*/
								return backvalue;
						}
					}

				},
				tipMocker:function(tips,i){
					//return "<div style='font-weight:1000'>"+
							//labels[i]+" "+//����
							//(((i%12)*2<10?"0":"")+(i%12)*2)+":00"+//ʱ��
							//time[i]+
							//"</div>"+tips.join("<br/>");
							//return "ʱ�� "+time[i]+"<br>"+"�¶� "+highpreasure[i]+"<br>"+"ʪ�� "+lowpreasure[i];
							 var backvalue = "����:"+date[i]+"<br>"+"ʱ��:"+time[i];
							 if(type1.checked == 1){
								 backvalue = backvalue + "<br>"+"����ѹ:" + highpreasure[i] + "mmHg";
							 }
							 if(type2.checked == 1){
								 backvalue = backvalue + "<br>"+"����ѹ��" + lowpreasure[i]+ "mmHg"
							 }
							 if(type3.checked == 1){
								 backvalue = backvalue + "<br>"+"����:" + heart_beat[i]+"/min"
							 }
							 if(type4.checked == 1){
								 backvalue = backvalue + "<br>"+"����:" + weight[i]+"Kg"
							 }
								 return backvalue;
				},
				
				legend : {
					enable : true,
					row:1,//������һ������ʾ����column���ʹ��
					column : 'max',
					valign:'top',
					sign:'bar',
					background_color:null,//����͸������
					offsetx:-80,//����x��ƫ�ƣ�����λ����Ҫ
					border : true
				},
				crosshair:{
					enable:true,
					line_color:'#62bce9'//ʮ���ߵ���ɫ
				},
				sub_option : {		//ƽ������
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
					//Y��̶�����
					scale:[{
						 position:'left',	
						 start_scale:50,			//��ʼ�̶�
						 end_scale:150,			//��ֹ�̶�
						 scale_space:20,			//ÿ�񳤶�
						 scale_size:2,			
						 scale_color:'#9f9f9f'
					},{
						 position:'bottom',	
						 labels:labels
					}]
				}
			});

		//��ʼ��ͼ
		chart.draw();
		//return false;
		};

</script>
