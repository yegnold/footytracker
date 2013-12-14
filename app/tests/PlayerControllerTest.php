<?php

class PlayerControllerTest extends TestCase {

	/**
	 * Does the index of the Playerrs section return with an OK HTTP response?
	 *
	 * @return void
	 */
	public function testIndexResponseOk()
	{
		$crawler = $this->client->request('GET', '/player');

		$this->assertTrue($this->client->getResponse()->isOk());
	}

	/**
	 * Does the index of the controller return a h1 heading containing 'Players'?
	 */
	public function testH1Content() {
		/**
		 * Does the homepage of the application return a h1 heading containing 'FootyTracker'?
		 */
		$crawler = $this->client->request('GET', '/player');
		$this->assertCount(1, $crawler->filter('h1:contains("Players")'));
	}

}