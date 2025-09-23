<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use GuzzleHttp\Psr7\Request;

$client = new Client();
$promises = [];

for ($n = 1; $n <= 5; $n++) {
    $key = "req{$n}";
    $promises[$key] = $client
        ->getAsync('https://httpbin.org/delay/5')
        ->then(function($response) use ($n) {
            echo "request {$n}" . PHP_EOL;
            return "request {$n} :" . $response->getStatusCode();
        });
}

$result = Promise\Utils::all($promises)->wait();

var_dump($result);
/**
 * [
 *  "req1" => "request 1 :200",
 *  "req2" => "request 2 :200",
 *  "req3" => "request 3 :200",
 *  "req4" => "request 4 :200",
 *  "req5" => "request 5 :200"
 * ]
 */
