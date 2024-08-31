<?php

namespace Benchmark9;

// ============================== Benchmark 9 ==================================

echo "09. `IntSet<int, int>` Typesafe int set object (int index) benchmark...\n";

class IntSet implements \IteratorAggregate {
    protected array $values = [];

    public function getIterator(): \Traversable {
        return new \ArrayIterator($this->values);
    }

    public function has(int $key): bool {
        return isset($this->values[$key]);
    }

    public function get(int $key): int|null {
        return $this->has($key)
            ? $this->values[$key]
            : null;
    }

    public function add(int $key, int $new_value): static {
        if ($this->has($key) === false) {
            $this->values[$key] = $new_value;
        }

        return $this;
    }
}

benchmark(function(callable $save_benchmark_fn) {
    $array = new IntSet();
    for ($i = 0; $i < 1_000_000; $i++) {
        $array->add($i, $i);
    }

    $save_benchmark_fn();
});
