<?php

namespace Benchmark\array\int_IndexValueObject;

# `array<int, IndexValueObject>` Plain fake auto indexed IndexValueObject array benchmark...

class IndexValueObject {
    public function __construct(
        private readonly int $index,
        private readonly string $value,
    ) {
    }
}

benchmark(function(callable $save_benchmark_fn) {
    $array = [];
    for ($i = 0; $i < 1_000_000; $i++) {
        $array[] = new IndexValueObject($i, strval($i));
    }

    $save_benchmark_fn(
        'array<int, IndexValueObject>',
        'IndexValueObject',
    );
});
