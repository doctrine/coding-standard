<?php

declare(strict_types=1);

$test = 1;

$test++;

if (! $test > 0) {
    echo 1;
} elseif (! $test === 0) {
    echo 0;
} else {
    echo -1;
}

while (! true) {
    echo 1;
}

do {
    echo 1;
} while (! true);
