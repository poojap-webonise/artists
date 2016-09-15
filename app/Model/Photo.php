<?php
App::uses('AppModel', 'Model');
/**
 * Photo Model
 *
 * @property Album $Album
 */
class Photo extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Album' => array(
			'className' => 'Album',
			'foreignKey' => 'album_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

  public function getAlbumDataById($id)
  {

  }
}
