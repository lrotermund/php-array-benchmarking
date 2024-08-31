<?php

namespace Benchmark10;

// ============================== Benchmark 10 =================================

echo "10. `IntSet<string, int>` Typesafe int set object (string index) benchmark...\n";

class IntSet implements \IteratorAggregate {
    protected array $values = [];

    public function getIterator(): \Traversable {
        return new \ArrayIterator($this->values);
    }

    public function has(string $key): bool {
        return isset($this->value[$key]);
    }

    public function get(string $key): int|null {
        return $this->has($key)
            ? $this->values[$key]
            : null;
    }

    public function add(string $key, int $new_value): static {
        if ($this->has($key) === false) {
            $this->values[$key] = $new_value;
        }

        return $this;
    }
}

benchmark(function(callable $save_benchmark_fn) {
    $array = new IntSet();
    for ($i = 0; $i < 1_000_000; $i++) {
        $array->add("index-".$i, $i);
    }

    $save_benchmark_fn();
});
