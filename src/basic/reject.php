<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use GuzzleHttp\Promise\Promise;

$promise = new Promise();
$promise
    ->then(null, function ($reason) {
        echo 'The promise was rejected. Reason: ' . $reason . PHP_EOL;
    });

$promise->reject('Error!'); // The promise was rejected. Reason: Error!
