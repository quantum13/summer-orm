<?php
require_once __DIR__ . '/../../vendor/autoload.php';

new \SummerOrm\Examples\Models\Book();

$class  = new ReflectionClass('\SummerOrm\Examples\Models\Book');
var_dump($class->getProperties()[0]->getDocComment());