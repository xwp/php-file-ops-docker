# PHP File Operations Test with Docker

To run the benchmarks `php app.php` inside the Docker environment:

	docker-compose run --rm wordpress php app.php

or on your host machine:

	php app.php

which would produce the following results:

	Testing "file_put_contents".
	Testing "file_exists".
	Testing "require".
	Testing "file_get_contents".
	Testing "file_exists non-existant".
	Results for 100000 runs:
	Test "file_put_contents" took 46.057737 seconds.
	Test "file_exists" took 8.424900 seconds.
	Test "require" took 44.415025 seconds.
	Test "file_get_contents" took 49.123835 seconds.
	Test "file_exists non-existant" took 6.551332 seconds.
