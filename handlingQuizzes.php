<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Galderak Kudeatu</title>
<script language = "javascript">
	
	
	
function galderakIkusi(){

	XMLHttpRequestObject = new XMLHttpRequest();
	
	XMLHttpRequestObject.onreadystatechange=function(){
	//alert(XMLHttpRequestObject.readyState);
	if (XMLHttpRequestObject.readyState==4){	 
		document.getElementById("galderakBistaratu").innerHTML= XMLHttpRequestObject.responseText;
	}
}

	XMLHttpRequestObject.open("GET", "galderakIkusi.php", true);
	XMLHttpRequestObject.send();
}

function galderaGorde(){

XMLHttpRequestObject = new XMLHttpRequest();
	
	XMLHttpRequestObject.onreadystatechange=function(){
	if (XMLHttpRequestObject.readyState==4){	 
		document.getElementById("galderakGorde").innerHTML= XMLHttpRequestObject.responseText;
	}
}

	var gal= document.getElementById("Galdera").value;
	var era= document.getElementById("Erantzuna").value;
	var zai= document.getElementById("Zailtasuna").value;
	XMLHttpRequestObject.open("POST", "galderaGorde.php", true);
	XMLHttpRequestObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	XMLHttpRequestObject.send("&Galdera="+gal+"&Erantzuna="+era+"&Zailtasuna="+zai);
}

</script>
<script type="text/javascript">
function hasieraraBueltatu(){
	window.location="layoutStudent.html";
}

</script>
</head>
<body>
<h1>Gehitu galdera: </h1>
<form  id="f" method="post" action="InsertQuestion.php">

Galdera:<br>
<input type="text" id="Galdera" name="Galdera"><br><br>

Erantzuna:<br>
<input type="text" id="Erantzuna" name="Erantzuna"><br><br>

Zailtasun-maila:<br>
<input type="text" id="Zailtasuna" name="Zailtasuna"><br><br>
<input type="button" id="Gorde" name="Gorde" value="Galdera gorde" onClick="galderaGorde()"/>
<input type="button" id="Ikusi" name="Ikusi" value="Galderak ikusi" onClick="galderakIkusi()"/>
</form>
<div id="galderakGorde">
<p> </p>
</div>
<div id="galderakBistaratu">
<p> </p>
</div>
<button onclick="hasieraraBueltatu()">Atzera</button>



<?php

?>