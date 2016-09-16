<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

App::uses('UsersAppModel', 'Users.Model');
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
class UsersController extends AppController {

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
    if($this->isAuthorized()) {
      $this->User->recursive = 0;
      $user['sessionData'] = $this->Session->read('User');
      $user['paginator'] = $this->Paginator->paginate();
      $this->set('users', $user);
    }
	}

  public function login() {
    $this->set('login', 'login');
    if ($this->request->is('post')) {
      $userExist = $this->User->isValidUser($this->request->data['User']);
      if(count($userExist) == 0)
      {
        $this->Flash->error(__('Invalid username or password, try again'));
      }
      else{
        $this->Session->write(array('User' => array(
          'username' => $userExist['User']['username'],
          'role'=>$userExist['User']['role'],
          'userid'=>$userExist['User']['id']
        )));
        if($userExist['User']['role'] == 1) {
          $this->redirect(array(
              'controller' => 'users',
              'action' => 'index')
          );
        }
        else
        {
          $this->redirect(array(
            'controller' => 'albums',
            'action' => 'index'));
        }
      }
    }
  }

  public function logout() {
    $this->Session->destroy();
    return $this->redirect(array(
      'controller' => 'users',
      'action' => 'login'));
  }
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
    if($this->isAuthorized()) {
      if(!$this->User->exists($id)) {
        throw new NotFoundException(__('Invalid user'));
      }
      $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
      $this->set('user', $this->User->find('first', $options));
    }
  }

/**
 * add method
 *
 * @return void
 */
	public function add() {
    if($this->isAuthorized()) {
		if ($this->request->is('post')) {
      $userExist = $this->User->isUserExist($this->request->data['User']['username']);
      if(count($userExist) > 0) {
        $this->Flash->error(__('Username already exists. Please, try again with different Username.'));
      } else {
        $this->User->create();
        if($this->User->save($this->request->data)) {
          $Email = new CakeEmail();
          $Email->from(array('pooja.pawar@weboniselab.com' => 'My Site'));
          $Email->to($this->request->data['User']['email']);
          $Email->subject('Password');
          $Email->send('Current Password : ' . $this->request->data['User']['password']);
          $this->Flash->success(__('The user has been saved.'));

          return $this->redirect(array('action' => 'index'));
        } else {
          $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
      }
     }
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
    if($this->isAuthorized()) {
      if(!$this->User->exists($id)) {
        throw new NotFoundException(__('Invalid user'));
      }
      if($this->request->is(array('post', 'put'))) {
        if($this->User->save($this->request->data)) {
          $this->Flash->success(__('The user has been saved.'));

          return $this->redirect(array('action' => 'index'));
        } else {
          $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
      } else {
        $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $this->request->data = $this->User->find('first', $options);
      }
    }
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
    if($this->isAuthorized()) {
      $this->User->id = $id;
      if(!$this->User->exists()) {
        throw new NotFoundException(__('Invalid user'));
      }
      if($this->User->delete()) {
        $this->Flash->success(__('The user has been deleted.'));
      } else {
        $this->Flash->error(__('The user could not be deleted. Please, try again.'));
      }

      return $this->redirect(array('action' => 'index'));
    }
	}

  public function changePassword()
  {
    if($this->isAuthorized()) {
      $user['sessionData'] = $this->Session->read('User');
      if(count($user['sessionData']) > 0) {
        if($this->request->is('post')) {
          $this->User->id = $user['sessionData']['userid'];
          $this->User->save($this->request->data);
          if($user['sessionData']['role'] == 2) {
            return $this->redirect((array('controller' => 'albums', 'action' => 'index')));
          } else {
            $this->redirect((array('controller' => 'users', 'action' => 'index')));
          }
        }
      }
    }
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
