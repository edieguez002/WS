<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Password recovery</title>
<script type="text/javascript">

<script language="javascript">
function izenaEgiaztatu(){
	var izena= document.getElementById("Izena").value;
	
	if(izena.length==0){
		alert("Izena derrigorrezkoa da.");
		return false;
	}
	return true;
}
</script>

<script language="javascript">
function abizenaEgiaztatu(){
	var abizena= document.getElementById("Abizena").value;
	
	if(abizena.length==0){
		alert("Abizena derrigorrezkoa da.");
		return false;
	}
	return true;
}
</script>

<script language="javascript">
function epostaEgiaztatu(){
	var eposta= document.getElementById("Eposta").value;
	if((/[a-zA-Z]+[0-9]{3}@ikasle(\.e)hu.es$/.test(eposta)) || (/[a-zA-Z]+[0-9]{3}@ikasle(\.e)hu.eus$/.test(eposta))){
		
		return true;
	}else{
			alert("Epostaren egitura: Hizkiak + 3 digitu + @ikasle.ehu. eus edo es");
			return false;
		}
}
</script>

<script language="javascript">
function pasahitzaEgiaztatu(){
	var pasahitza1= document.getElementById("Pasahitza1").value;
	var pasahitza2= document.getElementById("Pasahitza2").value;
	if(pasahitza.length<6 && pasahitza1!=pasahitza2){
		alert("Pasahitzak 6 karaktere baino gehiago eduki behar ditu eta berdinak izan behar dira.");
		return false;
	}
	return true;
}
</script>

<script language="javascript">
function balioakEgiaztatu(){
	if(izenaEgiaztatu()==false){
		return false;
	}
	if(abizenaEgiaztatu()==false){
		return false;
	}
	if(epostaEgiaztatu()==false){
		alert("Epostaren egitura: Hizkiak + 3 digitu + @ikasle.ehu. eus edo es");
		return false;
	}
	if(pasahitzaEgiaztatu()==false){
		return false;
	}
	
	return true;
}
</script>

<script type="text/javascript">
function atzera()
{
	window.location="layout.html";
}
</script>

</head>
<body>
<h1>Password recovery</h1>
<form id="erregistro" name="erregistro" onsubmit="return balioakEgiaztatu()" action="PasahitzaAldatu.php" method="post" enctype="multipart/form-data">

Izena(*):<br>
<input type="text" id="Izena" name="Izena">
<br><br>
Abizena(*):<br>
<input type="text" id="Abizena" name="Abizena">
<br><br>
Eposta(*):<br>
<input type="text" id="Eposta" name="Eposta" onchange="bidaliEposta()">
<div id="epostaErantzuna">
<p> </p>
</div>
<br><br>

Pasahitza(*):<br>
<input type="password" id="Pasahitza1" name="Pasahitza1">
<div id="pasahitzaErantzuna">
<p> </p>
</div>
<br><br>

Errepikatu Pasahitza(*):<br>
<input type="password" id="Pasahitza2" name="Pasahitza2" onchange="bidaliPasahitza()">
<br><br>

<input type="submit" name="submit" id="submit" value="submit"/>
<button onclick="atzera()">Atzera</button>
</form>

</body>
</html>
