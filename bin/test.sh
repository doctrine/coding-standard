#!/bin/sh

./vendor/bin/phpcs tests/input --report=summary --report-file=phpcs.log
diff tests/expected_report.txt phpcs.log
