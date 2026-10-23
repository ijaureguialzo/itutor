#!/bin/bash
# Full test run: lint + functional battery.
set -e

echo "=== [1/2] PHP 8 lint pass over the application ==="
bash /tests/lint.sh

echo
echo "=== [2/2] Functional battery (HTTP) ==="
php /tests/itutor_test.php
