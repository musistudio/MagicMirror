<?php
include 'util.php';

$util = new util();
$location = $_GET['city'];
$quality_api = "http://apicloud.mob.com/environment/query?key=2485a7d689d2b&city=".urlencode($location);
echo $util::httpGet($quality_api);