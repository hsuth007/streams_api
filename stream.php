<?php

class streams{
    
protected $streamId = "";
private $stream = "";
private $path = "";
private $size = 0;

function __construct($file_path) 
{
    $this->path = $file_path;
}

function getStreamById()
{
    $ch = curl_init();    
    curl_setopt($ch, CURLOPT_URL, "https://coding-challenge.dsc.tv/v1/ads/"."$streamId");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    
    $response = curl_exec($ch);
    curl_close($ch);
    var_dump($response);exit;
}

}
