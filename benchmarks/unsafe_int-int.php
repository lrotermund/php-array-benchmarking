<?php

namespace Benchmark\array\int_int;

# `array<int, int>` Plain fake auto indexed array benchmark...

benchmark(function(callable $save_benchmark_fn) {
    $array = [];
    for ($i = 0; $i < 1_000_000; $i++) {
        $array[] = $i;
    }

    $save_benchmark_fn('array<int, int>', 'int');
});
