<?php
//nusoap klasea gehitu.
require_once('/nusoap-0.9.5/lib/nusoap.php');

require_once('/nusoap-0.9.5/lib/class.wsdlcache.php');

//soapclient motadun objektua sortu.
$soapclient= new nusoap_client('http://localhost/wsp/lab7/egiaztatuPasahitza.php?wsdl', true);

//Web-Service-n inplementatu dugun funtzioari dei egiten diogu
		$pasahitza=$_POST['Pasahitza'];
		$pasahitza2=$_POST['Pasahitza2'];
		$result=$soapclient->call('egiaztatuPas', array('x'=>$pasahitza));
		if($result==='BALIOZKOA' && $pasahitza==$pasahitza2){
			echo "Pasahitza egokia";
		}else{
			echo "Pasahitza desegokia";
		}


?>