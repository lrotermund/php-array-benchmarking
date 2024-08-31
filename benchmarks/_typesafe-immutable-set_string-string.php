<?php

namespace Benchmark\Immutable\StringSet\string_string;

# `ImmutableStringSet<string, string>` Typesafe, immutable string set object (string index) benchmark...

class ImmutableStringSet implements \IteratorAggregate {
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
        $array = $array->add("index-".$i, strval($i));
    }

    $save_benchmark_fn('ImmutableStringSet<string, string>', 'string');
});
