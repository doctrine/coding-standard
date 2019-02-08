<?php

declare(strict_types=1);

foreach ([1, 2, 3] as $i) {
    switch ($i) {
        case 1:
            break;
        case 2:
            continue 2;
        case 3:
            break;
    }

    foo();
}
