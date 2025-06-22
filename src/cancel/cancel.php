<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use GuzzleHttp\Promise\Promise;

$chancelFn = function () use (&$promise) {
    $promise->resolve('foo');
};
$promise = new Promise(null, $chancelFn);
$promise->cancel();
echo $promise->wait() . PHP_EOL; // foo

// reject (cancel)
$chancelFn = function () use (&$promise) {
    $promise->reject('foo');
};
$promise = new Promise(null, $chancelFn);
$promise->cancel();
try {
    $promise->wait();
} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL; // The promise was rejected with reason: foo
}
