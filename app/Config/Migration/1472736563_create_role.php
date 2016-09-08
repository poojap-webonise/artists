<?php
class CreateRole extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'create_role';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
      'create_table'=>array(
        'role'=>array(
          'id'=>array(
            'type' => 'integer',
            'length' => 11,
            'null' => false,
            'key' => 'primary',
            'autoIncrement' => true,
          ),
          'role'=>array(
            'type' => 'string',
            'null' => false,
            'default' => null
          )
        )
      ),
      'create_field' => array(
        'role' => array(
          'role' => array(
            'type' => 'string',
            'null' => true,
            'length' => 255
          ),
        )
      )
		),
		'down' => array(
      'drop_table'=>array('role')
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
