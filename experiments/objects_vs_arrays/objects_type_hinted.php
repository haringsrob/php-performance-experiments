<?php

class MyStruct
{
    public string $variableA;
    public int $variableB;
    public string $variableC;

    public function __construct(string $variableA, int $variableB, string $variableC)
    {
        $this->variableA = $variableA;
        $this->variableB = $variableB;
        $this->variableC = $variableC;
    }
}

function test(): MyStruct
{
    // Instantiate.
    $object = new MyStruct('String A', 12345, 'String B');

    // Act on it.
    $object->variableA = $object->variableC;
    $object->variableC = "Some new value";

    return $object;
}

$iterations = 1000000;

for ($i = 0; $i < $iterations; $i++) {
    $$i = test();
}
