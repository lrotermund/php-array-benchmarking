<?php

namespace Benchmark15;

// ============================== Benchmark 15 =================================

echo "15. `ImmutableStringSet<int, string>` Typesafe, immutable string set object (int index) benchmark...\n";

class ImmutableStringSet implements \IteratorAggregate {
    protected array $values = [];

    public function getIterator(): \Traversable {
        return new \ArrayIterator($this->values);
    }

    public function has(int $key): bool {
        return isset($this->value[$key]);
    }

    public function get(int $key): string|null {
        return $this->has($key)
            ? $this->values[$key]
            : null;
    }

    public function add(int $key, string $new_value): static {
        if ($this->has($key)) {
            return $this;
        }

        $new_set = clone($this);
        $new_set->values = [...$this->values, $new_value];

        return $new_set;
    }
}

benchmark(function(callable $save_benchmark_fn) {
    $array = new ImmutableStringSet();
    for ($i = 0; $i < 1_000_000; $i++) {
        $array = $array->add($i, strval($i));
    }

    $save_benchmark_fn();
});
