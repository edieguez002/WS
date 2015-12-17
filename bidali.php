<?php
$Eposta= $_POST["Eposta"];
$Pasahitza= $_POST["Pasahitza"];
$WebPage= 'logeatu.html';

if(!$Eposta || !$Pasahitza){
	echo 'Ez duzu Eposta edo Pasahitza sartu.';
	header('Location: ' .$WebPage);
}
else{

	$conn=mysql_connect("mysql.hostinger.es", "u803652676_aieko", "enetor");

		if (!$conn) {
			die("Konexio errorea egon da: " . mysql_connect());
		}
	
		mysql_select_db("u803652676_quiz") or die(mysql_error());
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
	
	
	