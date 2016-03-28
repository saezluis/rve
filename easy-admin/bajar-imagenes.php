<?php

	function saveImage($urlImage, $title){

		$fullpath = '../easy-web/images/'.$title;
		$ch = curl_init ($urlImage);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
		$rawdata=curl_exec($ch);
		curl_close ($ch);
		if(file_exists($fullpath)){
			unlink($fullpath);
		}
		$fp = fopen($fullpath,'x');
		$r = fwrite($fp, $rawdata);

		setMemoryLimit($fullpath);

		fclose($fp);

		return $r;
	}

	function setMemoryLimit($filename){
	   set_time_limit(50);
	   $maxMemoryUsage = 258;
	   $width  = 0;
	   $height = 0;
	   $size   = ini_get('memory_limit');

	   list($width, $height) = getimagesize($filename);
	   $size = $size + floor(($width * $height * 4 * 1.5 + 1048576) / 1048576);

	   if ($size > $maxMemoryUsage) $size = $maxMemoryUsage;

	   ini_set('memory_limit',$size.'M');

	}

?>