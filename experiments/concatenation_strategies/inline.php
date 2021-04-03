<?php
$variableA = "String A";
$variableB = 12345;
$variableC = "String C";

$iterations = $argv[1] ?? 1000000;

for ($i = 0; $i < $iterations; $i++) {
    $_ = "a: $variableA | b: $variableB | c: $variableC";
}

assert($_ = "a: string a | b: 12345 | c: string b");
