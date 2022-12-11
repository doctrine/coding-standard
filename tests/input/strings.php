<?php

declare(strict_types=1);

namespace Strings;

$doc = <<<TEXT
text without special chars
TEXT;

$interpolated = <<<TEXT
HEREDOC with interpolation like $doc is fine.
TEXT;

echo "This should appear in single quotes.";

echo "This string\tmay appear\nin double quotes.";

echo "String interpolation like $doc should be avoided.";
