<?php
App::uses('AppController', 'Controller');
/**
 * Staffs Controller
 *
 * @property Staff $Staff
 * @property PaginatorComponent $Paginator
 */
class StaffsController extends AppController {
	/**
	 * @return CakeResponse|null
	 */
	public function login(){
		if($this->Auth->login()){
			return $this->redirect($this->Auth->redirectUrl());
		}else{
			$this->Session->setFlash('Tài khoản hoặc mật khẩu không đúng!');
		}
	}

	public function logout(){
		$this->Auth->logout();
		$this->redirect('/staffs/login');
	}

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
		$this->Staff->recursive = 0;
		$this->set('staffs', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Staff->exists($id)) {
			throw new NotFoundException(__('Invalid staff'));
		}
		$options = array('conditions' => array('Staff.' . $this->Staff->primaryKey => $id));
		$this->set('staff', $this->Staff->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Staff->create();
			$this->request->data['Staff']['password'] = AuthComponent::password($this->request->data['Staff']['password']);
			$this->request->data['Staff']['role'] = 2;
			if ($this->Staff->save($this->request->data)) {
				$this->Flash->success(__('Tạo tài khoản thành công!'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Tạo tài khoản thất bại!'));
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
		if (!$this->Staff->exists($id)) {
			throw new NotFoundException(__('Invalid staff'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Staff->save($this->request->data)) {
				$this->Flash->success(__('The staff has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The staff could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Staff.' . $this->Staff->primaryKey => $id));
			$this->request->data = $this->Staff->find('first', $options);
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
		if (!$this->Staff->exists($id)) {
			throw new NotFoundException(__('Invalid staff'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Staff->delete($id)) {
			$this->Flash->success(__('The staff has been deleted.'));
		} else {
			$this->Flash->error(__('The staff could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
