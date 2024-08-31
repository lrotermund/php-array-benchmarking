<?php

namespace Benchmark\IndexValueObjectArray\int;

# `IndexValueObjectArray<int, IndexValueObject>` Typesafe IndexValueObject array object (int index) benchmark...

class IndexValueObject {
    public function __construct(
        private readonly int $index,
        private readonly string $value,
    ) {
    }
}

class IndexValueObjectArray extends \ArrayObject {
    public function offsetSet($index, $new_value): void {
        if (!$new_value instanceof IndexValueObject) {
            throw new \TypeError('Given value is not an IndexValueObject...');
        }

        parent::offsetSet($index, $new_value);
    }
}

benchmark(function(callable $save_benchmark_fn) {
    $array = new IndexValueObjectArray();
    for ($i = 0; $i < 1_000_000; $i++) {
        $array[] = new IndexValueObject($i, strval($i));
    }

    $save_benchmark_fn(
        'IndexValueObjectArray<int, IndexValueObject>',
        'IndexValueObject',
    );
});
