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
	public $helpers = array('Lib');
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
//		$this->Staff->recursive = 0;
//		$this->set('staffs', $this->Paginator->paginate());
		$bills = $this->Staff->Bill->find('all');
		$timeNow = time();
		$dayNow = date('d/m/Y', $timeNow);
		$monthNow = date('m/Y', $timeNow);
		$dayInMonth = date('d', $timeNow);
		$productsDay = array();
		$productsMonth = array();
//		debug($monthNow);die;
		for ($i = 1; $i <= intval($dayInMonth); $i++){
			$productsMonth[$i] = array();
		}

		foreach ($bills as $key => $item){
			$time_created = $item['Bill']['created'];
			$timeConvert = strtotime($time_created);
			$dayConvert = date('d/m/Y', $timeConvert);
			$MonthConvert = date('m/Y', $timeConvert);
			$dayInMonthConvert = date('d', $timeConvert);
			if($dayNow == $dayConvert){
				$productsDay[] = $item['Detail'];
			}
			if($monthNow == $MonthConvert){
				$productsMonth[$dayInMonthConvert][] = $item['Detail'];
			}
		}
//		debug($productsMonth);die;
		$dataDay = array();
		foreach ($productsDay as $product) {
			foreach ($product as $item){
				$dataDay[$item['product_id']]['id'] = $item['product_id'];
				$dataDay[$item['product_id']]['name'] = $this->Staff->Bill->Detail->Product->findById($item['product_id'])['Product']['product_name'];
				if(isset($dataDay[$item['product_id']]['number']) && isset($dataDay[$item['product_id']]['price'])){

					$dataDay[$item['product_id']]['number'] += intval($item['number']);
					$dataDay[$item['product_id']]['price'] += intval($item['single_price']);
				}else{
					if(!isset($dataDay[$item['product_id']]['number'])){
						$dataDay[$item['product_id']]['number'] = intval($item['number']);
					}
					if(!isset($dataDay[$item['product_id']]['price'])){
						$dataDay[$item['product_id']]['price'] = intval($item['single_price']);
					}
				}

			}
		}
		$dataMonth = array();
		$dataTotalMonth = array();
		foreach ($productsMonth as $key => $bills){
			$dataMonth[$key]['price'] = 0;
			$dataMonth[$key]['number'] = 0;

			foreach ($bills as $products){
				if(!empty($products)){
					foreach ($products as $product){
						$dataMonth[$key]['price'] += intval($product['single_price']);
						$dataMonth[$key]['number'] += intval($product['number']);

						$dataTotalMonth[$product['product_id']]['id'] = $product['product_id'];
						$dataTotalMonth[$product['product_id']]['name'] = $this->Staff->Bill->Detail->Product->findById($product['product_id'])['Product']['product_name'];
						if(isset($dataTotalMonth[$product['product_id']]['number']) && isset($dataTotalMonth[$product['product_id']]['price'])){

							$dataTotalMonth[$product['product_id']]['number'] += intval($product['number']);
							$dataTotalMonth[$product['product_id']]['price'] += intval($product['single_price']);
						}else{
							if(!isset($dataTotalMonth[$product['product_id']]['number'])){
								$dataTotalMonth[$product['product_id']]['number'] = intval($product['number']);
							}
							if(!isset($dataTotalMonth[$product['product_id']]['price'])){
								$dataTotalMonth[$product['product_id']]['price'] = intval($product['single_price']);
							}
						}
					}
				}
			}
		}
//		debug($dataDay);die;
		$data = array(
			'dataDay' => $dataDay,
			'dataMonth' => $dataMonth,
			'dataTotalMonth' => $dataTotalMonth,
		);
		$this->set('data', $data);
//		debug($data);die;

//		debug(date('d/m/Y', $timeStampe));die;
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
