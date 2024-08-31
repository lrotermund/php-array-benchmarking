<?php

namespace Benchmark\array\string_IndexValueObject;

# `array<string, IndexValueObject>` Plain fake auto indexed IndexValueObject array benchmark...

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
        $array["index-".$i] = new IndexValueObject($i, strval($i));
    }

    $save_benchmark_fn(
        'array<string, IndexValueObject>',
        'IndexValueObject',
    );
});
