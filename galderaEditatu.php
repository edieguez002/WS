<?php
$aldatzekoGaldera= $_POST['select'];
$galdera= $_POST['galdera'];
$erantzuna= $_POST['erantzuna'];
$zailtasuna= $_POST['zailtasuna'];

echo "sartu naiz";
if($galdera==null && $erantzuna==null && $zailtasuna==null){
	echo "Ez dago ezer aldatzekorik.";
}
?>