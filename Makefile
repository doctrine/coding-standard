.PHONY: test test-report test-fix update-compatibility-patch

PHP_VERSION:=$(shell php -r "echo PHP_MAJOR_VERSION.PHP_MINOR_VERSION;")
PATCH_FILE="tests/php$(PHP_VERSION)-compatibility.patch"

test: test-report test-fix

test-report: vendor
	@if [ -f "$(PATCH_FILE)" ]; then git apply $(PATCH_FILE) ; fi
	@vendor/bin/phpcs `find tests/input/* | sort` --report=summary --report-file=phpcs.log; diff -u tests/expected_report.txt phpcs.log; if [ $$? -ne 0 ] && [ -f "$(PATCH_FILE)" ]; then git apply -R $(PATCH_FILE) ; exit 1; fi
	@if [ -f "$(PATCH_FILE)" ]; then git apply -R $(PATCH_FILE) ; fi

test-fix: vendor
	@if [ -f "$(PATCH_FILE)" ]; then git apply $(PATCH_FILE) ; fi
	@cp -R tests/input/ tests/input2/
	@vendor/bin/phpcbf tests/input2; diff -u tests/input2 tests/fixed; if [ $$? -ne 0 ]; then rm -rf tests/input2/; if [ -f "$(PATCH_FILE)" ]; then git apply -R $(PATCH_FILE) ; fi; exit 1; fi
	@rm -rf tests/input2/;
	@if [ -f "$(PATCH_FILE)" ]; then git apply -R $(PATCH_FILE) ; fi

update-compatibility-patch-74:
	@git apply tests/php74-compatibility.patch
	@printf "Please open your editor and apply your changes\n"
	@until [ "$${compatibility_resolved}" == "y" ]; do read -p "Have finished your changes (y|n)? " compatibility_resolved; done && compatibility_resolved=
	@git diff -- tests/expected_report.txt tests/fixed > .tmp-patch && mv .tmp-patch tests/php74-compatibility.patch && git apply -R tests/php74-compatibility.patch
	@git commit -m 'Update compatibility patch' tests/php74-compatibility.patch

update-compatibility-patch-80:
	@git apply tests/php80-compatibility.patch
	@printf "Please open your editor and apply your changes\n"
	@until [ "$${compatibility_resolved}" == "y" ]; do read -p "Have finished your changes (y|n)? " compatibility_resolved; done && compatibility_resolved=
	@git diff -- tests/expected_report.txt tests/fixed > .tmp-patch-80 && mv .tmp-patch-80 tests/php80-compatibility.patch && git apply -R tests/php80-compatibility.patch
	@git commit -m 'Update compatibility patch' tests/php80-compatibility.patch

update-compatibility-patch-81:
	@git apply tests/php81-compatibility.patch
	@printf "Please open your editor and apply your changes\n"
	@until [ "$${compatibility_resolved}" == "y" ]; do read -p "Have finished your changes (y|n)? " compatibility_resolved; done && compatibility_resolved=
	@git diff -- tests/expected_report.txt tests/fixed > .tmp-patch-81 && mv .tmp-patch-80 tests/php81-compatibility.patch && git apply -R tests/php81-compatibility.patch
	@git commit -m 'Update compatibility patch' tests/php81-compatibility.patch

vendor: composer.json
	composer update
	touch -c vendor
