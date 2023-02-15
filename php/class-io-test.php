<?php

class IO_Test {
	protected $directory;

	public function __construct( $directory ) {
		$this->directory = rtrim( $directory, '/\\' );
	}

	protected function delete( $path ) {
		$path = rtrim( $path, '/\\' );

		if ( is_dir( $path ) ) {
			foreach ( glob( $path . '/*' ) as $file ) {
				$this->delete( $file );
			}
	
			return rmdir( $path );
		}
		
		if ( is_file( $path ) ) {
			return unlink( $path );
		}

		return false;
	}

	protected function reset() {
		$this->delete( $this->directory );

		mkdir( $this->directory );
	}

	public function run( int $count ) {
		$this->reset();

		$tests = [
			'file_put_contents' => new Runner(
				function ( $counter ) {
					return file_put_contents( $this->filename( $counter ), sprintf( '<?php return %d;', microtime( true ) ) );
				},
				$count
			),
			'file_exists' => new Runner(
				function ( $counter ) {
					return file_exists( $this->filename( $counter ) );
				},
				$count
			),
			'require' => new Runner(
				function ( $counter ) {
					require $this->filename( $counter );
				},
				$count
			),
			'file_get_contents' => new Runner(
				function ( $counter ) {
					file_get_contents( $this->filename( $counter ) );
				},
				$count
			),
			'file_exists non-existant' => new Runner(
				function ( $counter ) use ( $count ) {
					return file_exists( $this->filename( $count + $counter ) ); // Pad to ensure the file does not exist.
				},
				$count
			),
		];

		$results = [
			sprintf( 'Results for %d runs:', $count ),
		];

		foreach ( $tests as $test_name => $test ) {
			$this->log( sprintf( 'Testing "%s".', $test_name ) );

			$test->run();

			$results[] = sprintf( 
				'Test "%s" took %f seconds.', 
				$test_name,
				$test->time_delta
			);
		}

		$this->log( $results );
	}

	protected function log( $strings ) {
		if ( is_array( $strings ) ) {
			foreach ( $strings as $string ) {
				$this->log( $string );
			}
		} else {
			echo $strings . "\n";
		}
	}

	protected function filename( int $id ) {
		return sprintf( '%s/file-%d.php', $this->directory, $id );
	}
}