<?php

include __DIR__ . '/vendor/autoload.php';

$test = new banana\test\MonkeyTest;
$test->run();
$test->status();
