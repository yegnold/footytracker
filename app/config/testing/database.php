<?php

/**
 * When testing models I'm not really interested in using the full MySQL database driver
 * As this means it's difficult to test in each environment.
 *
 * I prefer to use a file-based database storage engine as this can ship with the software
 * and tests can be ran regardless of MySQL username/password.
 */
return array(

	'fetch' => PDO::FETCH_CLASS,
	'default' => 'sqlite',

	'connections' => array(

		'sqlite' => array(
			'driver'   => 'sqlite',
			'database' => __DIR__.'/../../database/testing.sqlite',
			'prefix'   => '',
		),

	),

	'migrations' => 'migrations',

);
