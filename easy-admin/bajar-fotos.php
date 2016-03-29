<?php

	function grab_image($url,$saveto){	
		$ch = curl_init ($url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
		$raw=curl_exec($ch);
		curl_close ($ch);
		if(file_exists($saveto)){
			unlink($saveto);
		}
		$fp = fopen($saveto,'x');
		fwrite($fp, $raw);
		fclose($fp);
	}
	
	if (!file_exists('c:\easy-rve')) {
		mkdir('c:\easy-rve', 0777, true);
	}
	
	grab_image('http://pmdigital.cl/rve/easy-web/images/940670.jpg','c:\easy-rve/js3.jpg');
	
	$Path = 'http://pmdigital.cl/rve/easy-web/images/940670.jpg';
	if (file_exists($Path)){
		if (unlink($Path)) {   
			echo "success";
		} else {
			echo "fail";    
		}   
	} else {
		echo "file does not exist";
	}
	
?>