<?php

namespace Benchmark\StringSet\int_string;

# `StringSet<int, string>` Typesafe string set object (int index) benchmark...

class StringSet implements \IteratorAggregate {
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
        if ($this->has($key) === false) {
            $this->values[$key] = $new_value;
        }

        return $this;
    }
}

benchmark(function(callable $save_benchmark_fn) {
    $array = new StringSet();
    for ($i = 0; $i < 1_000_000; $i++) {
        $array->add($i, strval($i));
    }

    $save_benchmark_fn('StringSet<int, string>', 'string');
});
