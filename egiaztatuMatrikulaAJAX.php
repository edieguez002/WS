<?php
//nusoap klasea gehitu.
require_once('C:/xampp/htdocs/wsp/lab7/nusoap-0.9.5/lib/nusoap.php');

require_once('C:/xampp/htdocs/wsp/lab7/nusoap-0.9.5/lib/class.wsdlcache.php');

//soapclient motadun objektua sortu.
$soapclient= new nusoap_client('http://wsrosaas.hol.es/webZerbitzuak/egiaztatuMatrikula.php?wsdl', false);

//Web-Service-n inplementatu dugun funtzioari dei egiten diogu
if (isset($_POST['Eposta'])){

		$result=$soapclient->call('egiaztatu', array('x'=>$_POST['Eposta']));
		
		if(strcmp($result,"BAI")==0){
			echo "Eposta egokia";
		}else{
			echo "Eposta desegokia";
		}
	
}


?>