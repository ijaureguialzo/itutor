#!/bin/bash
# Lint pass: every PHP file of the application must parse under PHP 8.x.
# Template skeletons with ##PLACEHOLDER## class names are not valid PHP and
# are excluded (they are only expanded by the generator before use).
set -u

fail=0
total=0

cd /var/www || exit 1

while IFS= read -r f; do
  # skip runtime-generated directories
  case "$f" in
    ./cache/*|./log/*) continue ;;
  esac
  # skip Symfony generator template skeletons (contain ##PLACEHOLDER## tokens)
  if grep -qs '##[A-Z_]*##' "$f"; then
    continue
  fi
  total=$((total + 1))
  if ! out=$(php -l "$f" 2>&1); then
    echo "LINT FAIL: $f"
    echo "$out" | sed -n '1,2p'
    fail=$((fail + 1))
  fi
done < <(find . -name "*.php" -type f)

echo "----------------------------------------"
echo "Lint: $((total - fail))/$total files OK"
[ "$fail" -eq 0 ] || exit 1
