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
	Results for 10000 runs:
	Test "file_put_contents" took 5.268262 seconds.
	Test "file_exists" took 0.535983 seconds.
	Test "require" took 3.596618 seconds.
	Test "file_get_contents" took 3.717043 seconds.
	Test "file_exists non-existant" took 0.511945 seconds.
