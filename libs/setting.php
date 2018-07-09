<?php
include 'util.php';

$util = new util();

$post = json_decode(file_get_contents("php://input"));
$ssid = $post->ssid;
$encry = $post->encry;
$password = $post->password;

$time_status = $post->time_status;
$weather_status = $post->weather_status;
$regard_status = $post->regard_status;
$news_status = $post->news_status;
$temp_status = $post->temp_status;
$city = $post->city;



function checkStatus($str){
	if(strpos($str,'on') !==false){
		return true;
	}else {
		return false;
	}
}
if($ssid != ''){
	$myfile = fopen("/etc/wpa_supplicant/wpa_supplicant.conf", "w") or die("Unable to open file!");
	if(!isset($encry)){
		$encry = "none";
	}
	$content = 'country=CN
	ctrl_interface=DIR=/var/run/wpa_supplicant GROUP=netdev
	update_config=1

	network={
	    ssid="'.$ssid.'"
	    psk="'.$password.'"
	    key_mgmt='.$encry.'
	    priority=1
	}';
	fwrite($myfile, $content);
	fclose($myfile);
}

$config = json_decode($util::httpGet('../config/config.json'));

$config->datetime->enable = checkStatus($time_status);
$config->news->enable = checkStatus($news_status);
$config->regard->enable = checkStatus($regard_status);
$config->weather->enable = checkStatus($weather_status);
$config->weather->location = $city;
$config->indoor_temp->enable = checkStatus($temp_status);


$util::updateConfig(json_encode($config));


