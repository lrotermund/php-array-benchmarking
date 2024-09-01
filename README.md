# PHPenchmark

PHPenchmark is a benchmarking project that aims to check whether there is a
memory saving in different versions of PHP if you wrap arrays in type-safe
classes instead of just writing the objects directly into PHP-native arrays.

PHP has 512M of memory available for benchmarking.

## Benchmarking

### Latest benchmarking system stats

- OS: Linux Mint 21.2 x86_64
- Host: Inspiron 16 Plus 7620
- Kernel: 5.15.0-119-generic
- Shell: zsh 5.8.1
- WM: i3
- Terminal: tmux
- CPU: 12th Gen Intel i7-12700H (20) @ 4.600GHz
- GPU: NVIDIA GeForce RTX 3060 Mobile / Max-Q
- GPU: Intel Alder Lake-P
- Memory: 18484MiB / 31776MiB

### PHP 8.1

| No.  | Title                                            | Memory usage      | Pre memory usage  | Post memory usage | Execution time |
|------|--------------------------------------------------|-------------------|-------------------|-------------------|----------------|
| 01   | array<int, IndexValueObject>                     |  33,558,528 bytes | 165,675,008 bytes | 199,233,536 bytes | 0.1222 seconds |
| 02   | IndexValueObjectArray<int, IndexValueObject>     |  33,558,528 bytes | 165,675,008 bytes | 199,233,536 bytes | 0.1942 seconds |
| 03   | IndexValueObjectSet<int, IndexValueObject>       |  33,558,528 bytes | 121,634,816 bytes | 155,193,344 bytes | 0.2929 seconds |
| 04   | array<string, IndexValueObject>                  |  41,943,040 bytes | 165,675,008 bytes | 207,618,048 bytes | 0.1699 seconds |
| 05   | IndexValueObjectArray<string, IndexValueObject>  |  41,943,040 bytes | 165,675,008 bytes | 207,618,048 bytes | 0.2397 seconds |
| 06   | IndexValueObjectSet<string, IndexValueObject>    |  41,943,040 bytes | 163,577,856 bytes | 205,520,896 bytes | 0.2753 seconds |
| 07   | array<int, int>                                  |  33,558,528 bytes | 165,675,008 bytes | 199,233,536 bytes | 0.0276 seconds |
| 08   | IntSet<int, int>                                 |  33,558,528 bytes | 121,634,816 bytes | 155,193,344 bytes | 0.0786 seconds |
| 09   | IntArray<int, int>                               |  33,558,528 bytes | 165,675,008 bytes | 199,233,536 bytes | 0.0822 seconds |
| 10   | array<string, int>                               |  41,943,040 bytes | 165,675,008 bytes | 207,618,048 bytes | 0.0732 seconds |
| 11   | IntSet<string, int>                              |  41,943,040 bytes | 163,577,856 bytes | 205,520,896 bytes | 0.1260 seconds |
| 12   | IntArray<string, int>                            |  41,943,040 bytes | 165,675,008 bytes | 207,618,048 bytes | 0.1292 seconds |
| 13   | array<int, string>                               |  33,558,528 bytes | 165,675,008 bytes | 199,233,536 bytes | 0.0424 seconds |
| 14   | StringSet<int, string>                           |  33,558,528 bytes | 121,634,816 bytes | 155,193,344 bytes | 0.0915 seconds |
| 15   | StringArray<int, string>                         |  33,558,528 bytes | 165,675,008 bytes | 199,233,536 bytes | 0.1066 seconds |
| 16   | array<string, string>                            |  41,943,040 bytes | 165,675,008 bytes | 207,618,048 bytes | 0.0858 seconds |
| 17   | StringSet<string, string>                        |  41,943,040 bytes | 163,577,856 bytes | 205,520,896 bytes | 0.1486 seconds |
| 18   | StringArray<string, string>                      |  41,943,040 bytes | 165,675,008 bytes | 207,618,048 bytes | 0.1565 seconds |

### PHP 8.2

