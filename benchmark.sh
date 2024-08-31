#!/bin/bash

echo "******************************************************"
echo "*  ___ _  _ ___             _                   _    *"
echo "* | _ \ || | _ \___ _ _  __| |_  _ __  __ _ _ _| |__ *"
echo "* |  _/ __ |  _/ -_) ' \/ _| ' \| '  \/ _\` | '_| / / *"
echo "* |_| |_||_|_| \___|_||_\__|_||_|_|_|_\__,_|_| |_\_\ *"
echo "*                                                    *"
echo "*   The best thing since array_slice(\$breads, 42)    *"
echo "*                                                    *"
echo "*         Running benchmarks on PHP versions         *"
echo "*                                                    *"
echo "******************************************************"

echo "Building images and running benchmarks..."

docker compose up --build -d --quiet-pull >/dev/null

check_services_stopped() {
  status=$(docker compose ps -q | xargs docker inspect -f '{{ .State.Status }}')

  if [[ -z "$status" ]]; then
    return 0
  else
    return 1
  fi
}

while ! check_services_stopped; do
  sleep 1
done

output_php81=$(docker compose logs php81-benchmark)
echo ""
echo "-------------------------------------------------------------------------"
echo "PHP 8.1 Benchmark:"
echo "$output_php81"
echo "-------------------------------------------------------------------------"

output_php82=$(docker compose logs php82-benchmark)
echo ""
echo "-------------------------------------------------------------------------"
echo "PHP 8.2 Benchmark:"
echo "$output_php82"
echo "-------------------------------------------------------------------------"

output_php83=$(docker compose logs php83-benchmark)
echo ""
echo "-------------------------------------------------------------------------"
echo "PHP 8.3 Benchmark:"
echo "$output_php83"
echo "-------------------------------------------------------------------------"

output_php84=$(docker compose logs php84-benchmark)
echo ""
echo "-------------------------------------------------------------------------"
echo "PHP 8.4 Alpha Benchmark:"
echo "$output_php84"
echo "-------------------------------------------------------------------------"

docker compose down
