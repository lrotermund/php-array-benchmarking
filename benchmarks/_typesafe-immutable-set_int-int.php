<?php

namespace Benchmark\Immutable\IntSet\int_int;

# `ImmutableIntSet<int, int>` Typesafe, immutable int set object (int index) benchmark...

class ImmutableIntSet implements \IteratorAggregate {
    protected array $values = [];

    public function getIterator(): \Traversable {
        return new \ArrayIterator($this->values);
    }

    public function has(int $key): bool {
        return isset($this->value[$key]);
    }

    public function get(int $key): int|null {
        return $this->has($key)
            ? $this->values[$key]
            : null;
    }

    public function add(int $key, int $new_value): static {
        if ($this->has($key)) {
            return $this;
        }

        $new_set = clone($this);
        $new_set->values = [...$this->values, $new_value];

        return $new_set;
    }
}

benchmark(function(callable $save_benchmark_fn) {
    $array = new ImmutableIntSet();
    for ($i = 0; $i < 1_000_000; $i++) {
        $array = $array->add($i, $i);
    }

    $save_benchmark_fn('ImmutableIntSet<int, int>', 'int');
});
