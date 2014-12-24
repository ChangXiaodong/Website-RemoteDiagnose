<?php
?>
<html>


<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<title>心率 </title>
<link rel="stylesheet" type="text/css" href="../page/css/default.css" />
<link rel="stylesheet" type="text/css" href="../page/css/component.css" />
<script src="../page/js/modernizr.custom.js"></script>
		<div class="container">	
			<div class="main clearfix">
				<nav id="menu" class="nav">					
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
							<a href="../ichart/onehour.php">
								<span class="icon">
									<i aria-hidden="true" class="icon-portfolio"></i>
								</span>
								<span>数据查看</span>
							</a>
						</li>
						<li>
							<a href="diagnose.html">
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
</html>
<input type="time" id='mytime' name='mytime'>
<div id="draw"></div>
<div id="draw1"></div>
<div id="draw2"></div>
<script type='text/javascript' src='js/jquery-1.9.1.min.js'></script>
<script type='text/javascript' src='js/jquery.flot.js'></script>    
<div class="head">
	<h2  align="center">动态曲线</h2>
</div>
<div class="data">
<div id="chart-4" style="height: 300px;width:70%;left:200px;"></div>
</div>


<script type="text/javascript">
var xmlHttp;
var buffer = new Array();
var res = new Array();
var count = 0;
var sec = 0;
var aa = 0;
var set_flag = 0;
var timevalue = 0;
function A_xmlhttprequest() {
	if(window.ActiveXObject) {
		xmlHttp = new ActiveXObject('Microsoft.XMLHTTP');
	} else if(window.XMLHttpRequest) {
		xmlHttp = new XMLHttpRequest();
	}
}
/*
function select(op) {
	A_xmlhttprequest();
	xmlHttp.open("GET","read.php?id="+op,true);
	xmlHttp.onreadystatechange = receive_op;
	xmlHttp.send(null);
	return false;
}*/

function select() {
	A_xmlhttprequest();
	xmlHttp.open("GET","read.php?time="+mytime.value,true);
	xmlHttp.onreadystatechange = receive_op;
	xmlHttp.send(null);
	return false;
}
function receive_op() {
	var reveive =  xmlHttp.responseText;
	var i=0;
	buffer = reveive.split(";");
	//document.getElementById('draw').innerHTML = buffer.length;
	return 1;
}

$(window).load(function(){
	var myDate = new Date(); 
	var hour=myDate.getHours();
	var minutes=myDate.getMinutes();
	if(hour<10){
		hour='0'+hour;
	}
	if(minutes<10){
		minutes='0'+minutes;
	}
	timevalue = hour+':'+minutes; 
	mytime.value=timevalue;
	sec=223;
	var min_value = -8000;
	var max_value = 8000;
	var ForReading=1; 
	var bei = 1;
    if($("#chart-4").length > 0){
        var data = [], totalPoints = 800/bei;	//数据总数
        var updateInterval = 1;   //扫面时间  单位ms
        var plot = $.plot($("#chart-4"), [ getData() ], {
            series: { shadowSize: 0 }, //线阴影
            yaxis: { min: min_value, max: max_value },
            xaxis: { show: false }  //背景网格
        });
		buffer.length = 0;
		
        update(); 
    }
    function update() {

        plot.setData([ getData() ]);
        // since the axes don't change, we don't need to call plot.setupGrid()
        plot.draw();
        setTimeout(update, updateInterval);
    }
    function getData() {
		var y;
        if (data.length > 0)
            data = data.slice(1);
        // do a random walk
		if(set_flag==1){
					if(buffer.length>10){
						y =  buffer[count++*bei];
						//document.write(y+"\n");
						data.push(y);
					}
					else{
						data.push(0);
					}
					
			}
		else{
				while (data.length < totalPoints) {
				y =  0;
				data.push(y);
				set_flag = 1;
			}
			select();
		}
		
		//document.getElementById('draw').innerHTML = count;
		//document.getElementById('draw1').innerHTML = buffer.length;
		if(count*bei>=buffer.length){
			count = 0;
			select();
		}
        // zip the generated y values with the x values
		res.length = 0;
        for (var i = 0; i < data.length; ++i)
            res.push([i, data[i]])
        return res;
    }
	//指定位置显示
    function showTooltip(x, y, contents) {
        $('<div class="ct">' + contents + '</div>').css( {
            position: 'absolute',
            display: 'none',
            top: y,
            left: x + 10,
            border: '1px solid #000',
            padding: '3px',
            opacity: '0.7',
            'background-color': '#000',            
            color: '#fff'            
        }).appendTo("body").fadeIn(200);
    }    

    var previousPoint = null;
    
});

</script>
