<?php

namespace Benchmark1;

// ============================== Benchmark 1 ==================================

echo "01. `array<int, int>` Plain fake auto indexed array benchmark...\n";

benchmark(function(callable $save_benchmark_fn) {
    $array = [];
    for ($i = 0; $i < 1_000_000; $i++) {
        $array[] = $i;
    }

    $save_benchmark_fn();
});
