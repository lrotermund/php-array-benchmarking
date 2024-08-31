<?php

namespace Benchmark5;

# `IntArray<int, int>` Typesafe int array object (int index) benchmark...

class IntArray extends \ArrayObject {
    public function offsetSet($index, $new_value): void {
        if (is_int($new_value) === false) {
            throw new \TypeError('Given value is not an integer...');
        }

        parent::offsetSet($index, $new_value);
    }
}

benchmark(function(callable $save_benchmark_fn) {
    $array = new IntArray();
    for ($i = 0; $i < 1_000_000; $i++) {
        $array[$i] = $i;
    }

    $save_benchmark_fn('IntArray<int, int>');
});
