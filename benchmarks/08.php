<?php

namespace Benchmark8;

// ============================== Benchmark 8 ==================================

echo "08. `StringArray<string, string>` Typesafe string array object (string index) benchmark...\n";

class StringArray extends \ArrayObject {
    public function offsetSet($index, $new_value): void {
        if (is_string($new_value) === false) {
            throw new \TypeError('Given value is not an string...');
        }

        parent::offsetSet($index, $new_value);
    }
}

benchmark(function(callable $save_benchmark_fn) {
    $array = new StringArray();
    for ($i = 0; $i < 1_000_000; $i++) {
        $array["index-".$i] = strval($i);
    }

    $save_benchmark_fn();
});
