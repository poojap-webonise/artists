<?php
App::uses('AppModel', 'Model');
/**
 * Album Model
 *
 * @property User $User
 */
class Album extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

  public function getAlbumsByUserid($userid) {

    return $this->find('all', array(
      'conditions' => array(
        'Album.user_id' => $userid,
      ),
      'fields' => array('Album.id', 'Album.title', 'Album.user_id'),
      'recursive' => -1
    ));
  }
}
