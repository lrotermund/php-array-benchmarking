<?php

namespace Benchmark6;

# `IntArray<string, int>` Typesafe int array object (string index) benchmark...

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
        $array["index-".$i] = $i;
    }

    $save_benchmark_fn('IntArray<string, int>');
});
