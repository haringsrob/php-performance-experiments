<?php

namespace Foo;

$array = [1, 2, 3];

$iterations = $argv[1] ?? 1000000;

for ($i = 0; $i < $iterations; $i++) {
    $_ = count($array);
}
