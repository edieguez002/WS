<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Erregistratu</title>

<script type="text/javascript">
function bidaliEposta(){
	XMLHttpRequestObject = new XMLHttpRequest();
	
	XMLHttpRequestObject.onreadystatechange=function(){
	if (XMLHttpRequestObject.readyState==4){	 
		document.getElementById("epostaErantzuna").innerHTML= XMLHttpRequestObject.responseText;
	}
}

	var email= document.getElementById("Eposta").value;
	XMLHttpRequestObject.open("POST", "egiaztatuMatrikulaAJAX.php", true);
	XMLHttpRequestObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	XMLHttpRequestObject.send("&Eposta="+email);
}
</script>

<script type="text/javascript">
function bidaliPasahitza(){
	XMLHttpRequestObject = new XMLHttpRequest();
	
	XMLHttpRequestObject.onreadystatechange=function(){
	if (XMLHttpRequestObject.readyState==4){	 
		document.getElementById("pasahitzaErantzuna").innerHTML= XMLHttpRequestObject.responseText;
	}
}

	var pasahitza= document.getElementById("Pasahitza").value;
	var pasahitza2= document.getElementById("Pasahitza2").value;
	XMLHttpRequestObject.open("POST", "egiaztatuPasAJAX.php", true);
	XMLHttpRequestObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	XMLHttpRequestObject.send("&Pasahitza="+pasahitza+"&Pasahitza2="+pasahitza2);
}
</script>
</head>
<form id="erregistro" name="erregistro" action="simpleReg.php" method="post">

Eposta(*):<br>
<input type="text" id="Eposta" name="Eposta" onchange="bidaliEposta()">
<br><br>

Pasahitza(*):<br>
<input type="password" id="Pasahitza" name="Pasahitza">
<br><br>

Berridatzi Pasahitza(*):<br>
<input type="password" id="Pasahitza2" name="Pasahitza2" onchange="bidaliPasahitza()">
<br><br>

<input type="submit" id="submit" value="submit"/>
<button onclick="history.back()">Atzera</button>
</form>
<div id="epostaErantzuna">
<p> </p>
</div>
<br>
<div id="pasahitzaErantzuna">
<p> </p>
</div>
</html>