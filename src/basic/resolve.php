<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use GuzzleHttp\Promise\Promise;

$promise = new Promise();

$promise
    ->then(function(string $value) {
        return 'the promise was fulfilled. Value: ' . $value . PHP_EOL;
    })->then(function(string $value) {
        echo $value;
    });

$promise->resolve('Success!'); // the promise was fulfilled. Value: Success!
