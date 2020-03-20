<?php

declare(strict_types=1);

(function (): void {
    echo 'Hello';
})();

new class {
    public function __construct()
    {
        (function (): iterable {
            yield $this;
        })();
    }
};