| No.  | Title                                            | Memory usage      | Pre memory usage  | Post memory usage | Execution time |
|------|--------------------------------------------------|-------------------|-------------------|-------------------|----------------|
| 01   | array<int, IndexValueObject>                     |  16,781,312 bytes | 165,675,008 bytes | 182,456,320 bytes | 0.1129 seconds |
| 02   | IndexValueObjectArray<int, IndexValueObject>     |  16,781,312 bytes | 165,675,008 bytes | 182,456,320 bytes | 0.1807 seconds |
| 03   | IndexValueObjectSet<int, IndexValueObject>       |  16,781,312 bytes | 121,634,816 bytes | 138,416,128 bytes | 0.2878 seconds |
| 04   | array<string, IndexValueObject>                  |  41,943,040 bytes | 165,675,008 bytes | 207,618,048 bytes | 0.1691 seconds |
| 05   | IndexValueObjectArray<string, IndexValueObject>  |  41,943,040 bytes | 165,675,008 bytes | 207,618,048 bytes | 0.2372 seconds |
| 06   | IndexValueObjectSet<string, IndexValueObject>    |  41,943,040 bytes | 163,577,856 bytes | 205,520,896 bytes | 0.2830 seconds |
| 07   | array<int, int>                                  |  16,781,312 bytes | 165,675,008 bytes | 182,456,320 bytes | 0.0177 seconds |
| 08   | IntArray<int, int>                               |  16,781,312 bytes | 165,675,008 bytes | 182,456,320 bytes | 0.0722 seconds |
| 09   | IntSet<int, int>                                 |  16,781,312 bytes | 121,634,816 bytes | 138,416,128 bytes | 0.0746 seconds |
| 10   | array<string, int>                               |  41,943,040 bytes | 165,675,008 bytes | 207,618,048 bytes | 0.0727 seconds |
| 11   | IntSet<string, int>                              |  41,943,040 bytes | 163,577,856 bytes | 205,520,896 bytes | 0.1263 seconds |
| 12   | IntArray<string, int>                            |  41,943,040 bytes | 165,675,008 bytes | 207,618,048 bytes | 0.1291 seconds |
| 13   | array<int, string>                               |  16,781,312 bytes | 165,675,008 bytes | 182,456,320 bytes | 0.0314 seconds |
| 14   | StringSet<int, string>                           |  16,781,312 bytes | 121,634,816 bytes | 138,416,128 bytes | 0.0924 seconds |
| 15   | StringArray<int, string>                         |  16,781,312 bytes | 165,675,008 bytes | 182,456,320 bytes | 0.0957 seconds |
| 16   | array<string, string>                            |  41,943,040 bytes | 165,675,008 bytes | 207,618,048 bytes | 0.0864 seconds |
| 17   | StringSet<string, string>                        |  41,943,040 bytes | 163,577,856 bytes | 205,520,896 bytes | 0.1491 seconds |
| 18   | StringArray<string, string>                      |  41,943,040 bytes | 165,675,008 bytes | 207,618,048 bytes | 0.1557 seconds |

### PHP 8.3

| No.  | Title                                            | Memory usage      | Pre memory usage  | Post memory usage | Execution time |
|------|--------------------------------------------------|-------------------|-------------------|-------------------|----------------|
| 01   | array<int, IndexValueObject>                     |  16,781,312 bytes | 165,675,008 bytes | 182,456,320 bytes | 0.1158 seconds |
| 02   | IndexValueObjectArray<int, IndexValueObject>     |  16,781,312 bytes | 165,675,008 bytes | 182,456,320 bytes | 0.1805 seconds |
| 03   | IndexValueObjectSet<int, IndexValueObject>       |  16,781,312 bytes | 121,634,816 bytes | 138,416,128 bytes | 0.2896 seconds |
| 04   | array<string, IndexValueObject>                  |  41,943,040 bytes | 165,675,008 bytes | 207,618,048 bytes | 0.1707 seconds |
| 05   | IndexValueObjectArray<string, IndexValueObject>  |  41,943,040 bytes | 165,675,008 bytes | 207,618,048 bytes | 0.2385 seconds |
| 06   | IndexValueObjectSet<string, IndexValueObject>    |  41,943,040 bytes | 163,577,856 bytes | 205,520,896 bytes | 0.2829 seconds |
| 07   | array<int, int>                                  |  16,781,312 bytes | 165,675,008 bytes | 182,456,320 bytes | 0.0179 seconds |
| 08   | IntArray<int, int>                               |  16,781,312 bytes | 165,675,008 bytes | 182,456,320 bytes | 0.0723 seconds |
| 09   | IntSet<int, int>                                 |  16,781,312 bytes | 121,634,816 bytes | 138,416,128 bytes | 0.0750 seconds |
| 10   | array<string, int>                               |  41,943,040 bytes | 165,675,008 bytes | 207,618,048 bytes | 0.0699 seconds |
| 11   | IntSet<string, int>                              |  41,943,040 bytes | 163,577,856 bytes | 205,520,896 bytes | 0.1230 seconds |
| 12   | IntArray<string, int>                            |  41,943,040 bytes | 165,675,008 bytes | 207,618,048 bytes | 0.1286 seconds |
| 13   | array<int, string>                               |  16,781,312 bytes | 165,675,008 bytes | 182,456,320 bytes | 0.0318 seconds |
| 14   | StringSet<int, string>                           |  16,781,312 bytes | 121,634,816 bytes | 138,416,128 bytes | 0.0914 seconds |
| 15   | StringArray<int, string>                         |  16,781,312 bytes | 165,675,008 bytes | 182,456,320 bytes | 0.0961 seconds |
| 16   | array<string, string>                            |  41,943,040 bytes | 165,675,008 bytes | 207,618,048 bytes | 0.0847 seconds |
| 17   | StringSet<string, string>                        |  41,943,040 bytes | 163,577,856 bytes | 205,520,896 bytes | 0.1461 seconds |
| 18   | StringArray<string, string>                      |  41,943,040 bytes | 165,675,008 bytes | 207,618,048 bytes | 0.1547 seconds |

