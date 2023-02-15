<?php

require_once __DIR__ . '/php/class-io-test.php';
require_once __DIR__ . '/php/class-runner.php';

$io_test = new IO_Test( __DIR__ . '/files' );

$io_test->run( 10000 );
