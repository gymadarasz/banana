<?php

include __DIR__ . '/vendor/autoload.php';

use banana\test\JSONParseTest;
use banana\test\MonkeyTest;
use banana\test\Test;

$test = new MonkeyTest;
$test->run();
$jsonTest = new JSONParseTest;
$jsonTest->run();
Test::status();
