<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use GuzzleHttp\Promise\Promise;

// resolve (unwrap)
$promise = new Promise();
$promise->resolve('foo');
echo $promise->wait() . PHP_EOL; // foo

// resolve (no unwrap)
$promise = new Promise();
$promise->resolve('foo');
echo $promise->wait(false) . PHP_EOL; // ""

// reject (unwrap)
$promise = new Promise();
$promise->reject('foo');
try {
    $promise->wait();
} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL; // The promise was rejected with reason: foo
}

// reject (no unwrap)
$promise = new Promise();
$promise->reject('foo');
try {
    $promise->wait(false);
    echo 'this is call!' . PHP_EOL;
} catch (Exception $e) {
    die('this should not be called!');
}
