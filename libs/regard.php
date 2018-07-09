<?php
header("Content-type:text/html; Charset=utf-8");
include 'util.php';

$util = new util();

$regard_url = 'http://api.hitokoto.cn/';
$config = json_decode($util::httpGet('../config/config.json'));

if($config->regard->online->enable){
	for($i=0;i<sizeof($config->regard->online->regards);$i++)
	{
		array_pop($config->regard->online->regards);
	}
	$new_arr = $news->result->data;
	for ($i=0; $i < 10; $i++) {
		array_push($config->regard->online->regards, json_decode($util::httpGet($regard_url))->hitokoto);
	}
	$util::updateConfig(json_encode($config));
}
