<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Login</title>
</head>
<body>
<h1> Identifikatu</h1>
<form id="login" name="login"  method="post" action="logeatu.php">

Eposta:<br>
<input type="text" id="Eposta" name="Eposta"><br><br>

Pasahitza:<br>
<input type="password" id="Pasahitza" name="Pasahitza"><br><br>

<input type="submit" id="submit" value="Logeatu"/>

</form>
<?php
if (isset($_REQUEST['Eposta'])) {
$Eposta = $_REQUEST['Eposta'];
} else {
$Eposta = "";
}

if (isset($_REQUEST['Pasahitza'])) {
$Pasahitza = $_REQUEST['Pasahitza'];
} else {
$Pasahitza = "";
}
//$Eposta= $_POST["Eposta"];
//$Pasahitza= $_POST["Pasahitza"];

if(!$Eposta || !$Pasahitza){
	echo 'Eposta eta pasahitza sartu behar dituzu.';
}
else{

	$conn=mysql_connect("localhost", "root", "");

		if (!$conn) {
			die("Konexio errorea egon da: " . mysql_connect_error());
		}
	
		mysql_select_db("quiz") or die(mysql_error());
		$emaitza= mysql_query("SELECT * FROM erabiltzaile");
	
			for($i=0; $i<mysql_num_rows($emaitza); $i++){
				$row= mysql_fetch_assoc($emaitza);
				if(($row['Eposta']==$Eposta) && ($row['Pasahitza']!=$Pasahitza)){
					echo 'Pasahitza okerra.';
					//header("Location: logeatu.html");
				}
				if(($row['Eposta']==$Eposta) && ($row['Pasahitza']==$Pasahitza)){
					mysql_close($conn);
					echo "<p> <a href='Quizzes.html'> Galdetegia </a>";
				}
			}
			if(mysql_num_rows($emaitza)==0){
				echo 'Ez dago horrelako erabiltzailerik.';
				//header("Location: logeatu.html");
				die('Ezin izan da informaziorik lortu. ' . mysql_error());
			}
		
	}

	
	
?>
</body>
</html>
