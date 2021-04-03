<?php

class MyStruct
{
    public $variableA;
    public $variableB;
    public $variableC;

    public function __construct($variableA, $variableB, $variableC)
    {
        $this->variableA = $variableA;
        $this->variableB = $variableB;
        $this->variableC = $variableC;
    }
}

function test()
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
