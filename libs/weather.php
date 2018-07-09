<?php

include 'util.php';

$util = new util();
// $key = 'tro3dj4xigjyobxy';
// $uid = 'U9E50EF395';
// $api = 'https://api.seniverse.com/v3/weather/daily.json';
$location = $_GET['city'];
// $now_api = "
// https://api.seniverse.com/v3/weather/now.json?key=".$key."&location=".$location."&language=zh-Hans&unit=c";
// $param = [
//     'ts' => time(),
//     'ttl' => 300,
//     'uid' => $uid,
// ];
// $sig_data = http_build_query($param);
// $sig = base64_encode(hash_hmac('sha1', $sig_data, $key, TRUE));
// $param['sig'] = $sig;
// $param['location'] = $location;
// $param['start'] = 0;
// $param['days'] = 7;
// $url = $api . '?' . http_build_query($param);
// if ($_GET["now"]) {
// 	echo $util::httpGet("https://api.seniverse.com/v3/weather/now.json?key=".$key."&location=".urlencode($location)."&language=zh-Hans&unit=c");
// }else{
// 	echo $util::httpGet($url);
// }

$host = "https://jisutqybmf.market.alicloudapi.com";
$path = "/weather/query";
$method = "GET";
$appcode = "ddfb58d89d3a4c778e2e3c69e3444b7f";
$headers = array();
array_push($headers, "Authorization:APPCODE " . $appcode);
$querys = "city=".urlencode($location)."&citycode=citycode&cityid=cityid&ip=ip&location=location";
$bodys = "";
$url = $host . $path . "?" . $querys;

$curl = curl_init();
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_FAILONERROR, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, false);
curl_setopt($curl, CURLOPT_HEADER, false);
if (1 == strpos("$".$host, "https://"))
{
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
}
curl_exec($curl);
$content = curl_getinfo($ch);
echo $content;