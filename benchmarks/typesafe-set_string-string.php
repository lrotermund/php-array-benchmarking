<?php

namespace Benchmark12;

# `StringSet<string, string>` Typesafe string set object (string index) benchmark...

class StringSet implements \IteratorAggregate {
    protected array $values = [];

    public function getIterator(): \Traversable {
        return new \ArrayIterator($this->values);
    }

    public function has(string $key): bool {
        return isset($this->value[$key]);
    }

    public function get(string $key): string|null {
        return $this->has($key)
            ? $this->values[$key]
            : null;
    }

    public function add(string $key, string $new_value): static {
        if ($this->has($key) === false) {
            $this->values[$key] = $new_value;
        }

        return $this;
    }
}

benchmark(function(callable $save_benchmark_fn) {
    $array = new StringSet();
    for ($i = 0; $i < 1_000_000; $i++) {
        $array->add("index-".$i, strval($i));
    }

    $save_benchmark_fn('StringSet<string, string>');
});
