<?php
function functionCURLGet($URL) {
	//next example will recieve all messages for specific conversation
	$service_url = $URL;
	$curl = curl_init($service_url);
	curl_setopt($curl, CURLOPT_URL, $URL);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl,CURLOPT_COOKIEJAR, '/var/www/scripts/cookie.txt');
        curl_setopt($curl,CURLOPT_COOKIEFILE, '/var/www/scripts/cookie.txt');

	$curl_response = curl_exec($curl);
	if ($curl_response === false) {
	    $info = curl_getinfo($curl);
	    curl_close($curl);
	    die('error occured during curl exec. Additioanl info: ' . var_export($info));
	}
	curl_close($curl);
	$decoded = json_decode($curl_response);
	if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
	    die('error occured: ' . $decoded->response->errormessage);
	}
	return $curl_response;
}

function functionCURLPost($URL, $post_data_array){
	//next example will insert new conversation
	$service_url = $URL;
	$curl = curl_init($service_url);
	
	$curl_post_data = $post_data_array;
	/*$curl_post_data = array(
	        'message' => 'test message',
	        'useridentifier' => 'agent@example.com',
        	'department' => 'departmentId001',
	        'subject' => 'My first conversation',
        	'recipient' => 'recipient@example.com',
	        'apikey' => 'key001'
	);*/

	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
	curl_setopt($curl,CURLOPT_COOKIEJAR, '/var/www/scripts/cookie.txt');
        curl_setopt($curl,CURLOPT_COOKIEFILE, '/var/www/scripts/cookie.txt');

	$curl_response = curl_exec($curl);
	if ($curl_response === false) {
	    $info = curl_getinfo($curl);
	    curl_close($curl);
	    die('error occured during curl exec. Additioanl info: ' . var_export($info));
	}

	curl_close($curl);
	$decoded = json_decode($curl_response);
	if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
	    die('error occured: ' . $decoded->response->errormessage);
	}
	
	return $curl_response;
}

// TESTING
functionCURLPost('http://10.100.20.72/api/method/login?usr=xxx&pwd=xxx',null);
//echo "<br/><br/>";
echo functionCURLGet('http://10.100.20.72/api/resource/Customer');

?>
