<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Galderak Kudeatu</title>
<script language = "javascript">
	XMLHttpRequestObject = new XMLHttpRequest();
	
	XMLHttpRequestObject.onreadystatechange=function(){
	//alert(XMLHttpRequestObject.readyState);
	if (XMLHttpRequestObject.readyState==4){	 
		document.getElementById("galderakBistaratu").innerHTML= XMLHttpRequestObject.responseText;
	}
}

function galderakIkusi(){
	XMLHttpRequestObject.open("GET", "galderakIkusi.php", true);
	XMLHttpRequestObject.send();
}

function galderaGorde(){
	gal= document.getElementById('f').Galdera.value;
	era= document.getElementById('f').Erantzuna.value;
	zai= document.getElementById('f').Zailtasuna.value;
	XMLHttpRequestObject.open("POST", "galderaGorde.php", true);
	XMLHttpRequestObject.send("galdera="+gal+"&erantzuna="+era+"&zailtasuna"+zai);
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
<div id="galderakBistaratu">
<p> </p>
</div>

<?php

?>