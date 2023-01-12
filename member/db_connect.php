<?php


	$db = new PDO("mysql:host=localhost;dbname=movieverse", "movieverse", "ww970714**");
	//$db = new PDO("mysql:host=localhost;port=3309;dbname=phpdb", "php", "1234");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 



?>