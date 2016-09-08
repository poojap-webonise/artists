<?php
class AlbumsCreation extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'albums_creation';

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
          'title'=>array(
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
