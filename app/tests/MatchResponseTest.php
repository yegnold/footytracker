<?php
require_once 'ResponseTest.php';
class MatchResponseTest extends ResponseTest {
	
	// The 'index' action should return a 2** HTTP response
	public function testIndexResponse()
	{
		$crawler = $this->client->request('GET', '/match');
		$this->isHTMLResponseOk($crawler);
	}

	// The 'create' action should return a 2** HTTP response
	public function testCreateResponse() {
		$this->refreshApplication();
		$crawler = $this->client->request('GET', '/match/create');
		$this->isHTMLResponseOk($crawler);
		return $crawler;
	}

	/**
	 * Only run this test if testCreateResponse passes:
	 * @depends testCreateResponse
	 * Note: $crawler is passed from the return value of the depends value.
	 */
	public function testCreateFormExists($crawler) {
		$create_form = $crawler->filter('#create_match_form');
		$this->assertCount(1, $create_form, 'There is no #create_match_form on the page');
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