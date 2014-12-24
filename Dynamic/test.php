<?php
?>
<div id='draw'></div>
<script type="text/javascript">
var xmlHttp;
function A_xmlhttprequest() {
	if(window.ActiveXObject) {
		xmlHttp = new ActiveXObject('Microsoft.XMLHTTP');
	} else if(window.XMLHttpRequest) {
		xmlHttp = new XMLHttpRequest();
	}
}
function select(op) {
	A_xmlhttprequest();
	xmlHttp.open("GET","read.php?id="+op,true);
	xmlHttp.onreadystatechange = receive_op;
	xmlHttp.send(null);
	return false;
}
function receive_op() {
	var reveive =  xmlHttp.responseText;
	document.getElementById('draw').innerHTML = reveive;
	var s = reveive;
	buffer = s.split(";");
	alert("ok");
	return 1;
}
select(54);

</script>