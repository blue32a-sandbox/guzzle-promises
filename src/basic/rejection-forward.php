<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use GuzzleHttp\Promise\Promise;
use GuzzleHttp\Promise\RejectedPromise;

// thrown exception
$promise = new Promise();
$promise
    ->then(null, function (string $reason) {
        throw new Exception($reason);
    })->then(null, function (Exception $e) {
        echo $e->getMessage() . PHP_EOL;
    });
$promise->reject('Thrown Exception!'); // Thrown Exception!

// return rejected promise
$promise = new Promise();
$promise
    ->then(null, function (string $reason) {
        return new RejectedPromise($reason);
    })->then(null, function (string $reason) {
        echo $reason . PHP_EOL;
    });
$promise->reject('Return rejected promise!'); // Return rejected promise!

// exception is not thrown and does not return rejected promise
$promise = new Promise();
$promise
    ->then(null, function (string $reason) {
        return 'It\'s ok';
    })->then(function (string $value) {
        echo $value . PHP_EOL;
    });
$promise->reject('Error!'); // It's ok
