<?php
require_once 'ResponseTest.php';
class PlayerControllerTest extends ResponseTest {
	
	// The 'index' action should return a 2** HTTP response with a h1 containing "Players"
	public function testIndexResponse()
	{
		$crawler = $this->client->request('GET', '/player');
		$this->isHTMLResponseOk($crawler);
		$this->assertCount(1, $crawler->filter('h1:contains("Players")'), 'h1 tag containing "Players" does not exist');
	}

	// The 'create' action should return a 2** HTTP response with a h2 containing "Add Players"
	public function testCreateResponse() {
		$this->refreshApplication();
		$crawler = $this->client->request('GET', '/player/create');
		$this->isHTMLResponseOk($crawler);
		$this->assertCount(1, $crawler->filter('h2:contains("Add Player")'), 'h2 tag containing "Add Player" does not exist');
		return $crawler;
	}

	/**
	 * Only run this test if testCreateResponse passes:
	 * @depends testCreateResponse
	 * Note: $crawler is passed from the return value of the depends value.
	 */
	public function testCreateFormExists($crawler) {
		$create_form = $crawler->filter('#create_player_form');
		$this->assertCount(1, $create_form, 'There is no #create_player_form on the page');
		return $create_form;
	}

	/**
	 * Only run this test if testCreateFormExists passes:
	 * @depends testCreateFormExists
	 * Note: $create_form is passed from the return value of the depends value.
	 */
	public function testCreateFormIsPostAction($create_form) {
		$form = $create_form->form();
		$this->assertEquals('POST', $form->getMethod(), 'The form method is not set to POST');
	}
}