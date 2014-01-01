<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

	/**
	 * Creates the application.
	 *
	 * @return \Symfony\Component\HttpKernel\HttpKernelInterface
	 */
	public function createApplication()
	{
		$unitTesting = true;

		$testEnvironment = 'testing';

		return require __DIR__.'/../../bootstrap/start.php';
	}

	/**
	 * For tests where models will be tested, we want a utility to get the database in a testable state
	 */
	public function setUpDatabase() {

		/**
		 * We will be doing a little database testing in this model.
		 * So we want to refresh our test database by rolling back and re-running all migrations... and seeding the database
		 */
		Artisan::call('migrate');
		Artisan::call('db:seed');
	}

	public function teardownDb()
    {
        Artisan::call('migrate:reset');
    }
}
