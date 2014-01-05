<?php
require_once 'ResponseTest.php';
class MatchResponseTest extends ResponseTest {
	
	// The 'index' action should return a 2** HTTP response
	public function testIndexResponse()
	{
		$crawler = $this->client->request('GET', '/match');
		$this->isHTMLResponseOk($crawler);
	}
}