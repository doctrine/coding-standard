.PHONY: test test-report test-fix update-compatibility-patch

PHP_74_OR_NEWER:=$(shell php -r "echo (int) version_compare(PHP_VERSION, '7.4', '>=');")
PHP_80_OR_NEWER:=$(shell php -r "echo (int) version_compare(PHP_VERSION, '8.0', '>=');")

test: test-report test-fix

test-report: vendor
	@if [ $(PHP_74_OR_NEWER) -eq 1 ]; then git apply tests/php-compatibility.patch; fi
	@if [ $(PHP_80_OR_NEWER) -eq 1 ]; then git apply tests/php-compatibility-80.patch; fi
	@vendor/bin/phpcs `find tests/input/* | sort` --report=summary --report-file=phpcs.log; diff -u tests/expected_report.txt phpcs.log; if [ $$? -ne 0 ]; then if [ $(PHP_74_OR_NEWER) -eq 1 ]; then git apply -R tests/php-compatibility.patch; fi; if [ $(PHP_80_OR_NEWER) -eq 1 ]; then git apply -R tests/php-compatibility-80.patch; fi; exit 1; fi
	@if [ $(PHP_74_OR_NEWER) -eq 1 ]; then git apply -R tests/php-compatibility.patch; fi
	@if [ $(PHP_80_OR_NEWER) -eq 1 ]; then git apply -R tests/php-compatibility-80.patch; fi

test-fix: vendor
	@if [ $(PHP_74_OR_NEWER) -eq 1 ]; then git apply tests/php-compatibility.patch; fi
	@if [ $(PHP_80_OR_NEWER) -eq 1 ]; then git apply tests/php-compatibility-80.patch; fi
	@cp -R tests/input/ tests/input2/
	@vendor/bin/phpcbf tests/input2; diff -u tests/input2 tests/fixed; if [ $$? -ne 0 ]; then rm -rf tests/input2/ && if [ $(PHP_74_OR_NEWER) -eq 1 ]; then git apply -R tests/php-compatibility.patch; fi; if [ $(PHP_74_OR_NEWER) -eq 1 ]; then git apply -R tests/php-compatibility.patch; fi; exit 1; fi
	@rm -rf tests/input2/ && if [ $(PHP_74_OR_NEWER) -eq 1 ]; then git apply -R tests/php-compatibility.patch; fi
	@rm -rf tests/input2/ && if [ $(PHP_80_OR_NEWER) -eq 1 ]; then git apply -R tests/php-compatibility-80.patch; fi

update-compatibility-patch-74:
	@git apply tests/php-compatibility.patch
	@printf "Please open your editor and apply your changes\n"
	@until [ "$${compatibility_resolved}" == "y" ]; do read -p "Have finished your changes (y|n)? " compatibility_resolved; done && compatibility_resolved=
	@git diff -- tests/expected_report.txt tests/fixed > .tmp-patch && mv .tmp-patch tests/php-compatibility.patch && git apply -R tests/php-compatibility.patch
	@git commit -m 'Update compatibility patch' tests/php-compatibility.patch

update-compatibility-patch-80:
	@git apply tests/php-compatibility-80.patch
	@printf "Please open your editor and apply your changes\n"
	@until [ "$${compatibility_resolved}" == "y" ]; do read -p "Have finished your changes (y|n)? " compatibility_resolved; done && compatibility_resolved=
	@git diff -- tests/expected_report.txt tests/fixed > .tmp-patch-80 && mv .tmp-patch-80 tests/php-compatibility-80.patch && git apply -R tests/php-compatibility-80.patch
	@git commit -m 'Update compatibility patch' tests/php-compatibility-80.patch

vendor: composer.json
	composer update
	touch -c vendor
