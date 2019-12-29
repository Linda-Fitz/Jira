<?php
	$base64_usrpwd = base64_encode($_POST['testuser'].':'.$_POST['Test123']);
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://visoldev.ddns.net:8888/rest/api/2/issue/');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
												'Authorization: Basic '.$base64_usrpwd)); 
	
	$arr['project'] = array( 'key' => 'TEST');
	$arr['summary'] = $_POST['summary'];
    $arr['description'] = $_POST['description'];
    $arr['duedate'] = $_POST['duedate'];
    
    $arr['issuetype'] = array( 'name' => $_POST['type']);
    $arr['assignee'] = array( 'name' => $_POST['assignee']);
	$arr['priority'] = array( 'name' => $_POST['priority']);
	$arr['attachment'] = $_POST[exec(upload-file.php)];
	
    $json_arr['fields'] = $arr;
    
    
	
	$json_string = json_encode ($json_arr);
	curl_setopt($ch, CURLOPT_POSTFIELDS,$json_string);
	$result = curl_exec($ch);
	curl_close($ch);
	
	echo $result;
?>