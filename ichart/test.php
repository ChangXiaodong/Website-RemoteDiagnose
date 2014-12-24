<?php
	header('Content-type: text/html;charset=UTF-8');
?>
<script>
var xmlHttp;
function A_xmlhttprequest() {
	if(window.ActiveXObject) {
		xmlHttp = new ActiveXObject('Microsoft.XMLHTTP');
	} else if(window.XMLHttpRequest) {
		xmlHttp = new XMLHttpRequest();
	}
}
function showtype() {
	var send;
	if(type1.checked){
		send = 1;
	}
	if(type2.checked){
		send += 2*10;
	}
	if(type3.checked){
		send += 3*100;
	}
	if(type4.checked){
		send += 4*1000;
	}
	A_xmlhttprequest();
	xmlHttp.open("GET","back.php?type="+send,true);
	xmlHttp.onreadystatechange = receive_op;
	xmlHttp.send(null);
	return false;
}
function receive_op() {
	var reveive =  xmlHttp.responseText;
	
	document.getElementById('draw').innerHTML = reveive;
	return false;
}

</script>
<a href="#" onclick="select(1)">一小时内</a>
<a href="#" onclick="select(2)">三小时内</a>
<a href="#" onclick="select(3)">一天内</a>
<a href="#" onclick="select(4)">一个月</a>


<input type="checkbox" id="type1" onclick="showtype()">a
<input type="checkbox" id="type2" onclick="showtype()">b
<input type="checkbox" id="type3" onclick="showtype()">c
<input type="checkbox" id="type4" onclick="showtype()">d

<div id='draw'></div>
