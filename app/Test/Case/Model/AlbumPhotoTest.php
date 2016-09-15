<?php
App::uses('AlbumPhoto', 'Model');

/**
 * AlbumPhoto Test Case
 */
class AlbumPhotoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.album_photo',
		'app.album',
		'app.user',
		'app.albums'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->AlbumPhoto = ClassRegistry::init('AlbumPhoto');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->AlbumPhoto);

		parent::tearDown();
	}

}
