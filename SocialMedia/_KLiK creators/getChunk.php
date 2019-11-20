<?php
	extract($_GET);
	$chunk=500;
	$pos=$count*$chunk;
	$file=fopen("load.gif","r");
	fseek($file,$pos);
	$data=fread($file,$chunk);
	#echo $data;
?>