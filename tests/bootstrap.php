<?php
require_once __DIR__ . '/../vendor/autoload.php';

set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});

\SummerOrm\Config::init([
    'driver' => 'pdo_mysql',
    'host' => 'localhost',
    'dbname' => 'summerorm',
    'user' => 'root',
    'password' => 'rootpassword',
    'charset' => 'utf8',
]);

