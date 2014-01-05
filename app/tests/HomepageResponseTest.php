<?php
require_once 'ResponseTest.php';
class HomepageResponseTest extends ResponseTest {

	/**
	 * Does the homepage of the application return with an OK HTTP response with a heading of FootyTracker?
	 *
	 * @return void
	 */
	public function testHomepageResponse()
	{
		$crawler = $this->client->request('GET', '/');
		$this->assertRedirectedTo('/player/index');
	}

}