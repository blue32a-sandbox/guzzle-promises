<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use GuzzleHttp\Promise\Promise;

$waitFn = function () use (&$promise) {
    $promise->resolve('foo');
};
$promise = new Promise($waitFn);
echo $promise->wait() . PHP_EOL; // foo

// wait()の呼び出し中に例外が発生した場合
$waitFn = function () use (&$promise) {
    throw new Exception('foo');
};
$promise = new Promise($waitFn);
try {
    $promise->wait();
} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL; // foo
}

// すでに完了したPromiseに対してwait()を呼び出す
$promise = new Promise(function () { die('this is not called!');});
$promise->resolve('foo');
echo $promise->wait() . PHP_EOL; // foo

// 拒否されたPromiseに対してwait()を呼び出す
$promise = new Promise();
$promise->reject('foo');
try {
    $promise->wait();
} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL; // The promise was rejected with reason: foo
}
