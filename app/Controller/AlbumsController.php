<?php
App::uses('AppController', 'Controller');
App::uses('AlbumsAppModel', 'Albums.Model');
App::uses('PhotosAppModel', 'Photos.Model');
App::uses('File', 'Utility');
App::uses('Folder', 'Utility');
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
    if($this->isAuthorized('index')) {
      $this->Album->recursive = 0;
      $albums['sessionData'] = $this->Session->read('User');
      $albums['getAlbumsByUserid'] = $this->Album->getAlbumsByUserid($albums['sessionData']['userid'],
        $albums['sessionData']['role']);
      $albums['paginator'] = $this->Paginator->paginate();
      $this->set('albums', $albums);
    }
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
    if($this->isAuthorized('view')) {
      $this->loadModel('Photo');
      if(!$this->Album->exists($id)) {
        throw new NotFoundException(__('Invalid album'));
      }
      // $photos = $this->Photo->getAlbumDataById($id);
      $options = array('conditions' => array('Photo.album_id' => $id));
      $this->set('album', $this->Photo->find('all', $options));
    }
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
    if($this->isAuthorized()) {
      $this->loadModel('Photo');
      if($this->request->is('post')) {
        $file = $this->data['Album']['upload']; //put the data into a var for easy use
        $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
        $arr_ext = array('jpg', 'jpeg', 'gif', 'png'); //set allowed extensions
        //only process if the extension is valid
        if(in_array($ext, $arr_ext)) {
          move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/' . $file['name']);
          //prepare the filename for database entry
          $this->data['Album']['image_path'] = $file['name'];
          $saveData['Album']['image_path'] = $file['name'];
          $saveData['Album']['user_id'] = $this->data['Album']['user_id'];
          $saveData['Album']['title'] = $this->data['Album']['title'];
          $saveData['Album']['is_published'] = 'n';
          $this->Album->create();
          $insertid = $this->Album->save($saveData);
          if($this->Album->save($saveData)) {
            $saveData['Album']['image_path'] = $file['name'];
            $saveData['Album']['album_id'] = $insertid['Album']['id'];
            $this->Photo->create();
            $this->Photo->saveAll($saveData['Album']);
            $this->Flash->success(__('The album has been saved.'));

            return $this->redirect(array('action' => 'index'));
          } else {
            $this->Flash->error(__('The album could not be saved. Please, try again.'));
          }
        } else {
          $this->Flash->error(__('File format did not match. Please, try again.'));
        }
      }
      $users = $this->Album->User->find('list');
      $this->set(compact('users'));
    }
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
    $this->loadModel('Photo');
		if (!$this->Album->exists($id)) {
			throw new NotFoundException(__('Invalid album'));
		}
		if ($this->request->is(array('post', 'put'))) {
      $this->Album->id = $id;
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
    $options = array('conditions' => array('Photo.album_id' => $id));
    $this->set('album', $this->Photo->find('all', $options));
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

  public function addPhoto($album_id=null)
  {
      $this->loadModel('Photo');
      $albumData = $this->Album->getAlbumDataById($album_id);

      if ($this->request->is('post')) {

        $file = $this->data['Album']['upload'];

        $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
        $arr_ext = array('jpg', 'jpeg', 'gif','png');

        if(in_array($ext, $arr_ext))
        {
            move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/' . $file['name']);

            //prepare the filename for database entry
            $saveData['Album']['image_path'] = $file['name'];
            $saveData['Album']['album_id'] = $this->data['Album']['album_id'];
            $this->Photo->create();
            if ($this->Photo->saveAll($saveData['Album'])) {
              $this->Flash->success(__('Photo added to Album.'));
              return $this->redirect(array('action' => 'index'));
            } else {
              $this->Flash->error(__('The album could not be saved. Please, try again.'));
            }
        }
        else{
          $this->Flash->error(__('File format did not match. Please, try again.'));
        }

      }

      $this->set(compact('albumData'));
  }

  public function publish($id)
  {
    if (!$this->Album->exists($id)) {
      throw new NotFoundException(__('Invalid user'));
    }
    $this->Album->id = $id;
    $saveData['Album']['is_published'] = 'y';
    $this->Album->save($saveData['Album']);
    $this->Flash->success(__('Album has been published.'));
    return $this->redirect(array('action' => 'index'));
    }

  public function isAuthorized()
  {
    $user['sessionData'] = $this->Session->read('User');
    if(count($user['sessionData'])>0)
    {
      return true;
    }
    else{
      $this->redirect(array(
        'controller' => 'users',
        'action' => 'login'));
    }
  }
}
