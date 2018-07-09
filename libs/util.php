<?php

class util
{
    //get请求方法
    //$url为请求地址
    public static function httpGet($url)
    {
        return file_get_contents($url);
    }

    //post请求方法
    //$url为请求地址
    //$data为请求参数（是一个数组，例子：$data = array ('foo' => 'bar');）
    public static function httpPost($url, $data)
    {
    $data = http_build_query($data);
            $opts = array (
                'http' => array (
                    'method' => 'POST',
                    'header'=> "Content-type: application/x-www-form-urlencodedrn",
                    'Content-Length: ' . strlen($data) . 'rn',
                    'content' => $data
                )
            );
            $context = stream_context_create($opts);
            $html = file_get_contents($url, false, $context);
            return $html;
    }

    //unicode转中文方法
    public static function unicode_decode($name){
        $json = '{"str":"'.$name.'"}';
        $arr = json_decode($json,true);
        if(empty($arr)) return '';
        return $arr['str'];
    }

    //更新配置文件方法
    public static function updateConfig($content){
        $myfile = fopen("../config/config.json", "w") or die("Unable to open file!");
        fwrite($myfile, $content);
        fclose($myfile);
    }

}