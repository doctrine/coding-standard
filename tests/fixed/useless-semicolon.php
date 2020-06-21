<?php

declare(strict_types=1);

while (! true) {
    echo 1;
}

do {
    echo 1;
} while (! false);

for (;;) {
    echo 'To infity and beyond';
}

for (
    $i = 0; $i < 10;
    $i++
);
{
    echo 'This will not be executed inside the for-loop';
}

$myvar = 3;
