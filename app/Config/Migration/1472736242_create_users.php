<?php
class CreateUsers extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'create_users';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
      'create_table' => array(
        'users' => array(
          'id' => array(
            'type' => 'integer',
            'length' => 11,
            'null' => false,
            'key' => 'primary',
            'autoIncrement' => true,
          ),
          'username' => array(
            'type' => 'string',
            'null' => false,
            'default' => null
          ),
          'password' => array(
            'type' => 'string',
            'null' => false,
            'default' => null
          ),
          'first_name' => array(
            'type' => 'string',
            'null' => false,
            'default' => null
          ),
          'last_name' => array(
            'type' => 'string',
            'null' => false,
            'default' => null
          ),
          'role' => array(
            'type' => 'integer',
            'null' => false,
            'default' => null
          )
        )
      ),
      'create_field' => array(
        'users' => array(
          'username' => array(
            'type' => 'string',
            'null' => true,
            'length' => 255
          ),
          'password' => array(
            'type' => 'string',
            'null' => true,
            'length' => 255
          ),
          'first_name' => array(
            'type' => 'string',
            'null' => true,
            'length' => 255
          ),
          'last_name' => array(
            'type' => 'string',
            'null' => true,
            'length' => 255
          ),

        ),

      )
		),
		'down' => array(
      'drop_table'=>array('users')
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
