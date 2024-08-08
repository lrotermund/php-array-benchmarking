<?php

declare(strict_types=1);

function dump_benchmark(float $start_time) {
    $end_time = microtime(as_float: true);
    $execution_time = $end_time - $start_time;
    $memory_usage = memory_get_peak_usage(real_usage: true);

    echo "Benchmark completed.\n";
    echo "Execution Time:\t"
        . number_format($execution_time, decimals: 10)
        . " seconds\n";
    echo "Peak Memory Usage:\t"
        . number_format($memory_usage)
        . " bytes\n";
}

// ============================== Benchmark 1 ==================================

echo "Plain fake auto indexed array benchmark...\n";

$start_time = microtime(as_float: true);

$array = [];
for ($i = 0; $i < 1_000_000; $i++) {
    $array[] = $i;
}

dump_benchmark($start_time);

// ============================== Benchmark 2 ==================================

echo "\nPlain string indexed array benchmark...\n";

$start_time = microtime(as_float: true);

$array = [];
for ($i = 0; $i < 1_000_000; $i++) {
    $array["index-".$i] = $i;
}

dump_benchmark($start_time);

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

$start_time = microtime(true);

$array = new IntArray();
for ($i = 0; $i < 1_000_000; $i++) {
    $array[$i] = $i;
}

dump_benchmark($start_time);

// ============================== Benchmark 4 ==================================

echo "\nTypesafe int array object (string index) benchmark...\n";

$start_time = microtime(true);

$array = new IntArray();
for ($i = 0; $i < 1_000_000; $i++) {
    $array["index-".$i] = $i;
}

dump_benchmark($start_time);

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

$start_time = microtime(true);

$array = new StringArray();
for ($i = 0; $i < 1_000_000; $i++) {
    $array[$i] = strval($i);
}

dump_benchmark($start_time);

// ============================== Benchmark 6 ==================================

echo "\nTypesafe string array object (string index) benchmark...\n";

$start_time = microtime(true);

$array = new StringArray();
for ($i = 0; $i < 1_000_000; $i++) {
    $array["index-".$i] = strval($i);
}

dump_benchmark($start_time);

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

$start_time = microtime(true);

$array = new IntSet();
for ($i = 0; $i < 1_000_000; $i++) {
    $array->add($i, $i);
}

dump_benchmark($start_time);

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

$start_time = microtime(true);

$array = new IntSetStrIndex();
for ($i = 0; $i < 1_000_000; $i++) {
    $array->add("index-".$i, $i);
}

dump_benchmark($start_time);

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

$start_time = microtime(true);

$array = new StringSet();
for ($i = 0; $i < 1_000_000; $i++) {
    $array->add($i, strval($i));
}

dump_benchmark($start_time);

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

$start_time = microtime(true);

$array = new StringSetStrIndex();
for ($i = 0; $i < 1_000_000; $i++) {
    $array->add("index-".$i, strval($i));
}

dump_benchmark($start_time);

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

$start_time = microtime(true);

$array = new ImmutableIntSet();
for ($i = 0; $i < 1_000_000; $i++) {
    $array = $array->add($i, $i);
}

dump_benchmark($start_time);

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

$start_time = microtime(true);

$array = new ImmutableIntSetStrIndex();
for ($i = 0; $i < 1_000_000; $i++) {
    $array = $array->add("index-".$i, $i);
}

dump_benchmark($start_time);

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

$start_time = microtime(true);

$array = new ImmutableStringSet();
for ($i = 0; $i < 1_000_000; $i++) {
    $array = $array->add($i, strval($i));
}

dump_benchmark($start_time);

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

$start_time = microtime(true);

$array = new ImmutableStringSetStrIndex();
for ($i = 0; $i < 1_000_000; $i++) {
    $array = $array->add("index-".$i, strval($i));
}

dump_benchmark($start_time);

// =============================================================================
