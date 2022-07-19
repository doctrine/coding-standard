.PHONY: test test-report test-fix update-compatibility-patch

test: test-report test-fix

test-report: vendor
	./bin/test-report

test-fix: vendor
	./bin/test-fix

update-compatibility-patch-72:
	@git apply tests/php72-compatibility.patch
	@printf "Please open your editor and apply your changes\n"
	@until [ "$${compatibility_resolved}" == "y" ]; do read -p "Have finished your changes (y|n)? " compatibility_resolved; done && compatibility_resolved=
	@git diff -- tests/expected_report.txt tests/fixed tests/input > .tmp-patch && mv .tmp-patch tests/php72-compatibility.patch && git apply -R tests/php72-compatibility.patch
	@git commit -m 'Update compatibility patch' tests/php72-compatibility.patch

update-compatibility-patch-73:
	@git apply tests/php73-compatibility.patch
	@printf "Please open your editor and apply your changes\n"
	@until [ "$${compatibility_resolved}" == "y" ]; do read -p "Have finished your changes (y|n)? " compatibility_resolved; done && compatibility_resolved=
	@git diff -- tests/expected_report.txt tests/fixed tests/input > .tmp-patch && mv .tmp-patch tests/php73-compatibility.patch && git apply -R tests/php73-compatibility.patch
	@git commit -m 'Update compatibility patch' tests/php73-compatibility.patch

update-compatibility-patch-74:
	@git apply tests/php74-compatibility.patch
	@printf "Please open your editor and apply your changes\n"
	@until [ "$${compatibility_resolved}" == "y" ]; do read -p "Have finished your changes (y|n)? " compatibility_resolved; done && compatibility_resolved=
	@git diff -- tests/expected_report.txt tests/fixed tests/input > .tmp-patch && mv .tmp-patch tests/php74-compatibility.patch && git apply -R tests/php74-compatibility.patch
	@git commit -m 'Update compatibility patch' tests/php74-compatibility.patch

update-compatibility-patch-80:
	@git apply tests/php80-compatibility.patch
	@printf "Please open your editor and apply your changes\n"
	@until [ "$${compatibility_resolved}" == "y" ]; do read -p "Have finished your changes (y|n)? " compatibility_resolved; done && compatibility_resolved=
	@git diff -- tests/expected_report.txt tests/fixed tests/input > .tmp-patch && mv .tmp-patch tests/php80-compatibility.patch && git apply -R tests/php80-compatibility.patch
	@git commit -m 'Update compatibility patch' tests/php80-compatibility.patch

vendor: composer.json
	composer update
	touch -c vendor
