<?php

class HomepageResponseTest extends TestCase {

	/**
	 * Does the homepage of the application return with an OK HTTP response?
	 *
	 * @return void
	 */
	public function testHomepageResponseOk()
	{
		$crawler = $this->client->request('GET', '/');

		$this->assertTrue($this->client->getResponse()->isOk());
	}

	/**
	 * Does the homepage of the application return a h1 heading containing 'FootyTracker'?
	 */
	public function testH1Content() {
		/**
		 * Does the homepage of the application return a h1 heading containing 'FootyTracker'?
		 */
		$crawler = $this->client->request('GET', '/');
		$this->assertCount(1, $crawler->filter('h1:contains("FootyTracker")'));
	}

}