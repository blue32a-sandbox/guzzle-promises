<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use GuzzleHttp\Promise\Promise;

$promise = new Promise();
$nextPromise = new Promise();

$promise
    ->then(function (string $value) use ($nextPromise) {
        echo $value . PHP_EOL;
        return $nextPromise;
    })
    ->then(function(string $value) {
        echo $value . PHP_EOL;
    });

$promise->resolve('A'); // A
$nextPromise->resolve('B'); // B
