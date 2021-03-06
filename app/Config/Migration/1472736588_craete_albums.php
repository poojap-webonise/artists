<?php
class CraeteAlbums extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'craete_albums';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
      'create_table'=>array(
        'albums'=>array(
          'id'=>array(
            'type' => 'integer',
            'length' => 11,
            'null' => false,
            'key' => 'primary',
            'autoIncrement' => true
          ),
          'name'=>array(
            'type' => 'string',
            'null' => false,
            'default' => null
          ),
          'user_id'=>array(
            'type' => 'integer',
            'length' => 11,
            'null' => false,
            'key' => 'primary'
          ),
          'image_path'=>array(
            'type' => 'string',
            'null' => false,
            'default' => null
          )
        )
      ),
      'create_field' => array(
        'albums' => array(
          'title' => array(
            'type' => 'string',
            'null' => true,
            'length' => 255
          ),
          'image_path' => array(
            'type' => 'string',
            'null' => true,
            'length' => 255
          )
        )
      )

		),
		'down' => array(
      'drop_table'=>array('albums')
		),
	);

/**
 * Before migration callback
 *
 * @param string $direction Direction of migration process (up or down)
 * @return bool Should process continue
 */
	public function before($direction) {
		return true;
	}

/**
 * After migration callback
 *
 * @param string $direction Direction of migration process (up or down)
 * @return bool Should process continue
 */
	public function after($direction) {
		return true;
	}
}