### PHP 8.4 Alpha

| No.  | Title                                            | Memory usage      | Pre memory usage  | Post memory usage | Execution time |
|------|--------------------------------------------------|-------------------|-------------------|-------------------|----------------|
| 01   | array<int, IndexValueObject>                     |  16,781,312 bytes | 165,675,008 bytes | 182,456,320 bytes | 0.1188 seconds |
| 02   | IndexValueObjectArray<int, IndexValueObject>     |  16,781,312 bytes | 165,675,008 bytes | 182,456,320 bytes | 0.1861 seconds |
| 03   | IndexValueObjectSet<int, IndexValueObject>       |  16,781,312 bytes | 121,634,816 bytes | 138,416,128 bytes | 0.2861 seconds |
| 04   | array<string, IndexValueObject>                  |  41,943,040 bytes | 165,675,008 bytes | 207,618,048 bytes | 0.1749 seconds |
| 05   | IndexValueObjectArray<string, IndexValueObject>  |  41,943,040 bytes | 165,675,008 bytes | 207,618,048 bytes | 0.2473 seconds |
| 06   | IndexValueObjectSet<string, IndexValueObject>    |  41,943,040 bytes | 163,577,856 bytes | 205,520,896 bytes | 0.2780 seconds |
| 07   | array<int, int>                                  |  16,781,312 bytes | 165,675,008 bytes | 182,456,320 bytes | 0.0180 seconds |
| 08   | IntArray<int, int>                               |  16,781,312 bytes | 165,675,008 bytes | 182,456,320 bytes | 0.0757 seconds |
| 09   | IntSet<int, int>                                 |  16,781,312 bytes | 121,634,816 bytes | 138,416,128 bytes | 0.0762 seconds |
| 10   | array<string, int>                               |  41,943,040 bytes | 165,675,008 bytes | 207,618,048 bytes | 0.0704 seconds |
| 11   | IntSet<string, int>                              |  41,943,040 bytes | 163,577,856 bytes | 205,520,896 bytes | 0.1235 seconds |
| 12   | IntArray<string, int>                            |  41,943,040 bytes | 165,675,008 bytes | 207,618,048 bytes | 0.1319 seconds |
| 13   | array<int, string>                               |  16,781,312 bytes | 165,675,008 bytes | 182,456,320 bytes | 0.0321 seconds |
| 14   | StringSet<int, string>                           |  16,781,312 bytes | 121,634,816 bytes | 138,416,128 bytes | 0.0898 seconds |
| 15   | StringArray<int, string>                         |  16,781,312 bytes | 165,675,008 bytes | 182,456,320 bytes | 0.0956 seconds |
| 16   | array<string, string>                            |  41,943,040 bytes | 165,675,008 bytes | 207,618,048 bytes | 0.0853 seconds |
| 17   | StringSet<string, string>                        |  41,943,040 bytes | 163,577,856 bytes | 205,520,896 bytes | 0.1457 seconds |
| 18   | StringArray<string, string>                      |  41,943,040 bytes | 165,675,008 bytes | 207,618,048 bytes | 0.1561 seconds |
