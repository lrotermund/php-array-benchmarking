<?php

declare(strict_types=1);

class BenchmarkResult {
    public function __construct(
        public readonly string $title,
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

function save_benchmark(
    string $title,
    int $pre_memory_usage,
    float $start_time,
) {
    global $benchmark_results;

    $end_time = microtime(as_float: true);

    $benchmark_results[] = new BenchmarkResult(
        title: $title,
        pre_memory_usage: $pre_memory_usage,
        post_memory_usage: memory_get_usage(real_usage: true),
        execution_time: $end_time - $start_time,
    );
}

function benchmark(callable $benchmark_fn) {
    $start_time = microtime(as_float: true);
    $start_memory_usage = memory_get_usage(real_usage: true);

    $benchmark_fn(fn (string $title) => save_benchmark(
        $title,
        $start_memory_usage,
        $start_time,
    ));
}

function lpad(string $value, int $length = 11) {
    return str_pad($value, $length, ' ', STR_PAD_LEFT);
}

function rpad(string $value, int $length = 11) {
    return str_pad($value, $length, ' ', STR_PAD_RIGHT);
}

function run_benchmark(string $filename) {
    include $filename;
}

$benchmarks = array_filter(
    glob('./benchmarks/*.php', GLOB_BRACE),
    function($file) {
        return basename($file)[0] !== '_';
    },
);

foreach ($benchmarks as $benchmark) {
    run_benchmark($benchmark);
}

$benchmark_results->uasort(function(BenchmarkResult $a, BenchmarkResult $b) {
    return $a->memory_usage() <=> $b->memory_usage();
});

echo "\n";
echo "| No.  | Title                               | Memory usage      | Pre memory usage  | Post memory usage | Execution time |\n";
echo "|------|-------------------------------------|-------------------|-------------------|-------------------|----------------|\n";

$row = 0;

foreach ($benchmark_results as $benchmark_result) {
    $row++;

    echo sprintf(
        "| %'.02d   | %s | %s bytes | %s bytes | %s bytes | %s seconds |\n",
        $row,
        rpad($benchmark_result->title, length: 35),
        lpad(number_format($benchmark_result->memory_usage())),
        lpad(number_format($benchmark_result->pre_memory_usage)),
        lpad(number_format($benchmark_result->post_memory_usage)),
        number_format($benchmark_result->execution_time, decimals: 4),
    );
}
