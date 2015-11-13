<?php

require_once('/nusoap-0.9.5/lib/nusoap.php');
require_once('/nusoap-0.9.5/lib/class.wsdlcache.php');
$ns="http://localhost/wsp/lab7/egiaztatuPasahitza.php?wsdl"; 
$server= new soap_server;

$server->configureWSDL('egiaztatuPassword',$ns);
$server->wsdl->schemaTargetNamespace=$ns;

//inplementatu nahi dugun funtzioa erregistratzen dugu
$server->register('egiaztatuPas',array('x'=>'xsd:string'),array( 'z' =>'xsd:string'),$ns);
//funtzioa inplementatzen dugu
function egiaztatuPas($x){
	$file= fopen("toppasswords.txt","r");
	$erantzuna='BALIOZKOA';
	while(!feof($file)){
		$pasahitzak=fgets($file);
		$pastrim=trim($pasahitzak);
		if($x===$pastrim || $x===''){
			echo $erantzuna;
			$erantzuna='BALIOGABEA';
			break;
		}
	}

	return $erantzuna;
	fclose($file);
}


$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);

?>