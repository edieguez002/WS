<!DOCTYPE html>
<html>
  <head>
	 <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Answer questions</title>
	<script type="text/javascript">
		
			XMLHttpRequestObject = new XMLHttpRequest();
	
			XMLHttpRequestObject.onreadystatechange=function(){
				if (XMLHttpRequestObject.readyState==4){	 
					document.getElementById("result").innerHTML= XMLHttpRequestObject.responseText;
				}
			}
		function erantzunaEgiaztatu(){
			var aukeratutakoGaldera= document.getElementById("galderak").value;
			var erantzuna= document.getElementById("erantzuna").value;
			XMLHttpRequestObject.open("POST", "ErantzunaEgiaztatu.php", true);
			XMLHttpRequestObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			XMLHttpRequestObject.send("&galderak="+aukeratutakoGaldera+"&erantzuna="+erantzuna);
		} 
	</script>
  </head>
  
  <body>
  
	<h1> Aukeratu galdera</h1>
	<form id="GalderaForm" name="GalderaForm" method="post" action="ErantzunaEgiaztatu.php">
		<select id="galderak" name="galderak">;
<?php
 $conn=mysql_connect("mysql.hostinger.es", "u803652676_aieko", "enetor");

		if (!$conn) {
			die("Konexio errorea egon da: " . mysql_connect());
		}
	
		mysql_select_db("u803652676_quiz") or die(mysql_error());
		$emaitza= mysql_query("SELECT * FROM galderak");
	
			for($i=0; $i<mysql_num_rows($emaitza); $i++){
				$row= mysql_fetch_assoc($emaitza);
				  
	
	  echo '<option value="'.$row['Galdera'].'">'.$row['Galdera'].'</option>';
	}
  
  
  
?>
		</select>
		
		<h2>ERANTZUNA:</h2>
	
			<input type="text" name="erantzuna" id="erantzuna" /><br><br>
			<input type="button" name="Gorde" id="Gorde" value="Gorde" onclick="erantzunaEgiaztatu()"/><br>
			<input type="button" name="Hasiera" id="Gorde" value="Hasiera" onclick="window.history.back()"/>
			<div id="result">
				
			</div>
	</form>
  </body>
</html>