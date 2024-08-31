<?php

namespace Benchmark14;

# `ImmutableIntSet<string, int>` Typesafe, immutable int set object (string index) benchmark...

class ImmutableIntSet implements \IteratorAggregate {
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
        $array = $array->add("index-".$i, $i);
    }

    $save_benchmark_fn('ImmutableIntSet<string, int>');
});
