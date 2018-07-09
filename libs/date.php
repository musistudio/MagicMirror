<?php
header("Content-type:text/html; Charset=utf-8");
include 'util.php';

$util = new util();
$date_url = 'https://www.sojson.com/open/api/lunar/json.shtml';
$date = json_decode($util::httpGet($date_url));
printf("农历%s年%d月%d日", $date->data->hyear.$date->data->animal, $date->data->lunarMonth, $date->data->lunarDay);

