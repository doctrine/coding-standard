.PHONY: test test-report test-fix

test: test-report test-fix

test-report: vendor
	@vendor/bin/phpcs `find tests/input/* | sort` --report=summary --report-file=phpcs.log; diff tests/expected_report.txt phpcs.log


test-fix: vendor
	@cp -R tests/input/ tests/input2/
	@vendor/bin/phpcbf tests/input2; diff tests/input2 tests/fixed; if [ $$? -ne 0 ]; then rm -rf tests/input2/; exit 1; fi
	@rm -rf tests/input2/

vendor: composer.json
	composer update
