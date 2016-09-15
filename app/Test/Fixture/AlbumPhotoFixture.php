<?php
/**
 * AlbumPhoto Fixture
 */
class AlbumPhotoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 50, 'unsigned' => false, 'key' => 'primary'),
		'album_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 50, 'unsigned' => false),
		'image_path' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array(
			
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'album_id' => 1,
			'image_path' => 'Lorem ipsum dolor sit amet'
		),
	);

}
