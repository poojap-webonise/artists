<?php
App::uses('AppController', 'Controller');
App::uses('AlbumsAppModel', 'Albums.Model');
/**
 * Albums Controller
 *
 * @property Album $Album
 * @property PaginatorComponent $Paginator
 */
class AlbumsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Album->recursive = 0;
    $albums['sessionData'] = $this->Session->read('User');
    $albums['getAlbumsByUserid'] = $this->Album->getAlbumsByUserid($albums['sessionData']['userid']);
    $albums['paginator'] = $this->Paginator->paginate();
		$this->set('albums', $albums);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Album->exists($id)) {
			throw new NotFoundException(__('Invalid album'));
		}
		$options = array('conditions' => array('Album.' . $this->Album->primaryKey => $id));
		$this->set('album', $this->Album->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Album->create();
			if ($this->Album->save($this->request->data)) {
				$this->Flash->success(__('The album has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The album could not be saved. Please, try again.'));
			}
		}
		$users = $this->Album->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Album->exists($id)) {
			throw new NotFoundException(__('Invalid album'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Album->save($this->request->data)) {
				$this->Flash->success(__('The album has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The album could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Album.' . $this->Album->primaryKey => $id));
			$this->request->data = $this->Album->find('first', $options);
		}
		$users = $this->Album->User->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Album->id = $id;
		if (!$this->Album->exists()) {
			throw new NotFoundException(__('Invalid album'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Album->delete()) {
			$this->Flash->success(__('The album has been deleted.'));
		} else {
			$this->Flash->error(__('The album could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
