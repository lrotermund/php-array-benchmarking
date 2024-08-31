<?php

declare(strict_types=1);

class BenchmarkResult {
    public function __construct(
        public readonly float $pre_memory_usage,
        public readonly float $post_memory_usage,
        public readonly float $execution_time,
    ) {
    }

    public function memory_usage(): float {
        return $this->post_memory_usage - $this->pre_memory_usage;
    }
}

/** @var \ArrayObject<int, BenchmarkResult> */
$benchmark_results = new \ArrayObject();

function save_benchmark(int $pre_memory_usage, float $start_time) {
    global $benchmark_results;

    $end_time = microtime(as_float: true);

    $benchmark_results[] = new BenchmarkResult(
        pre_memory_usage: $pre_memory_usage,
        post_memory_usage: memory_get_usage(real_usage: true),
        execution_time: $end_time - $start_time,
    );
}

function benchmark(callable $benchmark_fn) {
    $start_time = microtime(as_float: true);
    $start_memory_usage = memory_get_usage(real_usage: true);

    $benchmark_fn(fn () => save_benchmark($start_memory_usage, $start_time));
}

function run_benchmark(string $filename) {
    include $filename;
}

$benchmarks = glob('./benchmarks/{0[1-9],1[0-9]}.php', GLOB_BRACE);

foreach ($benchmarks as $benchmark) {
    run_benchmark($benchmark);
}

echo "\n";
echo "| No.  | Pre memory usage  | Post memory usage | Memory usage      | Execution time |\n";
echo "|------|-------------------|-------------------|-------------------|----------------|\n";

function lpad(string $value, int $length = 11) {
    return str_pad($value, $length, ' ', STR_PAD_LEFT);
}

for ($i = 0; $i < count($benchmark_results); $i++) {
    echo sprintf(
        "| %'.02d   | %s bytes | %s bytes | %s bytes | %s seconds |\n",
        $i+1,
        lpad(number_format($benchmark_results[$i]->pre_memory_usage)),
        lpad(number_format($benchmark_results[$i]->post_memory_usage)),
        lpad(number_format($benchmark_results[$i]->memory_usage())),
        number_format($benchmark_results[$i]->execution_time, decimals: 4),
    );
}
