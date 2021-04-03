<?php
$variableA = "String A";
$variableB = 12345;
$variableC = "String C";

$iterations = $argv[1] ?? 1000000; // 1 million.

for ($i = 0; $i < $iterations; $i++) {
    $_ = sprintf("a: %s | b: %d | c: %s", $variableA, $variableB, $variableC);
}

assert($_ = "a: string a | b: 12345 | c: string b");
