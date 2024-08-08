<?php

declare(strict_types=1);

function dump_benchmark(int $start_memory_usage, float $start_time) {
    $end_time = microtime(as_float: true);
    $execution_time = $end_time - $start_time;
    $end_memory_usage = memory_get_usage(real_usage: true);

    echo "\nBenchmark completed.\n";
    echo "Post Benchmark Memory Usage:\t"
        . number_format($end_memory_usage)
        . " bytes\n";
    echo "Execution Time:\t\t\t"
        . number_format($execution_time, decimals: 10)
        . " seconds\n";
    echo "Memory Usage:\t\t\t"
        . number_format($end_memory_usage - $start_memory_usage)
        . " bytes\n";
}

function pre_benchmark_memory(): int {
    $current_memory_usage = memory_get_usage(real_usage: true);

    echo "Pre Benchmark Memory Usage:\t"
        . number_format($current_memory_usage)
        . " bytes\n";

    return $current_memory_usage;
}

function benchmark(callable $benchmark_fn) {
    $start_memory_usage = pre_benchmark_memory();

    $start_time = microtime(as_float: true);

    $benchmark_fn(fn () => dump_benchmark($start_memory_usage, $start_time));
}

// ============================== Benchmark 1 ==================================

echo "Plain fake auto indexed array benchmark...\n";

benchmark(function(callable $dump_benchmark_fn) {
    $array = [];
    for ($i = 0; $i < 1_000_000; $i++) {
        $array[] = $i;
    }

    $dump_benchmark_fn();
});

// ============================== Benchmark 2 ==================================

echo "\nPlain string indexed array benchmark...\n";

benchmark(function(callable $dump_benchmark_fn) {
    $array = [];
    for ($i = 0; $i < 1_000_000; $i++) {
        $array["index-".$i] = $i;
    }

    $dump_benchmark_fn();
});

// ============================== Benchmark 3 ==================================

echo "\nTypesafe int array object (int index) benchmark...\n";

class IntArray extends \ArrayObject {
    public function offsetSet($index, $new_value): void {
        if (is_int($new_value) === false) {
            throw new \TypeError('Given value is not an integer...');
        }

        parent::offsetSet($index, $new_value);
    }
}

benchmark(function(callable $dump_benchmark_fn) {
    $array = new IntArray();
    for ($i = 0; $i < 1_000_000; $i++) {
        $array[$i] = $i;
    }

    $dump_benchmark_fn();
});

// ============================== Benchmark 4 ==================================

echo "\nTypesafe int array object (string index) benchmark...\n";

benchmark(function(callable $dump_benchmark_fn) {
    $array = new IntArray();
    for ($i = 0; $i < 1_000_000; $i++) {
        $array["index-".$i] = $i;
    }

    $dump_benchmark_fn();
});

// ============================== Benchmark 5 ==================================

echo "\nTypesafe string array object (int index) benchmark...\n";

class StringArray extends \ArrayObject {
    public function offsetSet($index, $new_value): void {
        if (is_string($new_value) === false) {
            throw new \TypeError('Given value is not an string...');
        }

        parent::offsetSet($index, $new_value);
    }
}

benchmark(function(callable $dump_benchmark_fn) {
    $array = new StringArray();
    for ($i = 0; $i < 1_000_000; $i++) {
        $array[$i] = strval($i);
    }

    $dump_benchmark_fn();
});

// ============================== Benchmark 6 ==================================

echo "\nTypesafe string array object (string index) benchmark...\n";

benchmark(function(callable $dump_benchmark_fn) {
    $array = new StringArray();
    for ($i = 0; $i < 1_000_000; $i++) {
        $array["index-".$i] = strval($i);
    }

    $dump_benchmark_fn();
});

// ============================== Benchmark 7 ==================================

echo "\nTypesafe int set object (int index) benchmark...\n";

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

benchmark(function(callable $dump_benchmark_fn) {
    $array = new IntSet();
    for ($i = 0; $i < 1_000_000; $i++) {
        $array->add($i, $i);
    }

    $dump_benchmark_fn();
});

// ============================== Benchmark 8 ==================================

echo "\nTypesafe int set object (string index) benchmark...\n";

class IntSetStrIndex implements \IteratorAggregate {
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
        if ($this->has($key) === false) {
            $this->values[$key] = $new_value;
        }

        return $this;
    }
}

benchmark(function(callable $dump_benchmark_fn) {
    $array = new IntSetStrIndex();
    for ($i = 0; $i < 1_000_000; $i++) {
        $array->add("index-".$i, $i);
    }

    $dump_benchmark_fn();
});

// ============================== Benchmark 9 ==================================

echo "\nTypesafe string set object (int index) benchmark...\n";

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

benchmark(function(callable $dump_benchmark_fn) {
    $array = new StringSet();
    for ($i = 0; $i < 1_000_000; $i++) {
        $array->add($i, strval($i));
    }

    $dump_benchmark_fn();
});

// ============================== Benchmark 10 =================================

echo "\nTypesafe string set object (string index) benchmark...\n";

class StringSetStrIndex implements \IteratorAggregate {
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

benchmark(function(callable $dump_benchmark_fn) {
    $array = new StringSetStrIndex();
    for ($i = 0; $i < 1_000_000; $i++) {
        $array->add("index-".$i, strval($i));
    }

    $dump_benchmark_fn();
});

// =============================================================================
//
//                             SKIP IMMUTABLE
//
//                   Immutable tests are brutally slowly...
//
// ============================================================================

exit;

// ============================== Benchmark 11 =================================

echo "\nTypesafe, immutable int set object (int index) benchmark...\n";

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

benchmark(function(callable $dump_benchmark_fn) {
    $array = new ImmutableIntSet();
    for ($i = 0; $i < 1_000_000; $i++) {
        $array = $array->add($i, $i);
    }

    $dump_benchmark_fn();
});

// ============================== Benchmark 12 =================================

echo "\nTypesafe, immutable int set object (string index) benchmark...\n";

class ImmutableIntSetStrIndex implements \IteratorAggregate {
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

benchmark(function(callable $dump_benchmark_fn) {
    $array = new ImmutableIntSetStrIndex();
    for ($i = 0; $i < 1_000_000; $i++) {
        $array = $array->add("index-".$i, $i);
    }

    $dump_benchmark_fn();
});

// ============================== Benchmark 13 =================================

echo "\nTypesafe, immutable string set object (int index) benchmark...\n";

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

benchmark(function(callable $dump_benchmark_fn) {
    $array = new ImmutableStringSet();
    for ($i = 0; $i < 1_000_000; $i++) {
        $array = $array->add($i, strval($i));
    }

    $dump_benchmark_fn();
});

// ============================== Benchmark 14 =================================

echo "\nTypesafe, immutable string set object (string index) benchmark...\n";

class ImmutableStringSetStrIndex implements \IteratorAggregate {
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

benchmark(function(callable $dump_benchmark_fn) {
    $array = new ImmutableStringSetStrIndex();
    for ($i = 0; $i < 1_000_000; $i++) {
        $array = $array->add("index-".$i, strval($i));
    }

    $dump_benchmark_fn();
});

// =============================================================================
