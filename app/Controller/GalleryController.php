<?php
App::uses('AlbumsAppModel', 'Albums.Model');
App::uses('AppController', 'Controller');

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property AclComponent $Acl
 * @property SecurityComponent $Security
 * @property RequestHandlerComponent $RequestHandler
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class GalleryController extends AppController {

/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array('Text', 'Js', 'Time');

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Acl', 'Security', 'RequestHandler', 'Session', 'Flash','Email');

/**
 * index method
 *
 * @return void
 */
	public function index() {
    $this->loadModel('Photo');
    $this->loadModel('Album');

    $this->Album->recursive = 1;
    $options = array('conditions' => array('Album.' . 'is_published' => 'y'));
    $this->set('album', $this->Album->find('all', $options));
	}
}
