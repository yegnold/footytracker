<?php
/**
 * I'm going to define the isResponseOk method in it's own class
 * as this test is going to be shared by most actions in my application
 * DRY!
 */
class ResponseTest extends TestCase {

	/**
	 * This method asserts that the framework responds with a 2** status code (OK)
	 * and that the returned HTML contains <title>.
	 * This catches problems like missing/incorrectly implemented blade views
	 */
	protected function isHTMLResponseOk($crawler) {

		// Is HTTP status OK?
		$this->assertTrue($this->client->getResponse()->isOk());

		// Make sure we have a <title> tag in our response
		$this->assertGreaterThan(
		    0,
		    $crawler->filter('title')->count()
		);
	}
}