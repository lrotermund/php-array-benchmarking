<?php

namespace Benchmark\array\string_int;

# `array<string, int>` Plain string indexed array benchmark...

benchmark(function(callable $save_benchmark_fn) {
    $array = [];
    for ($i = 0; $i < 1_000_000; $i++) {
        $array["index-".$i] = $i;
    }

    $save_benchmark_fn('array<string, int>', 'int');
});
