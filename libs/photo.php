<?php
exec("ls /var/www/html/MagicMirror/photo/", $out, $stats);
$res = '';
foreach ($out as $key => $value) {
	if(strstr($value, ".")){
		$type = explode(".", $value)[1];
		if($type == "png" || $type == "jpg" || $type == "jpeg"){
			$res .= '"'.$value.'",';
		}
	}
}
$resulet = substr($res, 0, strlen($res)-1);
echo '{"images": ['. $resulet .']}';
