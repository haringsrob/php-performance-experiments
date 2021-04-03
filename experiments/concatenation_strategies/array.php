<?php

$variableA = "string A";
$variableB = 12345;
$variableC = "String C";

$data = [
    'a:',
    $variableA,
    '| b:',
    $variableB,
    '| c:',
    $variableC,
];

$iterations = $argv[1] ?? 1000000;

for ($i = 0; $i < $iterations; $i++) {
    $_ = implode(' ', $data);
}

assert($_ = "a: string A | b: 12345 | c: string B");
