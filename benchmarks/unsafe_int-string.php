<?php

namespace Benchmark3;

# `array<int, string>` Plain fake auto indexed string array benchmark...

benchmark(function(callable $save_benchmark_fn) {
    $array = [];
    for ($i = 0; $i < 1_000_000; $i++) {
        $array[] = strval($i);
    }

    $save_benchmark_fn('array<int, string>');
});
