<?php

namespace Benchmark\IntSet\int_int;

# `IntSet<int, int>` Typesafe int set object (int index) benchmark...

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

    $save_benchmark_fn('IntSet<int, int>', 'int');
});
