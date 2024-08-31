<?php

namespace Benchmark4;

# `array<string, string>` Plain string indexed array benchmark...

benchmark(function(callable $save_benchmark_fn) {
    $array = [];
    for ($i = 0; $i < 1_000_000; $i++) {
        $array["index-".$i] = strval($i);
    }

    $save_benchmark_fn('array<string, string>');
});
