<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Album $Album
 */
class User extends AppModel {

  public $validate = array(
    'username' => array(
      'required' => array(
        'rule' => 'notBlank',
        'message' => 'A username is required'
      )
    ),
    'password' => array(
      'required' => array(
        'rule' => 'notBlank',
        'message' => 'A password is required'
      )
    ),
    'first_name' => array(
      'valid' => array(
        'rule' => array('notBlank'),
        'message' => 'Please enter a valid first name',
        'allowEmpty' => false
      )
    ),
    'last_name' => array(
      'valid' => array(
        'rule' => array('notBlank'),
        'message' => 'Please enter a valid last name',
        'allowEmpty' => false
      )
    )
  );
	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Album' => array(
			'className' => 'Album',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

  public function isValidUser($username) {

    return $this->find('first', array(
      'conditions' => array(
        'User.username' => $username,
      ),
      'fields' => array('User.id', 'User.first_name', 'User.last_name', 'User.username','User.password','User.role'),
      'recursive' => -1
    ));
  }

  public function isUserExist($username)
  {
    return $this->find('first', array(
      'conditions' => array(
        'User.username' => $username,
      ),
      'fields' => array('User.id', 'User.first_name', 'User.last_name', 'User.username','User.password','User.role'),
      'recursive' => -1
    ));
  }
}
