<?php

function test()
{
    // Instantiate.
    $array = [];
    $array['variableA'] = 'String A';
    $array['variableB'] = 12345;
    $array['variableC'] = 'String B';

    // Act on it.
    $array['variableA'] = $array['variableC'];
    $array['variableC'] = "Some new value";

    return $array;
}

$iterations = 1000000;

for ($i = 0; $i < $iterations; $i++) {
    $$i = test();
}
