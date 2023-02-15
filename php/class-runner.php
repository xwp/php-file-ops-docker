<?php

class Runner {
	private $callback;
	private $count;

	public $memory_delta;
	public $time_delta;

	public function __construct( callable $callback, int $count ) {
		$this->callback = $callback;
		$this->count = $count;
	}

	public function run() {
		$time_start = microtime( true );
		$memory_start = memory_get_usage();

		$counter = 0;

		while ( $counter < $this->count ) {
			call_user_func( $this->callback, $counter );

			$counter++;
		}

		$this->time_delta = microtime( true ) - $time_start;
		$this->memory_delta = memory_get_usage() - $memory_start;
	}
}
