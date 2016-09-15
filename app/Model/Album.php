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
  public $hasMany = array(
    'Photo' => array(
      'className' => 'Photo',
      'foreignKey' => 'album_id',
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

	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

  public function getAlbumsByUserid($userid,$role) {
    if($role > 1) {
        return $this->find('all', array(
        'conditions' => array(
          'Album.user_id' => $userid,
        ),
        'fields' => array('Album.id', 'Album.title', 'Album.user_id'),
        'recursive' => -1
      ));
    }
    else{
      return $this->find('all', array(
        'fields' => array('Album.id', 'Album.title', 'Album.user_id'),
        'recursive' => -1
      ));
    }
  }

  public function getAlbumDataById($album_id) {
    if($album_id > 1) {
      return $this->find('all', array(
        'conditions' => array(
          'Album.id' => $album_id,
        ),
        'fields' => array('Album.id', 'Album.title', 'Album.user_id'),
        'recursive' => -1
      ));
    }
    else{
      return $this->find('all', array(
        'fields' => array('Album.id', 'Album.title', 'Album.user_id'),
        'recursive' => -1
      ));
    }
  }
}
