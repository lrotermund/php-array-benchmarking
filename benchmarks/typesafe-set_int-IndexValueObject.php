<?php

namespace Benchmark\IndexValueObjectSet\int;

# `IndexValueObjectset<int, IndexValueObject>` Typesafe IndexValueObject set object (int index) benchmark...

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

    public function has(int $key): bool {
        return isset($this->values[$key]);
    }

    public function get(int $key): IndexValueObject|null {
        return $this->has($key)
            ? $this->values[$key]
            : null;
    }

    public function add(int $key, IndexValueObject $new_value): static {
        if ($this->has($key) === false) {
            $this->values[$key] = $new_value;
        }

        return $this;
    }
}

benchmark(function(callable $save_benchmark_fn) {
    $array = new IndexValueObjectSet();
    for ($i = 0; $i < 1_000_000; $i++) {
        $array->add($i, new IndexValueObject($i, strval($i)));
    }

    $save_benchmark_fn(
        'IndexValueObjectSet<int, IndexValueObject>',
        'IndexValueObject',
    );
});
