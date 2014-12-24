var xmlHttp;
function A_xmlhttprequest() {
	if(window.ActiveXObject) {
		xmlHttp = new ActiveXObject('Microsoft.XMLHTTP');
	} else if(window.XMLHttpRequest) {
		xmlHttp = new XMLHttpRequest();
	}
}
function select(op) {
	/*A_xmlhttprequest();
	xmlHttp.open("GET","back.php?type="+op,true);
	xmlHttp.onreadystatechange = receive_op;
	xmlHttp.send(null);
	return false;*/
	alert("123");
}
function receive_op() {
	var reveive =  xmlHttp.responseText;
	
	document.getElementById('draw').innerHTML = reveive;
	return false;
}
