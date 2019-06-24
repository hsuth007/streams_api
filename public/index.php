<?php
require "../bootstrap.php";
use Src\Controller\StreamController;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

// endpoints start with /stream
// everything else results in a 404 Not Found
if ($uri[1] !== 'stream') {
    header("HTTP/1.1 404 Not Found");
    exit();
}

$userId = null;
if (isset($uri[2])) {
    $userId = (int) $uri[2];
}

$requestMethod = $_SERVER["REQUEST_METHOD"];

// pass the request method and stream ID to the StreamController and process the HTTP request:
$controller = new StreamController($dbConnection, $requestMethod, $streamId);
$controller->processRequest();
