<script type="text/javascript">
function hasieraraBueltatu(){
	window.location="layout.html";
}

</script>

<script type="text/javascript">
function galderenKudeaketa(){
	window.location="adminQuestions.php";
}

</script>
<?php
if (isset($_REQUEST['selectah'])) {
	$aldatzekoGaldera = $_REQUEST['selectah'];
	} else {
	$aldatzekoGaldera = "";
}

if (isset($_REQUEST['galdera'])) {
	$galdera = $_REQUEST['galdera'];
	} else {
			$galdera = "";
}

if (isset($_REQUEST['erantzuna'])) {
	$erantzuna = $_REQUEST['erantzuna'];
	} else {
	$erantzuna = "";
}

if (isset($_REQUEST['zailtasuna'])) {
	$zailtasuna = $_REQUEST['zailtasuna'];
	} else {
			$zailtasuna = "";
}

$conn=mysql_connect("localhost", "root", "");
		echo "<center>";
		if (!$conn) {
			die("Konexio errorea egon da: " . mysql_connect_error());
		}
		
		$emaitza= "";
		
		mysql_select_db("quiz") or die(mysql_error());
		if($galdera==null && $erantzuna==null && $zailtasuna==null){
			echo "Ez dago ezer aldatzeko.";
			echo "<br>";
		}else if($galdera==null && $erantzuna==null && $zailtasuna!=null){
			$emaitza= "UPDATE galderak SET ZailtasunMaila='$zailtasuna' WHERE Galdera='$aldatzekoGaldera'";
			
		}else if($galdera==null && $erantzuna!=null && $zailtasuna==null){
			$emaitza= "UPDATE galderak SET Erantzuna='$erantzuna' WHERE Galdera='$aldatzekoGaldera'";
			
		}else if($galdera==null && $erantzuna!=null && $zailtasuna!=null){
			$emaitza= "UPDATE galderak SET Erantzuna='$erantzuna', ZailtasunMaila='$zailtasuna' WHERE Galdera='$aldatzekoGaldera'";
			
		}else if($galdera!=null && $erantzuna==null && $zailtasuna==null){
			$emaitza= "UPDATE galderak SET Galdera='$galdera' WHERE Galdera='$aldatzekoGaldera'";
			
		}else if($galdera!=null && $erantzuna==null && $zailtasuna!=null){
			$emaitza= "UPDATE galderak SET Galdera='$galdera', ZailtasunMaila='$zailtasuna' WHERE Galdera='$aldatzekoGaldera'";
			
		}else if($galdera!=null && $erantzuna!=null && $zailtasuna==null){
			$emaitza= "UPDATE galderak SET Galdera='$galdera', Erantzuna='$erantzuna' WHERE Galdera='$aldatzekoGaldera'";
			
		}else{
			$emaitza= "UPDATE galderak SET Galdera='$galdera', Erantzuna='$erantzuna', ZailtasunMaila='$zailtasuna' WHERE Galdera='$aldatzekoGaldera'";
			
		}
		
		if(!mysql_query($emaitza)){
			echo "Errorea egon da aukeratutako galdera eguneratzerako orduan..";
			echo "<br>";
		}else{
			echo "Ondo eguneratu da aukeratutako galdera!";
			echo "<br>";
		}
?>

		<input type="button" name="galderakIkusi" value="Galderen kudeaketara bueltatu" onclick="galderenKudeaketa()">
		<input type="button" name="hasiera" value="Hasiera"onclick="hasieraraBueltatu()">

<?php
		mysql_close($conn);
		
?>