<?php

namespace Benchmark\IndexValueObjectSet\string;

# `IndexValueObjectset<string, IndexValueObject>` Typesafe IndexValueObject set object (string index) benchmark...

class IndexValueObject {
    public function __construct(
        private readonly int $index,
        private readonly string $value,
    ) {
    }
}

class IndexValueObjectSet implements \IteratorAggregate {
    protected array $values = [];

    public function getIterator(): \Traversable {
        return new \ArrayIterator($this->values);
    }

    public function has(string $key): bool {
        return isset($this->values[$key]);
    }

    public function get(string $key): IndexValueObject|null {
        return $this->has($key)
            ? $this->values[$key]
            : null;
    }

    public function add(string $key, IndexValueObject $new_value): static {
        if ($this->has($key) === false) {
            $this->values[$key] = $new_value;
        }

        return $this;
    }
}

benchmark(function(callable $save_benchmark_fn) {
    $array = new IndexValueObjectSet();
    for ($i = 0; $i < 1_000_000; $i++) {
        $array->add("index-".$i, new IndexValueObject($i, strval($i)));
    }

    $save_benchmark_fn(
        'IndexValueObjectSet<string, IndexValueObject>',
        'IndexValueObject',
    );
});
