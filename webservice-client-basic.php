<?php
	require_once('lib/nusoap.php');
	$error  = '';
	$result_all = array();
	$response = '';
	$wsdl = "http://localhost/webServicesUSTA/webservice-server.php?wsdl";
	$client = new nusoap_client($wsdl, true);
	$err = $client->getError();

	if ($err) {
		echo '<h2>Error en el Constructor</h2>' . $err;
		exit();
	}
	try {
		$result_all = $client->call('fetchBookDataAll');
		$result_all = json_decode($result_all);
		print_r($result_all);
	}catch (Exception $e) {
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}


