<?php
header("Content-type:text/html; Charset=utf-8");
include 'util.php';

$util = new util();

$news_url = 'http://www.sina.com.cn/api/hotword.json';
$news = json_decode($util::httpGet($news_url));
$config = json_decode($util::httpGet('../config/config.json'));

for($i=0;i<sizeof($config->news->news_data);$i++)
{
	array_pop($config->news->news_data);
}
$new_arr = $news->result->data;
foreach ($new_arr as $key => $value) {
	array_push($config->news->news_data, $value->title);
}
$util::updateConfig(json_encode($config));


