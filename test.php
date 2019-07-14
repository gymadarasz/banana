<?php

include __DIR__ . '/vendor/autoload.php';

use banana\test\JSONParseTest;
use banana\test\MonkeyTest;
use banana\test\Test;

Test::runAll([
    MonkeyTest::class,
    JSONParseTest::class
]);

Test::status();
