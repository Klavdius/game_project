<?php
    $host = '127.0.0.1';
    $dbname = 'dev_db';
    $username = 'root';
    $password = '';
	
	$db = new mysqli($host, $username, $password, $dbname);
	
	if ($db->connect_errno) {
		exit("Connection failed: ");
    }
?>